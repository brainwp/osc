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


function pega_sub_func(){
	$mae= $_POST['mae'];
  	if ( count( get_term_children( $mae, 'tema' ) ) !== 0 ) {
		drop_tags('SubTema', 'tema', 0, "sub-tema-continua-cadastro_".$mae, 0, $mae); 
	 }

	
	wp_die();

	
}
add_action( 'wp_ajax_pega_sub', 'pega_sub_func' );
add_action( 'wp_ajax_nopriv_pega_sub', 'pega_sub_func' );

// cadastro de pratica
function cadastra_pratica_func(){
	$data= $_POST;
	$cadastra_usuario = ajax_cadastra_usuario($data['nome_da_entidade'], $data['e-mail_da_entidade'], $data['senha'], $data['site_da_entidade']);
	
	if (is_int($cadastra_usuario)){
		$pratica = array(
    		'post_title' => $data['title'],
    		'post_status' => 'draft',
    		'post_type' => 'pratica',
    		'post_author' => $cadastra_usuario
    	);
		$pratica_id =  wp_insert_post( $pratica );

	


		foreach ($data as $key => $value) {
			if ($key!=='action' && $key !== 'title' && $key!=='tax') {
				update_field($key, $value,$pratica_id );
			}

		}
		wp_set_post_terms( $pratica_id, $data['tax'], 'tema', true );
		update_field('video',$att['url'],'https://www.youtube.com/watch?v=I38EcMJX8A8');


		echo '<h3>Obrigado, sua prátia ira ser analizada e publicada futuramente.</h3>';

		wp_die();

	}
	else {
		echo $cadastra_usuario;
		wp_die();
	}

	print_r($data);
	
		wp_die();


}
add_action( 'wp_ajax_cadastra_pratica', 'cadastra_pratica_func' );
add_action( 'wp_ajax_nopriv_cadastra_pratica', 'cadastra_pratica_func' );
// cadastro de pratica




// cadastro de usuario
function ajax_cadastra_usuario($nome, $email, $senha, $site){
	$user_email = get_user_by( 'email', $email);
	echo username_exists( 'ssssssffff' );
	if ( $user_email !== false && wp_check_password(  $senha, $user_email->data->user_pass, $user->ID ) ){
		 return $user_email->ID;
	wp_die();

	}
	else if (email_exists($email) !== false  || username_exists( $nome )){
		return 'E-mail ja cadastrado e senha não confere';
			wp_die();

	}
	else if ( !empty($nome) && !empty($email) && !empty($senha)) {
		$userdata = array(
 		   'user_login'  =>  $nome,
 		   'user_email'  =>  $email,
 		   'user_url'    =>  $site,
 		   'user_pass'   =>  $senha, // When creating an user, `user_pass` is expected.
 		   'role'		 =>  'entidade'
	);
	$user_id = wp_insert_user( $userdata );	

	return $user_id;
	} 
	else{
		return 'Algo não foi preenchido';
	}
	wp_die();
}
// cadastro de usuario

