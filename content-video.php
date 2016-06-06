<div class="cada-noticia-archive col-sm-4">
	<a href="<?php echo get_permalink( );?>">
		<?php
			echo get_field('video');
		 ?>
		 <div class="titulo-materia-archive"><?php the_title( '<h4>', '</h4>'  ); ?>
		 	<img class="seta-noticia" src="<?php echo get_template_directory_uri()?>/assets/images/seta-noticia.png">
		</div>	
	</a>
</div><!--cada-slide-2-->								
