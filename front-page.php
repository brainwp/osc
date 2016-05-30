<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package Odin
 * @since 2.2.0
 */

get_header(); ?>

	<main id="content" class="<?php echo odin_classes_page_full(); ?>" tabindex="-1" role="main">

		<div class="row slider">
			
		</div>
		<div class="row categorias">
			<div id="categorias-nav">
				
			</div>
			<div id="categorias-conteudo">
				
			</div>
		</div>
		<div class="row destaques-contato">
			<div class="destaques col-sm-8">
				
			</div>
			<div class="contato col-sm-4">
				<div class="newsletter">
					<h4><img src="" alt="">ASSINE E ACOMPANHE O OBSERVATÓRIO DA SOCIEDADE CIVIL</h4>
					<input type="text">
					<input type="email">
					<img id="enviar-newsletter" src="" alt="">
				</div>
				<div class="link-banco">
					<h4><img src="" alt="">CONHEÇA O BANCO DE PRÁTICAS SUSTENTÁVEIS</h4>
					<p>Lorem ipsum dolor sit amet, pro ad legere discere, iisque interpretaris qui at. Eos mundi iudicabit reformidans. ad, ut ius quem reformidans conclusionemque</p>
					<img  id="link-banco"src="" alt="">
				</div>

			</div>
		</div>

	</main><!-- #main -->

<?php
get_footer();
