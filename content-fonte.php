	<div class="cada-publicacao-archive col-sm-6">


	 <div class="col-md-9 titulo-publicacao-archive">
	 	<?php the_title( '<h4>', '</h4>'  );
 		?>
 		<?php
			the_content( );

			$emails=explode(',', get_field('email'));
			// print_r($emails);
			$count=count($emails);
			foreach ($emails as $email) {?>

					<a href="mailto:<?php
						$email = preg_replace('/\s+/', '', $email);
						echo $email?>">
						<?php

							echo $email;
						?>
					</a>
					<?php if ($count > 1 ){
							echo ",";
					}
				$count--;
			}
			echo "<br>";
			if( get_field('telefone') ): ?>

					<p>☎ <?php the_field('telefone'); ?></p>

			<?php endif; ?>
				<?php
				// print_r($post);
				$terms = get_the_terms($post->ID, 'tema_fonte');
					// get_terms([
	    // 					'taxonomy' => "tema_fonte",
					// 	]);
				if ($terms){
					$count=count($terms);
					foreach ($terms as $term) {
					?>
					<a href="<?php  echo get_term_link($term->term_id);?>"><?php echo $term->name;
					if ($count > 1){
							echo ", ";
							$count--;
						}
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
