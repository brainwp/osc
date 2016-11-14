<?php 

// publicacoes
// publicacoes
// publicacoes
// publicacoes
// publicacoes
add_action( 'init', 'publicacao_cpt' );

function publicacao_cpt() {
	$labels = array(                        
		'name'               => 'Publicações',
		'singular_name'      => 'Publicação',
		'menu_name'          => 'Publicações',
		'name_admin_bar'     => 'Publicações',
		'add_new'            => 'Adicionar nova',
		'add_new_item'       => 'Adicionar nova Publicação',
		'new_item'           => 'Nova Publicações' ,
		'edit_item'          => 'Editar Publicação',
		'view_item'          => 'Ver todas' ,
		'all_items'          => 'Todas' ,
		'search_items'       => 'Buscar',
		'parent_item_colon'  => 'Mãe' ,
		'not_found'          => 'Nenhuma encontrada' ,
		'not_found_in_trash' => 'Nenhuma encontrada na lixeira' ,
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'publicacao' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon' => 'dashicons-book',
		'taxonomies' => array('post_tag'),
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt')
	);

	register_post_type( 'publicacao', $args );
}
// publicacoes
// publicacoes
// publicacoes
// publicacoes
// publicacoes
// publicacoes
// publicacoes

// videos
// videos
// videos
// videos
add_action( 'init', 'video_cpt' );

function video_cpt() {
	$labels = array(                        
		'name'               => 'videos',
		'singular_name'      => 'video',
		'menu_name'          => 'videos',
		'name_admin_bar'     => 'video',
		'add_new'            => 'Adicionar Novo',
		'add_new_item'       => 'Adicionar Novo video',
		'new_item'           => 'Novo video' ,
		'edit_item'          => 'Editar video',
		'view_item'          => 'Ver todos' ,
		'all_items'          => 'Todos' ,
		'search_items'       => 'Buscar',
		'parent_item_colon'  => 'Pai' ,
		'not_found'          => 'Nenhum encontrado' ,
		'not_found_in_trash' => 'Nenhum encontrado na lixeira' ,
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'video' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon' => 'dashicons-format-video',
		'supports'           => array( 'title')
	);

	register_post_type( 'video', $args );
}


// videos
// videos
// videos
// videos
// videos

// slides
// slides
// slides
// slides
add_action( 'init', 'slide_cpt' );

function slide_cpt() {
	$labels = array(                        
		'name'               => 'slides',
		'singular_name'      => 'Slide',
		'menu_name'          => 'Slides',
		'name_admin_bar'     => 'Slide',
		'add_new'            => 'Adicionar Novo',
		'add_new_item'       => 'Adicionar Novo slide',
		'new_item'           => 'Novo slide' ,
		'edit_item'          => 'Editar slide',
		'view_item'          => 'Ver todos' ,
		'all_items'          => 'Todos' ,
		'search_items'       => 'Buscar',
		'parent_item_colon'  => 'Pai' ,
		'not_found'          => 'Nenhum encontrado' ,
		'not_found_in_trash' => 'Nenhum encontrado na lixeira' ,
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'slide' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon' => 'dashicons-images-alt2',
		'supports'           => array( 'title', 'thumbnail')
	);

	register_post_type( 'slide', $args );
}
// slides
// slides
// slides
// slides
// slides



/////////////CPT noticia
/////////////CPT noticia
/////////////CPT noticia
/////////////CPT noticia
add_action( 'init', 'noticia_cpt' );

