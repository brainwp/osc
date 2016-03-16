<?php 
/////////////CPT escola
add_action( 'init', 'pratica_cpt' );

function pratica_cpt() {
	$labels = array(                        
		'name'               => 'praticas Alternativas',
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
		'not_found'          => 'Nenhuma encontrado' ,
		'not_found_in_trash' => 'Nenhuma encontrado na lixeira' ,
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
		'supports'           => array( 'title', 'thumbnail')
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
