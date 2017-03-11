<div class="cada-publicacao-archive col-sm-6">

	
	 <div class="col-md-9 titulo-publicacao-archive">
	 	<a href="<?php echo get_permalink( );?>">
	 	<?php the_title( '<h4>', '</h4>'  ); 
 		?>
 		</a>
 		<?php
			the_content( );
			the_field('email');
			the_field('telfone');
			
	 	?>
	</div>	
	

</div><!--cada-slide-2-->								