function noticia_cpt() {
	$labels = array(                        
		'name'               => 'Notícias',
		'singular_name'      => 'Notícia',
		'menu_name'          => 'Notícias',
		'name_admin_bar'     => 'Notícias',
		'add_new'            => 'Adicionar nova',
		'add_new_item'       => 'Adicionar nova Notícia',
		'new_item'           => 'Nova Notícias' ,
		'edit_item'          => 'Editar Notícia',
		'view_item'          => 'Ver todas' ,
		'all_items'          => 'Todas' ,
		'search_items'       => 'Buscar',
		'parent_item_colon'  => 'Mãe' ,
		'not_found'          => 'Nenhuma encontrada' ,
		'not_found_in_trash' => 'Nenhuma encontrada na lixeira' ,
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'noticia' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon' => 'dashicons-rss',
	    'taxonomies' => array('category', 'post_tag'), 
		'supports'           => array( 'title', 'editor', 'thumbnail', 'author', 'excerpt')
	);

	register_post_type( 'noticia', $args );
}
// function add_custom_taxonomies_noticia() {
// 	  // Add new "Locations" taxonomy to Posts
// 	  register_taxonomy('categoria_noticias', 'noticia', array(
// 	    // Hierarchical taxonomy (like categories)
// 	    'hierarchical' => true,
// 	    // This array of options controls the labels displayed in the WordPress Admin UI
// 	    'labels' => array(
// 	      'name' => _x( 'Categoria', 'taxonomy general name' ),
// 	      'singular_name' => _x( 'Categoria', 'taxonomy singular name' ),
// 	      'search_items' =>  __( 'Buscar Categorias' ),
// 	      'all_items' => __( 'Todas Categorias' ),
// 	      'edit_item' => __( 'Editar Categoria' ),
// 	      'update_item' => __( 'Atualizar' ),
// 	      'add_new_item' => __( 'Adicionar nova categoria' ),
// 	      'new_item_name' => __( 'Nova categoria ' ),
// 	      'menu_name' => __( 'Categoria' ),
// 		  'separate_items_with_commas' => __('Separe os itens com virgulas'),
// 		  'choose_from_most_used' => __('Escolha dentre os mais utilizados')
		
	
// 	    ),
// 	    // Control the slugs used for this taxonomy
// 	    'rewrite' => array(
// 	      'slug' => 'categoria', // This controls the base slug that will display before each term
// 	      'with_front' => false, // Don't display the category base before "/locations/"
// 	      'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
// 	    ),
// 	  ));
// 	}

// 	add_action( 'init', 'add_custom_taxonomies_noticia', 0 );
// /////////////////////////////////////////



/////////////CPT prática
add_action( 'init', 'pratica_cpt' );

function pratica_cpt() {
	$labels = array(                        
		'name'               => 'Práticas Alternativas',
		'singular_name'      => 'Pratica alternativa',
		'menu_name'          => 'Praticas Alternativas',
		'name_admin_bar'     => 'Pratica alternativa',
		'add_new'            => 'Adicionar nova',
		'add_new_item'       => 'Adicionar nova pratica alternativa',
		'new_item'           => 'Nova pratica alternativa' ,
		'edit_item'          => 'Editar Pratica alternativa',
		'view_item'          => 'Ver todas' ,
		'all_items'          => 'Todas' ,
		'search_items'       => 'Buscar',
		'parent_item_colon'  => 'Pai' ,
		'not_found'          => 'Nenhuma encontrada' ,
		'not_found_in_trash' => 'Nenhuma encontrada na lixeira' ,
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'pratica' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon' => 'dashicons-store',
		'supports'           => array( 'title', 'thumbnail', 'author')
	);

	register_post_type( 'pratica', $args );
}
/////////////////////////////////////////

	function add_custom_taxonomies() {
	  // Add new "Locations" taxonomy to Posts
	  register_taxonomy('tema', 'pratica', array(
	    // Hierarchical taxonomy (like categories)
	    'hierarchical' => true,
	    // This array of options controls the labels displayed in the WordPress Admin UI
	    'labels' => array(
	      'name' => _x( 'Tema', 'taxonomy general name' ),
	      'singular_name' => _x( 'Tema', 'taxonomy singular name' ),
	      'search_items' =>  __( 'Buscar Temas' ),
	      'all_items' => __( 'Todos temas' ),
	      'edit_item' => __( 'Editar tema' ),
	      'update_item' => __( 'Atualizar' ),
	      'add_new_item' => __( 'Adicionar novo tema' ),
	      'new_item_name' => __( 'Novo tema' ),
	      'menu_name' => __( 'Tema' ),
		  'separate_items_with_commas' => __('Separe os itens com virgulas'),
		  'choose_from_most_used' => __('Escolha dentre os mais utilizados')
		
	
	    ),
	    // Control the slugs used for this taxonomy
	    'rewrite' => array(
	      'slug' => 'tema', // This controls the base slug that will display before each term
	      'with_front' => false, // Don't display the category base before "/locations/"
	      'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
	    ),
	  ));
	// wp_insert_term( 'Agricultura ', 'tema' ); 
	// wp_insert_term( 'Florestas', 'tema' ); 
	// wp_insert_term( 'Energia ', 'tema' ); 
	// wp_insert_term( 'Água', 'tema' ); 
	// wp_insert_term( 'Habitação', 'tema' ); 
	// wp_insert_term( 'Transporte	', 'tema' ); 
	// wp_insert_term( 'Cidade', 'tema' ); 
	// wp_insert_term( 'Saúde popular', 'tema' ); 
	// wp_insert_term( 'Literatura ', 'tema' ); 
	// wp_insert_term( 'Arte ', 'tema' ); 
	// wp_insert_term( 'Comunicação', 'tema' ); 
	// wp_insert_term( 'Práticas democráticas', 'tema' ); 


	// $agricultura = ['Agroecologia','Solos ','Sementes ','Alimentos ','Relação entre produtores e consumidores'];
	// $florestas = ['Sistemas agroflorestais ','Reservas extrativistas ','Reservas ambientais ','Recriação de florestas'];
	// $energia = ['Energias renováveis' , 'Conservação de energia','Eficiência energética'];

	// $term=get_term_by ( 'slug', 'florestas', 'tema');

	// foreach ($florestas as $filho) {
	// 	wp_insert_term( $filho, 'tema', array('parent'=>$term->term_id) ); 
	// }
	}
	add_action( 'init', 'add_custom_taxonomies', 0 );
	//metaboxes//
	// metaboxes//
