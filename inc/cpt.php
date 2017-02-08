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