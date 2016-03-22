<?php
/**
 * Template Name: Edição
 *
 * Template para a Edição de práticas existentes
 *
 * @package Odin
 * @since 2.2.0
 */
acf_form_head();
add_action('wp_head','pluginname_ajaxurl');
function pluginname_ajaxurl() {
?>
<script type="text/javascript">
var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
</script>
<?php
}
get_header('banco'); ?>

	<main id="content" class="home-banco banco <?php echo odin_classes_page_full(); ?>" tabindex="-1" role="main">
		<h1>Edição de práticas existentes</h1>
		<?php if (!is_user_logged_in()){
			?>

				<div class="row" id="login">
					<h3>Entre para editar suas práticas</h3>
					<?php
					$args = array(
						'redirect' => get_permalink( ),

						'label_username'=>'E-mail'
						);
					 wp_login_form($args);
					 if (isset($_GET['erro'])){
					 	echo '<h4>'.urldecode($_GET['erro']).'</h4>';
					 } ?>
				</div>

		<?php }
		else{
			global $user_ID;
			$user_id = $user_ID;
			$args = array( 'author' => $user_id, 'post_type'=>'pratica' );
			$query = new WP_Query(  $args);
			// echo '<pre>';
			// print_r($user_ID);
			// echo '</pre>';
			?>
				<div class="row" id="login">
					<h4>Quer mudar de usuário? Clique em <a href="<?php echo wp_logout_url(get_permalink( )); ?>"> sair</a>.</h4>
				</div>
	
		<div  <?php if (is_user_logged_in()){echo "style='display:block;'"; }?> class="row" id="praticas-usuario">
			<h4>Selecione a prática que quer editar.</h4>
			<?php if ( $query->have_posts() ) { 
					while ( $query->have_posts() ) : $query->the_post();
						echo '<a class="praticaEdit" href="#" data-id="'.get_the_id().'" > <h5>'.get_the_title( ).'</h5></a>';
					endwhile;
				 }
			else{
				echo "<h3>Você não tem práticas cadastradas</h3";
			} ?>
		</div>
		<div id="continua-cadastro" class="row">
			<h2>Cadastro de Práticas</h2>
			<form>
				<div class="col-cadastro col-sm-6">
					<h3>Identificação da prática</h3>
					<input class="title nome" name="nome-projeto" placeholder="Nome da prática *" type="text">
					<select class='uf inline-block acf' name="uf" id="uf-continua-cadastro">
						<option value="">UF *</option>
						<?php
						global $wpdb;
						$results = $wpdb->get_results( 'SELECT cod_estados, sigla
									FROM '.$wpdb->prefix.'w_estados
									ORDER BY sigla', OBJECT );
						foreach ($results as $key ) {
							echo '<option value="'.$key->cod_estados.'">'.$key->sigla.'</option>';	
						}
						?>
					</select>
					<span class="cidade-carregando">Aguarde, carregando...</span>

					<select class='inline-block acf cidade' name="cidade" id="cidade-continua-cadastro">
					<?php
						global $wpdb;
						$results = $wpdb->get_results( 'SELECT cod_cidades, nome
						FROM '.$wpdb->prefix.'w_cidades
						ORDER BY nome', OBJECT );
						echo '<option value="0">Cidade</option>';	

					foreach ($results as $key ) {
						echo '<option value="'.$key->cod_cidades.'">'.$key->nome.'</option>';	
					}?>	
					</select>
					
					<h4 class="subtitulo-cadastro">Responsável pela prática</h4>
					<input class="acf" name="nome_da_entidade" placeholder="Nome da Entidade ou pessoa *" type="text">
					<input class="acf" name="telefone_da_entidade" placeholder="Telefone" type="text">
					<input class="acf" name="endereco_da_entidade" placeholder="Endereço" type="text">
					<input class="acf" name="site_da_entidade" placeholder="Site" type="text">
					<label>Você pode colocar multiplos valores separados por virgula</label>
					<input class="acf" name="e-mail_de_contato" placeholder="E-mail de contato *" type="email">
					<label>Você pode colocar multiplos valores separados por virgula</label>



					<!-- <h4 class="subtitulo-cadastro">Responsável pela prática</h4>
					<input class="acf" name="nome_do_responsavel" placeholder="Nome" type="text">
					<input class="acf" name="e-mail_do_responsavel" placeholder="E-mail" type="text">
					<input class="telefone acf " name="telefone_do_responsavel" placeholder="Telefone do responsável" type="text"> -->
				</div>
				<div class="col-cadastro col-sm-6">
					<h3>Descrição das Ações</h3>
					<?php drop_tags('Tema *', 'tema', 0, "tema-continua-cadastro")?>
					<div id="subs"></div>
					<div id="subs2"></div>
					<textarea class="acf" maxlength="800" rows="5"name='resumo_da_pratica' placeholder="Resumo da prática *"></textarea>

					<textarea class='acf' rows="5"name='objetivo' placeholder="Objetivo *"></textarea>
					<input class='acf' name="publico-alvo" placeholder="Público-alvo *" type="text">
					<input class='acf' name="video" placeholder="Link do Vídeo" type="text">
					<input class='acf' name="local_de_implementacao" placeholder="Local de implementação" type="text">
					<textarea class='acf' rows="5"name='descricao_das_acoes' placeholder="Descrição da Ação *"></textarea>
					<textarea class='acf' rows="5"name='resultados' placeholder="Resultados *"></textarea>
					<div class="ibenic_upload_message"></div>
 					<div id="ibenic_file_upload" class="file-upload">
  						<input type="file" id="ibenic_file_input" style="opacity:0;" />
  						<p class="ibenic_file_upload_text"><?php _e( 'Imagem destacada', 'ibenic_upload' ); ?></p>
  						<div class="ajax-loader"></div>
  					</div>
  					<input type="hidden" name="imagem_destacada" id="imagem_destacada">
  					<div id="ibenic_file_upload_preview" class="file-upload file-preview" style="display:none;">
  						<div class="ibenic_file_preview"></div>
  						<button data-fileurl="" class="ibenic_file_delete">
  						  <?php _e( 'Delete', 'ibenic_upload' ); ?>
  						</button>
					</div>
					<div id="anexosExistentes">
						<h3>Imagens anexas</h3>
						<div class="imagensAnexas"></div>
						<h3>Arquivos anexos</h3>
						<div class="arquivosAnexos"></div>
					</div>
					<div class = "anexos">
      			 	 	<input type = "file" name = "files[]" id="anexosUp"  class = "files-data form-control" multiple />
   					    <label>Selecione os arquivos para anexo e clique em enviar</label>
  						<div class="ajax-loader"></div>
						<div class="upload-response"></div>
   					    <input type = "submit" value = "Enviar" id="anexos" class = "btn btn-primary btn-upload" />
						<input type="hidden" id="ids-anexos" name="ids_anexos">

   					</div>
   					<?php 
   						$usuario= get_user_by( 'id', $user_ID );
			// echo '<pre>';
			// print_r($usuario);
			// echo '</pre>';

   					 ?>
   					<input value="1" id="edicao" class="" name="edicao"  type="hidden" >
   					<input value="<?php  ?>" id="postId" class="" name="postId"  type="hidden" >
   					<input value="<?php echo $usuario->user_login; ?>" class="acf" name="login" placeholder="Nome de usuário *" type="hidden" >
					<input value="<?php echo $usuario->user_email; ?>" class="acf" name="e-mail_de_cadastro" placeholder="E-mail de cadastro *" type="hidden">
					<input value="<?php echo $usuario->user_pass; ?>" class="acf" name="senha" placeholder="Cadastre uma senha *" type="hidden">
					<input value="<?php echo $usuario->user_pass; ?>" class="acf" name="senha-repetir" placeholder="Repita a senha *" type="hidden">
   					 <!-- <div class = "galeria">
      			 	 	<input type = "file" name = "files_gal[]" id="anexosUpGal" accept = "image/*" class = "files-data form-control" multiple />
       					<label>Selecione as fotos para a galeria e clique em enviar</label>
       					<div class="ajax-loader"></div>
						<div  class="upload-response-gal"></div>

   					    <input type = "submit" value = "Enviar" id="anexos-gal" class = "btn btn-primary btn-upload" />

   					    <input type="hidden" id="ids-anexos-gal" name="ids_anexos_gal">

   					 </div> -->
					
				<div class="clearfix"></div>
				<div id="resultado"></div>
				<a class="enviar" id="enviar-cadastro" href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/cadastrar-banco.png">Cadastrar</a>			</form>
				</div>
			</form>
		</div>
				<?php 
		} ?>
		<!-- fecha o if do login -->
	</main><!-- #main -->



<?php 


get_footer();
