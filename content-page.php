<?php
/**
 * The template used for displaying page content.
 *
 * @package Odin
 * @since 2.2.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<div class="entry-content">
		<?php
			the_content();
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'odin' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->
	<footer class="entry-meta">
		<?php if ( in_array( 'categoria_noticias', get_object_taxonomies( get_post_type() ) ) ) : ?>
		<?php 
		$lista_cat="";
		$terms = wp_get_post_terms(get_the_id(), 'categoria_noticias');
				// print_r($terms);
				if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
					$count=0;
					
				    foreach ( $terms as $term ) {
				    	if ($count==0) {
				    		$lista_cat= '<a href="'.get_term_link($term,'categoria_noticias' ).'">'.$term->name.'</a>';
					    	$count++;

				    	}
				    	else{
				    		$lista_cat .= ', '.'<a href="'.get_term_link($term,'categoria_noticias' ).'">'.$term->name.'</a>';

				    	}

				    }
				?><span class="cat-links"><?php echo 'Categorias: ' . $lista_cat; ?></span>
				<?php 

				}
				// echo 'cat_lista'.$lista_cat;

		 ?>

		<?php endif; ?>
		<?php 
		// the_tags( '<span class="cat-links">' . __( 'Tags:', 'odin' ) . ' ', ', ', '</span>' ); ?>
		<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
			<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'odin' ), __( '1 Comment', 'odin' ), __( '% Comments', 'odin' ) ); ?></span>
		<?php endif; ?>
	</footer>
</article><!-- #post-## -->
