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
			 if (get_field('publicacao_arquivo')) {?>
	 	<button class="download-btn">
	 		<a href="href="<?php echo get_field('publicacao_arquivo'); ?>"">
	 			<img  src="<?php echo get_template_directory_uri()?>/assets/images/download-btn.png">
	 		</a>
	 	</button>
	<?php
		} 
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'odin' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