// $galeria_metabox = new Odin_Metabox(
//     'galeria1', // Slug/ID do Metabox (obrigatório)
//     'Galeria de Imagens', // Nome do Metabox  (obrigatório)
//     'pratica', // Slug do Post Type, sendo possível enviar apenas um valor ou um array com vários (opcional)
//     'advanced', // Contexto (opções: normal, advanced, ou side) (opcional)
//     'low' // Prioridade (opções: high, core, default ou low) (opcional)
// );
// $galeria_metabox->set_fields(
//     array(
//         array(
//     	'id'          => 'galeria1_pratica', // Obrigatório
//     	'label'       => __( 'Imagens da prática', 'odin' ), // Obrigatório
//     	'type'        => 'image_plupload', // Obrigatório
//     	'default'     => '', // Opcional (deve ser o id de uma imagem em mídias, separe os ids com virtula)
//     	'description' => __( 'Selecione as imagens da galeria', 'odin' ), // Opcional
// )
//     )
// );
// metaboxes//

/////////////CPT contatos
/////////////CPT contatos
/////////////CPT contatos
/////////////CPT contatos
add_action( 'init', 'feedback_cpt' );

function feedback_cpt() {
	$labels = array(                        
		'name'               => 'Feedback',
		'singular_name'      => 'Feedback',
		'menu_name'          => 'Feedback',
		'name_admin_bar'     => 'Feedback',
		'add_new'            => 'Adicionar novo',
		'add_new_item'       => 'Adicionar novo Feedback',
		'new_item'           => 'Novo Feedback' ,
		'edit_item'          => 'Editar Feedback',
		'view_item'          => 'Ver todos' ,
		'all_items'          => 'Todos' ,
		'search_items'       => 'Buscar',
		'parent_item_colon'  => 'Mãe' ,
		'not_found'          => 'Nenhum encontrado' ,
		'not_found_in_trash' => 'Nenhum encontrado na lixeira' ,
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'feedback' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon' => 'dashicons-rss',
		'supports'           => array( 'title', 'editor', 'thumbnail', 'author', 'excerpt')
	);

	register_post_type( 'feedback', $args );
}