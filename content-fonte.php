<div class="cada-publicacao-archive col-sm-6">

	
	 <div class="col-md-9 titulo-publicacao-archive">
	 	<?php the_title( '<h4>', '</h4>'  ); 
 		?>
 		<?php
			the_content( );
			?>
			
				<a id="email" target="_blank" href="mailto:<?php the_field('email'); ?>"><?php the_field('email');?> </a>
			
			
			<?php if( get_field('telefone') ): ?>
	
					<p>☎ <?php the_field('telefone'); ?></p>
					
			<?php endif; ?>
				<?php
				// print_r($post);
				$terms = get_the_terms($post->ID, 'tema_fonte');
					// get_terms([
	    // 					'taxonomy' => "tema_fonte",
					// 	]);
				$count=count($terms);
				foreach ($terms as $term) {
			?>
				<a href="<?php  echo get_term_link($term->term_id);?>"><?php echo $term->name; 
				if ($count > 1){
						echo ", ";
						$count--;
					}
				}
				?>
				</a>
			</p>
			<?php 
				

	 		?>
	 		</p>
	</div>	
	

</div><!--cada-slide-2-->								
