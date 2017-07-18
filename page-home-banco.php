<?php
/**
 * Template Name: Home-Banco
 *
 * Template para a home do banco
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
		<div id='resumo-fundo'class=''>	
			<div id='resumo' class="row">
				<h1 class='col-sm-7'>Banco de práticas alternativas</h1>
				<div class="col-sm-5">
					<img id='novos-logo'class=''src="<?php echo get_template_directory_uri(); ?>/assets/images/paradigmas.png">
				</div>
				<div class="clearfix"></div>
				<?php
					while ( have_posts() ) : the_post();
							the_content();

					endwhile;
				?>
				<p id="continue-p">
					<a id="continue" href="#" >Continue lendo</a><br>
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/leia-banco.png">
				</p>

			</div>
		</div>
		<div id='busca-cadastro' class='row'>
			<div id='pesquisa' class="col-sm-6">
				<form action="">
					<h3>Faça uma pesquisa nas práticas cadastradas</h3>
					<input id="filtro-palavra" placeholder="Palavra-chave" type="text">
					<?php drop_tags('Tema', 'tema', 1,"tema-busca", 1)?>
					<select name="uf-busca" class="uf" id="uf-busca">
						<option value="0">UF</option>
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

					
					<select class='inline-block cidade'  name="cidade-busca" id="cidade-busca">
						<span class="cidade-carregando">Aguarde, carregando...</span>
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
					<!-- <div class="inline-block"><a href="#"><span>+</span>Mais opções de pesquisa</a></div> -->
					<a  class="inline-block enviar" href="">Pesquisar<img src="<?php echo get_template_directory_uri(); ?>/assets/images/busca-banco.png"></a>
				</form>
			</div>
			<div id='cadastro' class="col-sm-6">
				<form action="">
					<h3>Cadastre uma nova prática alternativa</h3>
					<input class="nome" name="nome-projeto" placeholder="Nome da prática" type="text">
					<?php 
					drop_tags('Tema', 'tema', 0, "tema-cadastro")?>
					<select class='uf inline-block' name="uf" id="uf-cadastro">
						<option value="0">UF</option>
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

					<select class='inline-block cidade' name="cidade-cadastro" id="cidade-cadastro">
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
					<a id="continua-cadastro-btn" class="enviar" href="#">Continuar Cadastro<img src="<?php echo get_template_directory_uri(); ?>/assets/images/cadastrar-banco.png"></a>

				</form>
			</div>
		</div>
		<div class="clearfix"></div>
		<div id="modificar" class='col-sm-12'>
			<h3>Já cadastrou e quer modificar sua prática? <a href="
				<?php 
					$page=get_page_by_title( 'editar praticas' );
			 		echo get_permalink($page);
			 		?>">Clique aqui</a></h3>
		</div>
		<div id="resultados-busca" class="row"></div>
		<div id="resultado"></div>
		<div id="continua-cadastro" class="row">
			<h2>Cadastro de Práticas</h2>
			<form>
				<div class="col-cadastro col-sm-6">
					<h3>Identificação da prática</h3>
					<input class="title nome" name="nome-projeto" placeholder="Nome da prática *" type="text">
					<select class='uf inline-block acf' name="uf" id="uf-continua-cadastro">
						<option value="0">UF *</option>
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
					<h4 class="subtitulo-cadastro">Cadastro do usuário</h4>
					<input class="acf" name="login" placeholder="Nome de usuário *" type="text">
					<input class="acf" name="e-mail_de_cadastro" placeholder="E-mail de cadastro *" type="email">
					<input class="acf" name="senha" placeholder="Cadastre uma senha *" type="password">
					<input class="acf" name="senha-repetir" placeholder="Repita a senha *" type="password">
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
				<div id="erro"></div>
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
					
					<div class = "anexos">
      			 	 	<input type = "file" name = "files[]" id="anexosUp"  class = "files-data form-control" multiple />
   					    <label>Selecione os arquivos para anexo e clique em enviar</label>
  						<div class="ajax-loader"></div>
						<div class="upload-response"></div>
   					    <input type = "submit" value = "Enviar arquivo" id="anexos" class = "btn btn-primary btn-upload" />
						<input type="hidden" id="ids-anexos" name="ids_anexos">
						
   					 </div>
   					 <!-- <div class = "galeria">
      			 	 	<input type = "file" name = "files_gal[]" id="anexosUpGal" accept = "image/*" class = "files-data form-control" multiple />
       					<label>Selecione as fotos para a galeria e clique em enviar</label>
       					<div class="ajax-loader"></div>
						<div  class="upload-response-gal"></div>

   					    <input type = "submit" value = "Enviar" id="anexos-gal" class = "btn btn-primary btn-upload" />

   					    <input type="hidden" id="ids-anexos-gal" name="ids_anexos_gal">

   					 </div> -->
					
				<div class="clearfix"></div>
				<input id="edicao" value="0" class="" name="edicao"  type="hidden" >
		
				<a class="enviar" id="enviar-cadastro" href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/cadastrar-banco.png">Cadastrar</a>			</form>
				<div class="ajax-loader enviarCadastro"></div>
				</div>
			</form>
		</div>
	</main><!-- #main -->



<?php 


get_footer('banco');
