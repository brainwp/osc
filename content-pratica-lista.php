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

<article  class="row cada-pratica-lista " id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
			<?php the_title( '<h2 class="entry-title"><span>Nome do projeto: </span><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		?>
		<div class="entry-meta">
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->
		<h4>Descrição</h4>

		<div class="col-sm-3 entry-thumb" id="thumb-pratica">
			<?php if (has_post_thumbnail($post->ID )){
				echo get_the_post_thumbnail( $post->ID, 'pratica-lista');	
			} 
			else{
				echo '<img width="200" height="200" src="'. get_template_directory_uri().'/assets/images/sem_foto.gif" class="attachment-pratica-lista size-pratica-lista wp-post-image" alt="Sem Imagem" >';
			}?>
		</div>
		<div id="resumo" class="col-sm-9 entry-content">
			<p >
			<?php
				echo get_field('resumo_da_pratica');
			?>
		</p>
		</div><!-- .entry-content -->
		<div class="clearfix"></div>
	<footer class="entry-meta">
		<h4>Identificação</h4>
		<div class="col-sm-6 identificacao">
			<p><span>Nome da entidade: </span><?php echo get_field('nome_da_entidade');?></p>
			<p><span>Telefone da entidade:</span> <?php echo get_field('telefone_da_entidade');?></p>

		</div>
		<div class="col-sm-6 identificacao">
			<p><span>Responsável: </span><?php echo get_field('nome_do_responsavel');?></p>
			<p><span>Telefone do responsável: </span><?php echo get_field('telefone_do_responsavel');?></p>

		</div>
		<div class="col-sm-6 identificacao" id='estado-entidade'>
			<?php 

				$results = $wpdb->get_results( 'SELECT cod_estados, sigla
					FROM wp_17_w_estados
					WHERE cod_estados='.get_field('uf').'
					ORDER BY sigla', OBJECT );
					foreach ($results as $key ) {
					echo '<p><span>Estado: </span>'. $key->sigla.'</p>';	
				}
				$results = $wpdb->get_results( 'SELECT cod_cidades, nome
					FROM wp_17_w_cidades
					WHERE cod_cidades='.get_field('uf').'
					ORDER BY nome', OBJECT );
				foreach ($results as $key ) {
				echo '<p><span>Cidade: </span>'. $key->nome.'</p>';			}
			?>
		</div>
		<div class="col-sm-6 identificacao" class='tema'>
			<?php $tema= wp_get_post_terms( $post->ID, 'tema', array('count'=>1, 'parent'=>0));?>
			<p><span>Tema: </span><?php echo $tema[0]->name ?></p>
			<?php $subtema=(wp_get_post_terms($post->ID,'tema', array('parent'=>$tema[0]->term_id)));?>
			<p><span>Subtema: </span><?php echo $subtema[0]->name ?></p>
			

		</div>

		<div class="col-sm-4 identificacao" id='telefone-responsavel'>
		</div>
		<div class="clearfix"></div>
	</footer>
	<div class="saiba"><a href=" <?php echo get_permalink($post->id ); ?> ">Conheça o projeto</a></div>
	<div class="clearfix"></div>
	<hr>

</article><!-- #post-## -->
