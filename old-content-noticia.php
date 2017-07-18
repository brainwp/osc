						<div class="cada-noticia-archive col-sm-4">
							<a href="<?php echo get_permalink( );?>">
								<?php if (!has_post_thumbnail( )) {
				 					echo '<img 	class="img thumb wp-post-image" src="'.get_template_directory_uri().'/assets/images/logo-quadrado.png" alt="">';

								 } 
								 else{
								 	the_post_thumbnail('quadrada' );

								 }
								 ?>
								 <div class="titulo-materia-archive"><?php the_title( '<h4>', '</h4>'  ); ?>
								 	<img class="seta-noticia" src="<?php echo get_template_directory_uri()?>/assets/images/seta-noticia.png">
								</div>	
					 		</a>
						</div><!--cada-slide-2-->								
