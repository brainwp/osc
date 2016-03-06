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
	<header class="entry-header">
		<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;
		?>
			<div class="entry-meta">
				<?php echo get_field('uf'); ?>
			</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	
		<div class="entry-content">
			<?php
				echo get_field('resumo_da_pratica');
			?>
		</div><!-- .entry-content -->

	<footer class="entry-meta">
		<div class="identificacao" id='telefone'>
			<?php echo get_field('telefone_da_entidade');?>
		</div>
		<div class="identificacao"></div>
		<div class="identificacao"></div>
		<div class="identificacao"></div>
	</footer>
</article><!-- #post-## -->
