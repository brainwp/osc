<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Thirteen
 * already has tag.php for Tag archives, category.php for Category archives,
 * and author.php for Author archives.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Odin
 * @since 2.2.0
 */

get_header('fonte'); ?>
	<main id="content" class="row" tabindex="-1" role="main">
			<?php if ( have_posts() ) : ?>
				<h2 class="titulo">Banco de fontes</b></h2>
				

				<h4 class='resultados-cont'> O tema <b><?php echo $wp_query->queried_object->name;?></b> retornou <b><?php echo $wp_query->found_posts; ?></b> itens</h4>

				<div class="barra-busca">
					<h6>Busque fontes: </h6>
				<form method="get" class="form-busca" action="<?php echo esc_url( home_url( '/fonte/' ) ); ?>" role="search">
					<label for="navbar-search" class="sr-only">
						<?php _e( 'Search:', 'odin' ); ?>
					</label>
					<div class="form-group">
						<input type="search" value="<?php echo get_search_query(); ?>" class="form-control" name="s" id="navbar-search" />
					</div>
					<button type="submit" class="btn botao-busca"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/lupa.png" alt=""></button>
				</form>

					<h6>Temas: </h6>
					 <?php $terms = get_terms( 'tema_fonte' );
					 if (is_tax('tema_fonte')){
					    	$term_page = get_queried_object()->term_id;
					    }
					if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){

					    echo '<select>';

					    foreach ( $terms as $term ) {
					    	// print_r($term);
					    	if ($term_page == $term->term_id) {
					    		$selected=' selected ';
					    	}
					    	else{
					    		$selected=' ';

					    	}
					        echo '<option value="'.esc_url( home_url( '/tema_fonte/'.$term->slug ) ).'"'.$selected.'>' . $term->name . '</option>';
					    }
					    echo '</select>';
					}?> 


					<?php
						
					?>
					<div class="clearfix"></div>
				</div>
				<div>
				<?php
					// echo '<pre>';
					// print_r(;
					// echo '</pre>';
						// Start the Loop.
						while ( have_posts() ) : the_post();

							/*
							 * Include the post format-specific template for the content. If you want to
							 * use this in a child theme, then include a file called called content-___.php
							 * (where ___ is the post format) and that will be used instead.
							 */
							get_template_part( 'content', 'fonte' );


						endwhile;

						// Post navigation.
						odin_paging_nav();

					else :
						// If no content, include the "No posts found" template.
						get_template_part( 'content', 'none-banco' );

				endif;
			?>
			</div>

	</main>

<?php
get_footer();
