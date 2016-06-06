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

get_header('internas'); ?>

	<main id="content" class="row" tabindex="-1" role="main">
			<h1>404</h1>
			<h2>Nada encontrado</h2>
			<div class="barra-busca">
					<h6>Buscar: </h6>
				<form method="get" class="form-busca" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
					<label for="navbar-search" class="sr-only">
						<?php _e( 'Search:', 'odin' ); ?>
					</label>
					<div class="form-group">
						<input type="search" value="<?php echo get_search_query(); ?>" class="form-control" name="s" id="navbar-search" />
					</div>
					<button type="submit" class="btn botao-busca"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/lupa.png" alt=""></button>
				</form>
					<h6>Alguns atalhos: </h6>
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'busca-menu',
								'depth'          => 2,
								'container'      => false,
								'menu_class'     => 'menu-busca',
								'fallback_cb'    => 'Odin_Bootstrap_Nav_Walker::fallback',
								'walker'         => new Odin_Bootstrap_Nav_Walker()
							)
						);
					?>
					<div class="clearfix"></div>
				</div>
	</main><!-- #main -->

<?php
get_footer();
