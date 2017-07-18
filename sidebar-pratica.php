<?php
/**
 * The sidebar containing the secondary widget area, displays on homepage, archives and posts.
 *
 * If no active widgets in this sidebar, it will shows Recent Posts, Archives and Tag Cloud widgets.
 *
 * @package Odin
 * @since 2.2.0
 */
?>

<aside id="sidebar" class="" role="complementary">
	<?php
	?>
		<ul>
			<?php if (has_post_thumbnail($post->ID )){
				echo get_the_post_thumbnail( $post->ID, 'pratica-lista');	
			} 
			else{
				echo '<img width="200" height="200" src="'. get_template_directory_uri().'/assets/images/sem_foto.png" class="attachment-pratica-lista size-pratica-lista wp-post-image" alt="Sem Imagem" >';
			}?>			<h4 id="nav_pratica_titulo">Navegação</h4>
			<li class="item-menu"><a href="#resumo">Resumo</a></li> 
			<li class="item-menu"><a href="#descricao">Descrição</a></li>
			<li class="item-menu"><a href="#objetivos">Objetivos</a></li>
			<li class="item-menu"><a href="#resultados">Resultados</a></li>
			<h4>Contato</h4>
			<?php 
					echo '<h5>Responsável:</h5><p>'.get_field('nome_da_entidade').'</p>';
				?>
			<h5>E-mails:</h5>
			<?php 
				$emails=explode(',', get_field('e-mail_de_contato'));
				foreach ($emails as $email) {
					echo '<a href="mailto:'.$email.'">'.$email.'</a><br>';
				}
							
			if (get_field('telefone_da_entidade')!=""){
				echo '<h5>Telefones:</h5>';
				$tels=explode(',', get_field('telefone_da_entidade'));
				foreach ($tels as $tel) {
					echo $tel.'<br>';
				}
			}
		
			 if (get_field('endereco_da_entidade')!=""){
			 	echo "<h5>Endereco:</h5>";
				echo '<p>'.get_field('endereco_da_entidade').'</p>';
			}
			 
			 if (get_field('site_da_entidade')!=""){
				 echo "<h5>Site:</h5>";
				 $sites=explode(',', get_field('site_da_entidade'));
				foreach ($sites as $site) {
					 echo '<a target="_blank" href="'.$site.'">'.$site.'</a>';
				}
				 
			}?>
		</ul>
	<?php 
	?>
</aside><!-- #sidebar -->
