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
<?php if (has_post_thumbnail( )){
	the_post_thumbnail('thumb-page' );
	}
	else{
		echo '<img 	class="thumb-page wp-post-image" src="'.get_template_directory_uri().'/assets/images/thumb-page.png" alt="">';

	} 
?>
	<h2 class="titulo"><?php echo get_the_title( ); ?></b></h2>

	<main id="content" class="row" tabindex="-1" role="main">
			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();

					// Include the page content template.
					get_template_part( 'content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					// if ( comments_open() || get_comments_number() ) :
					// 	comments_template();
					// endif;
				endwhile;
			?>

	</main><!-- #main -->

<?php
get_footer();
