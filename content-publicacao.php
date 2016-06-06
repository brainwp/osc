<div class="cada-publicacao-archive col-sm-12">

	<div class="imagem-publicacao col-md-3">
	<?php if (!has_post_thumbnail( )) {
		echo '<img 	class="img thumb wp-post-image" src="'.get_template_directory_uri().'/assets/images/logo-quadrado.png" alt="">';
	 } 
	 else{
	 	the_post_thumbnail('destaques-categoria' );
	 }
	 ?>
	 </div>
	 <div class="col-md-9 titulo-publicacao-archive">
	 	<a href="<?php echo get_permalink( );?>">
	 	<?php the_title( '<h4>', '</h4>'  ); 
 		?>
 		</a>
 		<?php

		the_excerpt( );
	 	?>
	</div>	
	<?php if (get_field('publicacao_arquivo')) {?>
	 	<button class="download-btn">
	 		<a href="<?php echo get_field('publicacao_arquivo'); ?>" download>
	 			<img  src="<?php echo get_template_directory_uri()?>/assets/images/download-btn.png">
	 		</a>
	 	</button>
	<?php
		} ?>

</div><!--cada-slide-2-->								
