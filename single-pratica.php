<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Odin
 * @since 2.2.0
 */

get_header('banco'); ?>
<main id="content" class="home-banco banco c" tabindex="-1" role="main">
		<div id='resumo-fundo'class=''>	
			<div id='resumo' class="row">
				<h1 class='col-sm-12'>Banco de práticas alternativas</h1>
				<div class="clearfix"></div>
			</div>
		</div>
		<div id='pratica-<?php get_the_id();?>' class='row'>
		<?php echo '<h1>'.get_the_title(   ).'</h1>';?>

			<?php get_sidebar('pratica' ); ?>
			<div id="single-pratica-conteudo" class="col-sm-9">
			<?php
				while ( have_posts() ) : the_post();
					$estado = get_post_meta( $post->ID, 'uf', 1);
					global $wpdb;
					$results = $wpdb->get_results( 'SELECT cod_estados, sigla
						FROM '.$wpdb->prefix.'w_estados WHERE cod_estados = '.$estado.'
						ORDER BY sigla', OBJECT );
					foreach ($results as $key ) {
						$estado= $key->sigla;	
					}
					$cidade = get_post_meta( $post->ID, 'cidade', 1);
					
					

					echo '<h4 id="resumo">Resumo</h4><p>'.get_field('resumo_da_pratica').'</p>';
					echo '<div id="temas">'.get_the_term_list( $post->ID, 'tema', '<h4>Temas: </h4>', ' ' ).'</div>';
					echo "<div class='clearfix'></div>";
					echo '<h4 id="descricao">Descrição</h4><p>'.get_field('descricao_das_acoes').'</p>';
					echo '<h4 id="objetivos">Objetivos</h4><p>'.get_field('objetivo').'</p>';
					echo '<h4 id="publico-alvo">Público-alvo</h4><p>'.get_field('publico-alvo').'</p>';
					if (get_field('local_de_implementacao')!=""){
						echo '<h4 id="local">Local de implementação</h4><p>'.get_field('local_de_implementacao').'</p>';
					}
					echo '<h4 id="estado">UF</h4><p>'.$estado.'</p>';
					if ($cidade!=0){
						global $wpdb;
						$results = $wpdb->get_results( 'SELECT cod_cidades, nome
						FROM '.$wpdb->prefix.'w_cidades WHERE cod_cidades = '.$cidade.'
						ORDER BY nome', OBJECT );
						foreach ($results as $key ) {
							$cidade= $key->nome;	
						}
						echo '<h4 id="cidade">Cidade</h4><p>'.$cidade.'</p>';
					}
					echo '<h4 id="resultados">Resultados</h4><p>'.get_field('resultados').'</p>';

					$args = array(
						'post_type' => 'attachment',
						'numberposts' => null,
						'post_status' => null,
						'post_parent' => $post->ID
					); 
					$attachments = get_posts($args);
					if ($attachments) {
					echo '<h4 id="galeria">Galeria de imagens</h4>';					
						foreach ($attachments as $attachment) {
							// echo apply_filters('the_title', $attachment->post_title);
							// wp_getthe_attachment_link($attachment->ID, false);
							// print_r(wp_get_attachment_image_src( $attachment->ID, 'thumb'));
							// echo'<br>';
							echo "<div class='col-md-4'><a target='_blank' href='".wp_get_attachment_url($attachment->ID)."'><img src='".wp_get_attachment_image_src( $attachment->ID, 'thumbnail')[0]."'></a></div>";
						}
					}
				
				endwhile;
				echo "<div class='clearfix'></div>";
				if (get_field('video')!="") {
					echo '<h4 id="video">Video</h4>';
					echo get_field('video');				
				}
				

			?>
			</div>
			<!-- col-sm-9 conteudo -->
		</div>
			
	</main><!-- #main -->

	

<?php
get_footer('banco');
