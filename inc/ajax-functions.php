<?php 

add_action( 'wp_enqueue_scripts', 'ajax_localize', 1 );
function ajax_localize(){
	wp_localize_script( 'odin-main', 'odin_main', array('ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}

function altera_cidade_func(){
	$cod_estado= $_POST['cod_estado'];

	global $wpdb;
	$results = $wpdb->get_results( 'SELECT cod_cidades, nome
			FROM '.$wpdb->prefix.'w_cidades
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
		// update_field('video',$att['url'],'https://www.youtube.com/watch?v=I38EcMJX8A8');
		set_post_thumbnail( $pratica_id, $data['imagem_destacada'] ); 
		

			echo '<h3>Obrigado, sua prátia ira ser analizada e publicada futuramente.</h3>';

		wp_die();

	}
	else {
		echo '<p>'.$cadastra_usuario.'</p>';
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


// add_action( 'wp_enqueue_scripts', 'ibenic_enqueue' );



add_action('wp_ajax_ibenic_file_upload', 'ibenic_file_upload' );
add_action('wp_ajax_nopriv_ibenic_file_upload', 'ibenic_file_upload' );

function ibenic_file_upload() {
	$usingUploader = 2;
	$fileErrors = array(
		0 => "There is no error, the file uploaded with success",
		1 => "The uploaded file exceeds the upload_max_files in server settings",
		2 => "The uploaded file exceeds the MAX_FILE_SIZE from html form",
		3 => "The uploaded file uploaded only partially",
		4 => "No file was uploaded",
		6 => "Missing a temporary folder",
		7 => "Failed to write file to disk",
		8 => "A PHP extension stoped file to upload" );
	$posted_data =  isset( $_POST ) ? $_POST : array();
	$file_data = isset( $_FILES ) ? $_FILES : array();
	$data = array_merge( $posted_data, $file_data );
	$response = array();
	if( $usingUploader == 1 ) {
		$uploaded_file = wp_handle_upload( $data['ibenic_file_upload'], array( 'test_form' => false ) );
		if( $uploaded_file && ! isset( $uploaded_file['error'] ) ) {
			$response['response'] = "SUCCESS";
			$response['filename'] = basename( $uploaded_file['url'] );
			$response['url'] = $uploaded_file['url'];
			$response['type'] = $uploaded_file['type'];
		} else {
			$response['response'] = "ERROR";
			$response['error'] = $uploaded_file['error'];
		}
	} elseif ( $usingUploader == 2) {
		$attachment_id = media_handle_upload( 'ibenic_file_upload', 0 );
		if ( is_wp_error( $attachment_id ) ) { 
			$response['response'] = "ERROR";
			$response['error'] = $fileErrors[ $data['ibenic_file_upload']['error'] ];
		} else {
			$fullsize_path = get_attached_file( $attachment_id );
			$pathinfo = pathinfo( $fullsize_path );
			$url = wp_get_attachment_url( $attachment_id );
			$response['response'] = "SUCCESS";
			$response['filename'] = $pathinfo['filename'];
			$response['url'] = $url;
			$response['id'] = $attachment_id;
			$type = $pathinfo['extension'];
			if( $type == "jpeg"
			|| $type == "jpg"
			|| $type == "png"
			|| $type == "gif" ) {
				$type = "image/" . $type;
			}
			$response['type'] = $type;
		}
	}
	echo json_encode( $response );
	die();
}


add_action('wp_ajax_nopriv_ibenic_file_delete', 'ibenic_file_delete');
add_action('wp_ajax_ibenic_file_delete', 'ibenic_file_delete');
function ibenic_file_delete() {
	if( isset( $_POST ) ){
		global $wpdb;
	
		$fileurl = $_POST['fileurl'];
		$response = array();
	
		$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $fileurl ));
		
		if( $attachment ){
			$attachmentID = $attachment[0];
			if ( false === wp_delete_attachment( $attachmentID ) ) {
	
				$response['response'] = "ERROR";
				$response['error'] = 'File could not be deleted';
	
			} else {
				$response['response'] = "SUCCESS";
			}
		} else {
			$filename = basename( $fileurl );
			$upload_dir = wp_upload_dir();
	    		$upload_path = $upload_dir["basedir"]."/custom/";
	    		$uploaded_file = $upload_path . $filename;
			if(file_exists($uploaded_file)){
			
				@unlink($uploaded_file);
				$response['response'] = "SUCCESS";
			
			} else {
				$response['response'] = "ERROR";
				$response['error'] = 'File does not exist';
			}
		}
		
		echo json_encode( $response );
	} 
	die();
}