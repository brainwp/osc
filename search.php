<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Odin
 * @since 2.2.0
 */
get_header('banco'); 


$post_type = get_query_var('post_type'); 
if (isset($_GET['tema'])) {
	$tema=$_GET["tema"];
}
else{
	$tema=0;
}
if (isset($_GET['uf'])) {
	$uf=$_GET["uf"];
}
else{
	$uf=0;
}
if (isset($_GET['cidade'])) {
	$cidade=$_GET["cidade"];
}
else{
	$cidade=0;
}
if (isset($_GET['s'])&&$_GET['s']!="") {
	$nome=$_GET["s"];
	// add_filter( 'posts_where', 'cf_search_where' );
	// add_filter('posts_join', 'cf_search_join' );
	// add_filter( 'posts_distinct', 'cf_search_distinct' );
}
else{
	$nome=" ";
}
if( $post_type == 'pratica'){
global $wpdb;
// If you use default WordPress search form
$keyword = get_search_query();
$keyword ='%'. $wpdb->esc_like( $keyword ).'%';// Thanks Manny Fleurmond
// Search in all custom fields
$post_ids_meta = $wpdb->get_col( $wpdb->prepare("
SELECT DISTINCT post_id FROM {$wpdb->postmeta}
WHERE meta_value LIKE '%s'
", $keyword ));
// Search in post_title and post_content
$post_ids_post = $wpdb->get_col( $wpdb->prepare("
SELECT DISTINCT ID FROM {$wpdb->posts}
WHERE post_title LIKE '%s'
OR post_content LIKE '%s'
", $keyword, $keyword ));
$post_ids = array_merge( $post_ids_meta, $post_ids_post );
// Query arguments
$args = array(
'post_type'=>'post',
'post_status'=>'publish',
'post__in'=> $post_ids,
'post_type' => 'pratica',
'posts_per_page' =>12,
);
if ($cidade != 0 && $uf !=0){
	$args['meta_query']=array(
		array(
			'key'     => 'uf',
			'value'   => $uf,
			'compare' => '=',
		),
		array(
			'key' => 'cidade',
			'value'   => $cidade,
			'compare' => '=',
		),
	);	
}
elseif($cidade!=0){
	$args['meta_query']=array(
		'relation' => 'OR',
		array(
			'key' => 'cidade',
			'value'   => $cidade,
			'compare' => '=',
		),
	);
}
else if ($uf!="0"){
	$args['meta_query']=array(
		'relation' => 'OR',
		array(
			'key'     => 'uf',
			'value'   => $uf,
			'compare' => '=',
		),
	);
}
if ($tema !=0){
	$args['tax_query']=array(
		array(
			'taxonomy' => 'tema',
			'field'    => 'id',
			'terms'    => $tema,
		),
	);
}
$paged=(get_query_var('paged')) ? get_query_var('paged') : 1;
$args['paged']=$paged;
$query = new WP_Query( $args );
// echo '<pre>';
// print_r($query);
// echo '</pre>';

?>

<main id="content" class="busca-banco banco" tabindex="-1" role="main">
			<?php if ( $query->have_posts() ) : ?>

				<header class="row page-header">
					<h1 class="page-title"><?php printf( __( 'Busca de Práticas', 'odin' ), get_search_query() ); ?></h1>
				</header><!-- .page-header -->

					<?php

						// Start the Loop.
						while ( $query->have_posts() ) : $query->the_post();

							/*
							 * Include the post format-specific template for the content. If you want to
							 * use this in a child theme, then include a file called called content-___.php
							 * (where ___ is the post format) and that will be used instead.
							 */
							get_template_part( 'content', 'pratica-lista' );

						endwhile;

						// Post navigation.
						odin_paging_nav();

					else :
						// If no content, include the "No posts found" template.
						get_template_part( 'content', 'none' );

				endif;
			?>
	
	</main><!-- #main -->

<?php



}
else{
	?>

	<main id="content" class="<?php echo odin_classes_page_sidebar(); ?>" tabindex="-1" role="main">
			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'odin' ), get_search_query() ); ?></h1>
				</header><!-- .page-header -->

					<?php
						// Start the Loop.
						while ( have_posts() ) : the_post();

							/*
							 * Include the post format-specific template for the content. If you want to
							 * use this in a child theme, then include a file called called content-___.php
							 * (where ___ is the post format) and that will be used instead.
							 */
							get_template_part( 'content', get_post_format() );

						endwhile;

						// Post navigation.
						odin_paging_nav();

					else :
						// If no content, include the "No posts found" template.
						get_template_part( 'content', 'none' );

				endif;
			?>

	</main><!-- #main -->
	<?php 
}

get_footer();
