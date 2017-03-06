<?php
/**
 * The default template for displaying content.
 *
 * Used for both single and index/archive/author/catagory/search/tag.
 *
 * @package Odin
 * @since 2.2.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<h5 class="data-single">Publicado em: <?php  ?><?php echo get_the_date(); ?></h5>


	<?php if ( is_search() ) : ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
	<?php else : ?>
		<div class="entry-content">
			<?php
				the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'odin' ) );
				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'odin' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
				) );
			?>
		</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">
		<?php if ( in_array( 'categoria_noticias', get_object_taxonomies( get_post_type() ) ) ) : ?>
		<?php 
		$terms = wp_get_post_terms(get_the_id(), 'category');
				// print_r($terms);
				if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
					$count=0;
					$lista_cat="";
				    foreach ( $terms as $term ) {
				    	if ($count==0) {
				    		$lista_cat= $term->name;
					    	$count++;
				    	}
				    	else{
				    		$lista_cat .= ', '. $term->name;
				    	}
				    }
				}
				// echo 'cat_lista'.$lista_cat;
		 ?>
			<span class="cat-links"><?php echo 'Categorias: ' . $lista_cat; ?></span>
		<?php endif; ?>
		<?php 
		// the_tags( '<span class="tag-links">' . __( 'Tagged as:', 'odin' ) . ' ', ', ', '</span>' ); ?>
		<?php comments_template(); ?>  
	</footer>
</article><!-- #post-## -->