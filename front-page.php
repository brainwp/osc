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
			<?php 
				$args = array(
					'post_type' => 'noticia',
					'posts_per_page' =>4,
					'tax_query' => array(
						array(
							'taxonomy' => 'category',
							'field'    => 'slug',
							'terms'    => 'destaque',
						),
					),
				);
	
		$WP_query_slider = new WP_Query( $args );
	
		if( $WP_query_slider->have_posts()  )
		{
			?>
			<div id="slider-1">
				
			
			<?php
				while ( $WP_query_slider->have_posts() ) 
				{
						$WP_query_slider->the_post();
			?>
					<div class="cada-slide-1">
						<div class="box-titulo">
							<?php 
							$posttags = get_the_tags();
							echo '<a href="'.get_permalink().'"><i>'.get_field('chamada').'</i>';
							echo '<h3>'.get_the_title( ).'</h3></a>';
							?>
						</div><!--box-titulo-->
						<img src="<?php echo get_field( 'destaque' )['sizes']['slider-1'];?>" 
						alt="<?php echo get_the_title( ); ?>">
						<?php 
						// echo get_field( 'destaque' )['sizes']['slider-1'];

						// echo '<pre>';
						// print_r(get_field( 'destaque' )['sizes']['slider-1']);
						// echo '</pre>';
						?>
					</div><!--cada-slide-1-->								
					<?php
				}
				?>
			</div><!--slider-1-->
		<?php

			
		wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly
		}
	?>
			

		</div>
		<div class="row categorias">
			<div id="categorias-nav">
				<?php 
				 $odin_general_opts = get_option( 'odin_general' );

				 $cat_home=$odin_general_opts['cat_home'];
				
					$args_cat=array(
							'hide_empty'=>0,
							'title_li' =>'',
							// 'exclude' =>'213',
							'current_category'=>$cat_home
						);
					wp_list_categories( $args_cat ); 

				?>	
				<div class="clearfix"></div>

			</div>

			<div class="loader">
				<img  src="<?php echo get_template_directory_uri();?>/assets/images/ajax-loading-gd.gif" alt="">
			</div>	
			<div id="categorias-conteudo">
				
				<input type="hidden" value="<?php  echo $cat_home?>">
				 <?php 
				$args = array(
					'post_type' => 'noticia',
					'posts_per_page' =>8,
					'tax_query' => array(
						array(
							'taxonomy' => 'category',
							'field'    => 'id',
							'terms'    =>$cat_home,
						),
					),
				);
	
		$WP_query_cat = new WP_Query( $args );
	
		if( $WP_query_cat->have_posts()  )
		{
			?>
			
				
			
			<?php
				while ( $WP_query_cat->have_posts() ) 
				{
						$WP_query_cat->the_post();
			?>	
				<div class="cada-noticia col-sm-3">
					<div class="noticia-titulo">
						<?php 
						echo '<a href="'.get_permalink( ) .'"><h4><i>'.get_the_title( ).'</i></h4>';
						echo '<p>'.get_the_excerpt( ).'</p></a>';
						?>
					</div><!--box-titulo-->
					
					<?php
					if (!has_post_thumbnail( )) {
	 					echo '<img 	class="img wp-post-image" src="'.get_template_directory_uri().'/assets/images/logo-quadrado.png" alt="">';

					 } 
					 else{
					 	the_post_thumbnail('destaques-categoria' );

					 }
					?>
				</div>	
					
					<?php
					}
					?>
					</div>
					<?php
						wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly
		}
		?>
			<div class="clearfix"></div>
			<div class="ver-todos">
				<?php 
				echo '<a class="cat-btn" href="'.get_term_link(get_term($cat_home )).'"><button>Ver todas Desta categoria</button></a>';
				echo '<a href="noticia"><button>Ver todas Notícias</button></a>';
				?>
			</div>	
		</div><!--categorias-->
		<div class="row destaques-contato">
			<div class="destaques col-md-8">
				<?php 
				$args = array(
					'post_type' => 'slide',
					'posts_per_page' =>-1,
				);
	
				$WP_query_slider = new WP_Query( $args );
	
				if( $WP_query_slider->have_posts()  )
				{
				?>
					<div id="slider-2">
				
			
					<?php
					while ( $WP_query_slider->have_posts() ) 
					{
						$WP_query_slider->the_post();
					?>
						<div class="cada-slide-2">
							<a href="<?php echo get_field('link');?>">
								<?php the_post_thumbnail('slider-2' );?>
							</a>
						</div><!--cada-slide-2-->								
					<?php
					}
					?>
					</div>
					<?php
			
					wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly
				}
				?>
			</div>
			<div class="contato col-md-4">
				<div class="newsletter">
					<img class="img-contato"src="<?php echo get_template_directory_uri();?>/assets/images/mail.png"  alt="">
					<h4><i>Assine e acompanhe o Observatório da Sociedade Civil</i></h4>
					<?php echo do_shortcode('[contact-form-7 id="651" title="Formulario home"]' ); ?>
					<!-- <input type="text">
					<input type="email"> -->
					<img id="enviar-newsletter" src="" alt="">
				</div>
				<div class="link-banco">
					<img class="img-contato"src="<?php echo get_template_directory_uri();?>/assets/images/banco-arquivo.png"  alt="">

					<h4><i>Conheça o banco de práticas sustentáveis</i></h4>
					<p>Lorem ipsum dolor sit amet, . Eos mundi iudicabit reformidans. ad, ut ius quem reformidans conclusionemque</p>
					<a href="home-banco"> <div  id="link-banco"></div></a>
				</div>

			</div>
		</div>

	</main><!-- #main -->

<?php
get_footer();
