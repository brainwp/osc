<?php 
function opcoes_tema() {

    $settings = new Odin_Theme_Options(
        'odin-settings', // Slug/ID of the Settings Page (Required)
        'Opções do tema', // Settings page name (Required)
        'manage_options' // Page capability (Optional) [default is manage_options]
    );

    $settings->set_tabs(
        array(
            
			array(
                'id' => 'odin_general', // Slug/ID of the Settings tab (Required)
                'title' => __( 'Home', 'odin' ), // Settings tab title (Required)
            ),
			
           
        )
    );
    $categorias=get_categories( array('orderby' => 'name', 'order'   => 'ASC', 'exclude'=>'213' ) );
    $lista_cat=array(""=>"");
    $terms = get_terms( 'categoria_noticias' );
                // print_r($terms);
                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
                    foreach ( $terms as $term ) {
                       $lista_cat[$term->term_id]=$term->name;
                    }
                }

    // foreach ($categorias as $category) {
    //      $lista_cat[$category->term_id]=$category->name;
    //  } 
    // print_r($lista_cat);
    $settings->set_fields(
        array(
			
            'odin_general_fields_section' => array( // Slug/ID of the section (Required)
                'tab'   => 'odin_general', // Tab ID/Slug (Required)
                'title' => __( 'Configurações do tema', 'odin' ), // Section title (Required)
                'fields' => array( // Section fields (Required)
					
                    array(
                        'id'         => 'facebook', // Required
                        'label'      => __( 'Facebook', 'odin' ), // Required
                        'type'       => 'text', // Required
                    ),
                    array(
                        'id'         => 'twitter', // Required
                        'label'      => __( 'Twitter', 'odin' ), // Required
                        'type'       => 'text', // Required
                    ),
                    array(
                        'id'         => 'youtube', // Required
                        'label'      => __( 'Youtube', 'odin' ), // Required
                        'type'       => 'text', // Required
                    ),
                     array(
                        'id'         => 'logo_abong', // Required
                        'label'      => __( 'Logo Abong', 'odin' ), // Required
                        'type'       => 'image', // Required
                    ),
                    
					array(
                        'id'            => 'cat_home', // Obrigatório
                        'label'         => __( 'Categoria de destaque', 'odin' ), // Obrigatório
                        'type'          => 'select', // Obrigatório
                        // 'attributes' => array(), // Opcional (atributos para input HTML/HTML5)
                        'description'   => __( 'Escolha a categoria selecionada na seção de destaque da home', 'odin' ), // Opcional
                        'options'       => $lista_cat
                    )
					
				)
            ),
			
         )
    );
    
}

add_action( 'init', 'opcoes_tema', 1 );
?>