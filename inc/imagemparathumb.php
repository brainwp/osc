<?php 
// imagem_para_thumbnail(1932);
function imagem_para_thumbnail($post){
	// verifica tipo de entrada
	if (is_int($post)) { 
		$noticia = get_page($post) ;
	}
	else if(is_object($post)){
		$noticia = $post;	
	}
	// else if(is_string($post) ){
	// 	$parent_post = get_page_by_title($post, OBJECT, 'post' );
	// }
	else{
		return 'Entrada de post invalida, necessita ser id, objeto ou titulo';
	}
		$noticia_id = $noticia->ID;
	$first_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $noticia->post_content, $imagens);
	$str_sem_imagem = preg_replace('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', 'imagem_fora', $noticia->post_content, 1); // outputs '123def abcdef abcdef'
	// Update post 37
	  $noticia_atualizada = array(
	      'ID'           => $noticia_id,
	      'post_content' => $str_sem_imagem,
	  );

	// Update the post into the database
  	// wp_update_post( $noticia_atualizada );
	echo 'noticia: '.$str_sem_imagem;

	$primeira_imagem = $imagens [1] [0];
	$nome_arquivo = parse_url($primeira_imagem);
	$nome_arquivo = $nome_arquivo['path'];
	echo 'path: '.$nome_arquivo;


	// // Check the type of file. We'll use this as the 'post_mime_type'.
	// $filetype = wp_check_filetype( basename( $filename ), null );
	// // Get the path to the upload directory.
	// $wp_upload_dir = wp_upload_dir();
	// // Prepare an array of post data for the attachment.
	// // return $filename;
	// $filename = str_replace('/alessa/wp-content/uploads/sites/20/', '', $filename);

	// // return $filename;
	// $attachment = array(
	//     'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ), 
	//     'post_mime_type' => $filetype['type'],
	//     'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
	//     'post_content'   => '',
	//     'post_status'    => 'inherit'
	// );
	// // Insert the attachment.
	// $attach_id = wp_insert_attachment( $attachment, $filename );
	 
	// // Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
	// require_once( ABSPATH . 'wp-admin/includes/image.php' );
	 
	// // Generate the metadata for the attachment, and update the database record.
	// $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
	// wp_update_attachment_metadata( $attach_id, $attach_data );
	 
	// set_post_thumbnail( $parent_post_id, $attach_id );
}

function get_first_image() {
	global $post, $posts;
	if (has_post_thumbnail($post->ID )) {
		$first_img = "";
	}
	else{
		$first_img = '';
		ob_start();
		ob_end_clean();
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
		$first_img = $matches [1] [0];
		$first_img = parse_url($first_img);
		if(empty($first_img)){ //Defines a default image
			$first_img = "/images/default.jpg";
		}
	}
	
	return $first_img['path'];
}