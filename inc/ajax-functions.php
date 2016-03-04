<?php 

add_action( 'wp_enqueue_scripts', 'ajax_localize', 1 );
function ajax_localize(){
	wp_localize_script( 'odin-main', 'odin_main', array('ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}

function altera_cidade_func(){
	$cod_estado= $_POST['cod_estado'];

	global $wpdb;
	$results = $wpdb->get_results( 'SELECT cod_cidades, nome
			FROM wp_17_w_cidades
			WHERE estados_cod_estados='.$cod_estado.'
			ORDER BY nome', OBJECT );
	echo '<option value="0">Cidade</option>';	

	foreach ($results as $key ) {
		echo '<option value="'.$key->cod_cidades.'">'.$key->nome.'</option>';	
	}
	wp_die();

	
}
add_action( 'wp_ajax_altera_cidade', 'altera_cidade_func' );
add_action( 'wp_ajax_nopriv_altera_cidade', 'altera_cidade_func' );
