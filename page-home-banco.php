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

get_header('banco'); ?>

	<main id="content" class="home-banco <?php echo odin_classes_page_full(); ?>" tabindex="-1" role="main">
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
						<option value="">UF</option>
						<?php
						global $wpdb;
						$results = $wpdb->get_results( 'SELECT cod_estados, sigla
									FROM wp_17_w_estados
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
						FROM wp_17_w_cidades
						ORDER BY nome', OBJECT );
						echo '<option value="0">Cidade</option>';	

					foreach ($results as $key ) {
						echo '<option value="'.$key->cod_cidades.'">'.$key->nome.'</option>';	
					}?>
					</select>
					<div class="inline-block"><a href="#"><span>+</span>Mais opções de pesquisa</a></div>
					<a  class="inline-block enviar" href="#">Pesquisar<img src="<?php echo get_template_directory_uri(); ?>/assets/images/busca-banco.png"></a>
				</form>
			</div>
			<div id='cadastro' class="col-sm-6">
				<form action="">
					<h3>Cadastre uma nova prática sustentável</h3>
					<input class="nome" name="nome-projeto" placeholder="Nome do Projeto" type="text">
					<?php drop_tags('Tema', 'tema', 0, "tema-cadastro")?>
					<select class='uf inline-block' name="uf" id="uf-cadastro">
						<option value="">UF</option>
						<?php
						global $wpdb;
						$results = $wpdb->get_results( 'SELECT cod_estados, sigla
									FROM wp_17_w_estados
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
						FROM wp_17_w_cidades
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
			<h3>Já cadastrou e quer modificar sua prática? <a href="#">Clique aqui</a></h3>
		</div>
		<div id="resultados-busca" class="row"></div>

		<div id="continua-cadastro" class="row">
			<h2>Cadastro de Projetos</h2>
			<form>
				<div class="col-cadastro col-sm-6">
					<h3>Identificação da prática</h3>
					<input class="title nome" name="nome-projeto" placeholder="Nome do Projeto" type="text">
					<select class='uf inline-block acf' name="uf" id="uf-continua-cadastro">
						<option value="">UF</option>
						<?php
						global $wpdb;
						$results = $wpdb->get_results( 'SELECT cod_estados, sigla
									FROM wp_17_w_estados
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
						FROM wp_17_w_cidades
						ORDER BY nome', OBJECT );
						echo '<option value="0">Cidade</option>';	

					foreach ($results as $key ) {
						echo '<option value="'.$key->cod_cidades.'">'.$key->nome.'</option>';	
					}?>	
					</select>

					<h4 class="subtitulo-cadastro">Entidade Responsável</h4>
					<input class="acf" name="nome_da_entidade" placeholder="Nome da Entidade" type="text">
					<input class="acf" name="telefone_da_entidade" placeholder="Telefone da Entidade" type="text">
					<input class="acf" name="endereço_da_entidade" placeholder="Endereço" type="text">
					<input class="acf" name="site_da_entidade" placeholder="Site" type="text">
					<input class="acf" name="e-mail_da_entidade" placeholder="E-mail" type="email">
					<input class="acf" name="senha" placeholder="Cadastre uma senha" type="password">
					<input class="acf" name="senha-repetir" placeholder="Repita a senha" type="password">


					<h4 class="subtitulo-cadastro">Responsável pelo projeto</h4>
					<input class="acf" name="nome_do_responsavel" placeholder="Nome" type="text">
					<input class="acf" name="e-mail_do_responsavel" placeholder="E-mail" type="text">
					<input class="telefone acf " name="telefone_do_responsavel" placeholder="Telefone do responsável" type="text">
				</div>
				<div class="col-cadastro col-sm-6">
					<h3>Descrição das Ações</h3>
					<?php drop_tags('Tema', 'tema', 0, "tema-continua-cadastro")?>
					<div id="subs"></div>
					<textarea class="acf" maxlength="800" rows="5"name='resumo_da_pratica' placeholder="Resumo da prática"></textarea>

					<textarea class='acf' rows="5"name='objetivo' placeholder="Objetivo"></textarea>
					<input class='acf' name="publico-alvo" placeholder="Público-alvo" type="text">
					<input class='acf' name="video" placeholder="Link do Vídeo" type="text">
					<input class='acf' name="local_de_implementacao" placeholder="Local de implementação" type="text">
					<textarea class='acf' rows="5"name='descricao_das_acoes' placeholder="Descrição da Ação"></textarea>
					<textarea class='acf' rows="5"name='resultados' placeholder="Resultados"></textarea>
					
				</div>
				<div class="clearfix"></div>
				<a class="enviar" id="enviar-cadastro" href="#"><img src="http://rede.com.br/osc/wp-content/themes/osc/assets/images/cadastrar-banco.png">Cadastrar</a>			</form>
		</div>


	</main><!-- #main -->

<?php
get_footer();
