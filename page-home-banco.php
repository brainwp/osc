<?php
/**
 * Template Name: Home-Banco
 *
 * Template para a home do banco
 *
 * @package Odin
 * @since 2.2.0
 */

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
							the_excerpt();

					endwhile;
				?>
				<p id="continue">
					Continue lendo<br>
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/leia-banco.png">
				</p>

			</div>
		</div>
		<div id='busca-cadastro' class='row'>
			<div id='pesquisa' class="col-sm-6"><form action="">
				<h3>Faça uma pesquisa nas práticas cadastradas</h3>
				<input placeholder="Palavra-chave" type="text">
				<select name="tema" id="">
					<option>Tema</option>
				</select>
				<select class='inline-block' name="uf" id="">
					<option>UF</option>
				</select>
				<select class='inline-block' name="cidade" id="">
					<option>Cidade</option>
				</select>
				<div class="inline-block"><a href="#"><span>+</span>Mais opções de pesquisa</a></div>
				<a  class="inline-block enviar" href="#">Pesquisar<img src="<?php echo get_template_directory_uri(); ?>/assets/images/busca-banco.png"></a>
			</form></div>
			<div id='cadastro' class="col-sm-6"><form action="">
				<h3>Cadastre uma nova prática sustentável</h3>
				<input placeholder="Nome do Projeto" type="text">
				<select name="tema" id="">
					<option>Tema</option>
				</select>
				<select class='inline-block' name="uf" id="">
					<option>UF</option>
				</select>
				<select class='inline-block' name="cidade" id="">
					<option>Cidade</option>
				</select>
				<a class="enviar" href="#">Continuar Cadastro<img src="<?php echo get_template_directory_uri(); ?>/assets/images/cadastrar-banco.png"></a>

			</form></div>
			<div class="clearfix"></div>
			<div id="modificar" class='col-sm-12'><h3>Já cadastrou e quer modificar sua prática? <a href="#">Clique aqui</a></h3><div>
		</div><!--busca-cadastro-->

	</main><!-- #main -->

<?php
get_footer();
