
<h2 class="titulo">Banco de fontes</b></h2>
<?php 
	$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

	if ($url != esc_url( home_url( '/bancodefontes/'))) {
		if (isset($wp_query->query['s'])) {
			?>
			<h4 class='resultados-cont'><?php echo $wp_query->query['s'];?><b> retornou <?php echo $wp_query->found_posts; ?></b> itens</h4>
		<?php
		}
		else{
		?>
		<h4 class='resultados-cont'><?php echo $wp_query->queried_object->name;?><b> retornou <?php echo $wp_query->found_posts; ?></b> itens</h4>
		<?php
		}
	}
 ?>


<div class="barra-busca">
	<h6>Busque fontes: </h6>
	<form method="get" class="form-busca" action="<?php echo esc_url( home_url( '/bancodefontes/' ) ); ?>" role="search">
		<label for="navbar-search" class="sr-only">
			<?php _e( 'Search:', 'odin' ); ?>
		</label>
		<div class="form-group">
			<input type="search" value="<?php echo get_search_query(); ?>" class="form-control" name="s" id="navbar-search" />
		</div>
		<button type="submit" class="btn botao-busca"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/lupa.png" alt=""></button>
	</form>
	<h6>Temas: </h6>
	<?php $terms = get_terms( 'tema_fonte' );
	if (is_tax('tema_fonte')){
	  	$term_page = get_queried_object()->term_id;
	  	}
	else{
	 	$selected_todas = ' selected ';
	
	}
	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
	    echo '<select id="temaFonteSelect">';
		echo '<option value="'.esc_url( home_url( '/bancodefontes')).'"'.$selected_todas.'> Todos </option>';
	    foreach ( $terms as $term ) {
	   		if ($term_page == $term->term_id) {
	   			$selected=' selected ';
	   		}
	   		else{
	   			$selected=' ';
	   		}
	   		echo '<option value="'.esc_url( home_url( '/tema_fonte/'.$term->slug ) ).'"'.$selected.'>' . $term->name . '</option>';
	    }
	    echo '</select>';
	}
	else{
		
		echo '<select>';
	    echo '<option value="'.esc_url( home_url( '/bancodefontes')).'"'.$selected.'> Todos </option>';
	    echo '</select>';
	}?> 




	<?php
		
	?>
	<div class="clearfix"></div>
</div>