<?php
/**
 * Odin functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * @package Odin
 * @since 2.2.0
 */

/**
 * Sets content width.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 600;
}

/**
 * Odin Classes.
 */
require_once get_template_directory() . '/core/classes/class-bootstrap-nav.php';
require_once get_template_directory() . '/core/classes/class-shortcodes.php';
//require_once get_template_directory() . '/core/classes/class-shortcodes-menu.php';
require_once get_template_directory() . '/core/classes/class-thumbnail-resizer.php';
require_once get_template_directory() . '/core/classes/class-theme-options.php';
require_once get_template_directory() . '/inc/options.php';
// require_once get_template_directory() . '/inc/imagemparathumb.php';


// require_once get_template_directory() . '/core/classes/class-options-helper.php';
// require_once get_template_directory() . '/core/classes/class-post-type.php';
// require_once get_template_directory() . '/core/classes/class-taxonomy.php';
require_once get_template_directory() . '/core/classes/class-metabox.php';
// require_once get_template_directory() . '/core/classes/abstracts/abstract-front-end-form.php';
// require_once get_template_directory() . '/core/classes/class-contact-form.php';
// require_once get_template_directory() . '/core/classes/class-post-form.php';
// require_once get_template_directory() . '/core/classes/class-user-meta.php';
// require_once get_template_directory() . '/core/classes/class-post-status.php';
//require_once get_template_directory() . '/core/classes/class-term-meta.php';

/**
 * Odin Widgets.
 */
require_once get_template_directory() . '/core/classes/widgets/class-widget-like-box.php';

if ( ! function_exists( 'odin_setup_features' ) ) {

	/**
	 * Setup theme features.
	 *
	 * @since 2.2.0
	 */
	function odin_setup_features() {

		/**
		 * Add support for multiple languages.
		 */
		load_theme_textdomain( 'odin', get_template_directory() . '/languages' );

		/**
		 * Register nav menus.
		 */
		register_nav_menus(
			array(
				'main-menu' => __( 'Main Menu', 'odin' ),
				'footer-menu' => __( 'Rodapé Menu', 'odin' ),
				'busca-menu' => __( 'Busca Menu', 'odin' ),
				'banco-menu' => __( 'Banco Menu', 'odin' )
			)
		);

		/*
		 * Add post_thumbnails suport.
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Add feed link.
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Support Custom Header.
		 */
		$default = array(
			'width'         => 0,
			'height'        => 0,
			'flex-height'   => false,
			'flex-width'    => false,
			'header-text'   => false,
			'default-image' => '',
			'uploads'       => true,
		);

		add_theme_support( 'custom-header', $default );

		/**
		 * Support Custom Background.
		 */
		$defaults = array(
			'default-color' => '',
			'default-image' => '',
		);

		add_theme_support( 'custom-background', $defaults );

		/**
		 * Support Custom Editor Style.
		 */
		add_editor_style( 'assets/css/editor-style.css' );

		/**
		 * Add support for infinite scroll.
		 */
		add_theme_support(
			'infinite-scroll',
			array(
				'type'           => 'scroll',
				'footer_widgets' => false,
				'container'      => 'content',
				'wrapper'        => false,
				'render'         => false,
				'posts_per_page' => get_option( 'posts_per_page' )
			)
		);

		/**
		 * Add support for Post Formats.
		 */
		// add_theme_support( 'post-formats', array(
		//     'aside',
		//     'gallery',
		//     'link',
		//     'image',
		//     'quote',
		//     'status',
		//     'video',
		//     'audio',
		//     'chat'
		// ) );

		/**
		 * Support The Excerpt on pages.
		 */
		// add_post_type_support( 'page', 'excerpt' );

		/**
		 * Switch default core markup for search form, comment form, and comments to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption'
			)
		);

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
	}
}

add_action( 'after_setup_theme', 'odin_setup_features' );

/**
 * Register widget areas.
 *
 * @since 2.2.0
 */
function odin_widgets_init() {
	register_sidebar(
		array(
			'name' => __( 'Main Sidebar', 'odin' ),
			'id' => 'main-sidebar',
			'description' => __( 'Site Main Sidebar', 'odin' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widgettitle widget-title">',
			'after_title' => '</h3>',
		)
	);
}

add_action( 'widgets_init', 'odin_widgets_init' );

/**
 * Flush Rewrite Rules for new CPTs and Taxonomies.
 *
 * @since 2.2.0
 */
function odin_flush_rewrite() {
	flush_rewrite_rules();
}

add_action( 'after_switch_theme', 'odin_flush_rewrite' );

/**
 * Load site scripts.
 *
 * @since 2.2.0
 */
function odin_enqueue_scripts() {
	$template_url = get_template_directory_uri();

	// Loads Odin main stylesheet.
	wp_enqueue_style( 'odin-style', get_stylesheet_uri(), array(), null, 'all' );
	wp_enqueue_style( 'custom-style', $template_url . '/assets/css/custom.css', array(), null, 'all' );
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300|Ubuntu:400,300,300italic,400italic,500,500italic', array(), null, 'all' );
	if( is_page_template('page-equipe.php') OR is_home()) { 
		wp_enqueue_script( 'owl-js',$template_url .'/inc/owl-carousel/owl-carousel/owl.carousel.js', array(), null, true );
		wp_enqueue_style( 'owl-style', $template_url .'/inc/owl-carousel/owl-carousel/owl.carousel.css', array(), null, 'all' );
		wp_enqueue_style( 'owl-theme', $template_url .'/inc/owl-carousel/owl-carousel/owl.theme.css', array(), null, 'all' );

 	}
	// jQuery.
	wp_enqueue_script( 'jquery' );

		// Bootstrap.
		wp_enqueue_script( 'bootstrap', $template_url . '/assets/js/libs/bootstrap.min.js', array(), null, true );

		// FitVids.
		wp_enqueue_script( 'fitvids', $template_url . '/assets/js/libs/jquery.fitvids.js', array(), null, true );

		// Main jQuery.
		wp_enqueue_script( 'odin-main', $template_url . '/assets/js/main.js', array(), null, true );


	// Load Thread comments WordPress script.
	if ( is_singular() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'odin_enqueue_scripts', 1 );

/**
 * Odin custom stylesheet URI.
 *
 * @since  2.2.0
 *
 * @param  string $uri Default URI.
 * @param  string $dir Stylesheet directory URI.
 *
 * @return string      New URI.
 */
function odin_stylesheet_uri( $uri, $dir ) {
	return $dir . '/assets/css/style.css';
}

add_filter( 'stylesheet_uri', 'odin_stylesheet_uri', 10, 2 );

/**
 * Query WooCommerce activation
 *
 * @since  2.2.6
 *
 * @return boolean
 */
if ( ! function_exists( 'is_woocommerce_activated' ) ) {
	function is_woocommerce_activated() {
		return class_exists( 'woocommerce' ) ? true : false;
	}
}

/**
 * Core Helpers.
 */
require_once get_template_directory() . '/core/helpers.php';

/**
 * WP Custom Admin.
 */
require_once get_template_directory() . '/inc/admin.php';

/**
 * Comments loop.
 */
require_once get_template_directory() . '/inc/comments-loop.php';

/**
 * WP optimize functions.
 */
require_once get_template_directory() . '/inc/optimize.php';

/**
 * Custom template tags.
 */
require_once get_template_directory() . '/inc/template-tags.php';

/**
 * WooCommerce compatibility files.
 */
if ( is_woocommerce_activated() ) {
	add_theme_support( 'woocommerce' );
	require get_template_directory() . '/inc/woocommerce/hooks.php';
	require get_template_directory() . '/inc/woocommerce/functions.php';
	require get_template_directory() . '/inc/woocommerce/template-tags.php';
}
add_post_type_support('page', 'excerpt');


/**
*custom post types
*/
require_once get_template_directory() . '/inc/custom-post.php';
/**
*custom fields
*/
require_once get_template_directory() . '/inc/custom-fields.php';
/**
*funcoes do ajax
*/
require_once get_template_directory() . '/inc/ajax-functions.php';

// add_action("after_switch_theme", "cria_cidades"); 

// global $wpdb;
// $table_name = $wpdb->prefix.'w_cidades';
// if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
//      $charset_collate = $wpdb->get_charset_collate();
//      $sql = "CREATE TABLE $table_name(
// 	  `estados_cod_estados` int(11) DEFAULT NULL,
// 	  `cod_cidades` int(11) DEFAULT NULL,
// 	  `nome` varchar(72) COLLATE utf8_unicode_ci DEFAULT NULL,
// 	  `cep` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL
// 	) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
//      require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
//      dbDelta( $sql );


// }
// $table_name_est = $wpdb->prefix.'w_estados';
// if($wpdb->get_var("SHOW TABLES LIKE '$table_name_est'") != $table_name) {
//      $charset_collate = $wpdb->get_charset_collate();
//      $sql = "CREATE TABLE $table_name_est(
// 	  `cod_estados` int(11) DEFAULT NULL,
//   `sigla` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
//   `nome` varchar(72) COLLATE utf8_unicode_ci DEFAULT NULL
// ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
//      require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
//      dbDelta( $sql );
// }

function cria_cidades(){
	
}

function drop_tags($nome,$tax,$cont,$id, $esconde=0, $mae='')
{?>
		<?php wp_dropdown_categories( 'show_option_none='.$nome.'&hierarchical=true&depth=1&child_of='.$mae.'&hide_empty='.$esconde.'&option_none_value=&taxonomy='.$tax.'&show_count='.$cont.'&class=ajax-filtro-materiais taxonomia'.$tax.'&id='.$id.'&name='.$tax.'&option_none_value=0'); ?>
<?php
}

// remove_role( 'entidade' ); 


$result = add_role(
    'entidade',
    __( 'Entidade' ),
    array(
        'read'         => true,  // true allows this capability
        'edit_posts'   => true,
        'delete_posts' => true, // Use false to explicitly deny
    	'edit_published_posts' => true,
    )
);


add_filter( 'manage_edit-pratica_columns', 'colunas_praticas' ) ;

function colunas_praticas( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Prática Alternativa' ),
		'author' => __( 'Entidade' ),
		'date' => __( 'Date' )
	);

	return $columns;
}

add_image_size('pratica-lista', 200, 200, 1 );
add_image_size('quadrada', 400, 400, 1 );
add_image_size('thumb-page', 996, 330, 1 );
add_image_size('destaques-categoria', 350, 350, 1 );
add_image_size('slider-2', 660, 415, 1 );
add_image_size('slider-1', 1280, 400, 1 );
function kv_handle_attachment($file_handler,$post_id,$set_thu=true) {
	// check to make sure its a successful upload
	if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) __return_false();

	require_once(ABSPATH . "wp-admin" . '/includes/image.php');
	require_once(ABSPATH . "wp-admin" . '/includes/file.php');
	require_once(ABSPATH . "wp-admin" . '/includes/media.php');

	$attach_id = media_handle_upload( $file_handler, $post_id );

         // If you want to set a featured image frmo your uploads. 
	if ($set_thu) set_post_thumbnail($post_id, $attach_id);
	return $attach_id;
}
show_admin_bar(false);


//remove wordpress authentication
remove_filter('authenticate', 'wp_authenticate_username_password', 20);
add_filter('authenticate', function($user, $email, $password){

    //Check for empty fields
        if(empty($email) || empty ($password)){        
            //create new error object and add errors to it.
            $error = new WP_Error();

            if(empty($email)){ //No email
                $error->add('empty_username', __('<strong>Erro</strong>: E-mail está em branco.'));
            }
            else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ //Invalid Email
                $error->add('invalid_username', __('<strong>Erro</strong>: E-mail é inválido.'));
            }

            if(empty($password)){ //No password
                $error->add('empty_password', __('<strong>Erro</strong>: Senha está em branco.'));
            }

            return $error;
        }

        //Check if user exists in WordPress database
        $user = get_user_by('email', $email);

        //bad email
        if(!$user){
            $error = new WP_Error();
            $error->add('invalid', __('<strong>Erro</strong>: E-mail ou senha inválidos.'));
            return $error;
        }
        else{ //check password
            if(!wp_check_password($password, $user->user_pass, $user->ID)){ //bad password
                $error = new WP_Error();
                $error->add('invalid', __('<strong>Erro</strong>: E-mail ou senha inválidos.'));
                return $error;
            }else{
                return $user; //passed
            }
        }
}, 20, 3);
add_filter('login_redirect', '_catch_login_error', 10, 3);
 
function _catch_login_error($redir1, $redir2, $wperr_user)
{	
    if(!is_wp_error($wperr_user) || !$wperr_user->get_error_code()) return $redir1;
    if (isset($_SERVER["HTTP_REFERER"])) {
	 	$url=parse_url(($_SERVER["HTTP_REFERER"]));
		if ($url['host'].$url['path']=='http://rede.com.br/osc/edicao-de-praticas-existentes/') {

		    switch($wperr_user->get_error_code())
		    {   
		    	case 'invalid':
		        	$erro=urlencode("Senha não confere ou e-mail incorreto.");
		            wp_redirect($url['host'].$url['path'].'/?erro='.$erro); 
		        
		    }
		 }
    }
	    return $redir1;

}
add_action( 'wp_authenticate', '_catch_empty_user', 1, 2 );

function _catch_empty_user( $username, $pwd ) {
	if (isset($_SERVER["HTTP_REFERER"])) {
	 	$url=parse_url(($_SERVER["HTTP_REFERER"]));
		if ($_SERVER["HTTP_REFERER"]=='http://rede.com.br/osc/edicao-de-praticas-existentes/') {
			if ( empty( $username ) ) {
			  	    $erro= urlencode("E-mail em branco");

			        wp_redirect($url['host'].$url['path'].'/?erro='.$erro); 
			    exit();
			  }
			  elseif( empty($pwd)){
			  		$erro= urlencode("Senha em branco");

			        wp_redirect($url['host'].$url['path'].'/?erro='.$erro); 
			  }
		}
	}
  
}
function my_custom_admin_styles() {
   ?>
        <style type="text/css">
          .post-type-slide #edit-slug-box {
               display: none;
           }
           .add-category {
           	display: none;
           }
           .add-category {
    			display: block!important;
			}
         </style>
    <?php
}
add_action('admin_head', 'my_custom_admin_styles');

function custom_excerpt_length( $length ) {
	return 25;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
function fix_category_pagination($qs){
    if(isset($qs['category_name']) && isset($qs['paged'])){
        $qs['post_type'] = get_post_types($args = array(
            'public'   => true,
            '_builtin' => false
        ));
        array_push($qs['post_type'],'post');
    }
    return $qs;
}
add_filter('request', 'fix_category_pagination');

// tag_pra_categoria();
function tag_pra_categoria(){
	$alteracoes = array(
		"OSC" => array(	
			'OSCs',
			'Sociedade Civil',
			'OSC',
			'Financiamento',
			'Edital',
			'Editais',
			'marco regulatório',
			'MROSC',
			'#MROSC',
			'#VaiTerMROSC',
			'Sociedade Civil',
			'Sociedade Civil Organizada',
			'Direitos e bens comuns',
			'organizações não governamentais',
			'abong',
			'oscs',
			'sociedade civil',
			'osc',
			'financiamento',
			'edital',
			'editais',
			'marco regulatório',
			'mrosc',
			'#mrosc',
			'#vaitermrosc',
			'sociedade civil',
			'sociedade civil organizada',
			'direitos e bens comuns',
			'organizações não governamentais',
			'abong'
		),
		"Direitos" => array(	
			'Direitos',
			'Direitos sociais',
			'Feminismo',
			'Juventude',
			'Violência policial',
			'Educação',
			'#Educação',
			'Indígenas',
			'mulher',
			'Saúde',
			'#Saúde',
			'PNE',
			'FNDC',
			'Democratização da comunicação',
			'Direitos humanos',
			'Violência',
			'redução da maioridade penal',
			'índios',
			'direitos trabalhistas',
			'gênero',
			'lgbt',
			'lei da mídia democrática',
			'racismo',
			'machismo',
			'Mídia',
			'Comunicação',
			'direitos',
			'direitos sociais',
			'feminismo',
			'juventude',
			'violência policial',
			'educação',
			'#educação',
			'indígenas',
			'mulher',
			'saúde',
			'#saúde',
			'pne',
			'fndc',
			'democratização da comunicação',
			'direitos humanos',
			'violência',
			'redução da maioridade penal',
			'índios',
			'direitos trabalhistas',
			'gênero',
			'lgbt',
			'lei da mídia democrática',
			'racismo',
			'machismo',
			'mídia',
			'comunicação',
		),
		"Movimentos" => array(	
			'Movimentos',
			'Movimentos sociais',
			'Manifestação',
			'Movimento sindical',
			'Mst',
			'Manifestações',
			'Protestos',
			'movimentos',
			'movimentos sociais',
			'manifestação',
			'movimento sindical',
			'mst',
			'manifestações',
			'protestos',
		),
		"Democracia" => array(	
			'Democracia',
			'Participação social',
			'participação',
			'Reforma política',
			'Democracia participativa',
			'Transparência',
			'Câmara dos deputados',
			'Senado',
			'Dilma Rousseff',
			'Michel Temer',
			'Fora Temer',
			'Congresso nacional',
			'Políticas públicas',
			'Polícia militar',
			'Golpe',
			'Impeachment',
			'Eduardo Cunha',
			'democracia',
			'participação social',
			'participação',
			'reforma política',
			'democracia participativa',
			'transparência',
			'câmara dos deputados',
			'senado',
			'dilma rousseff',
			'michel temer',
			'fora temer',
			'congresso nacional',
			'políticas públicas',
			'polícia militar',
			'golpe',
			'impeachment',
			'eduardo cunha',
		),
		"Novos paradigmas" => array(	
			"Novos paradigmas de desenvolvimento",
			"Novos modelos de desenvolvimento",
			"Meio ambiente",
			"Agricultura",
			"Agroecologia",
			"Agricultura familiar",
			"Segurança alimentar",
			"Água",
			"ODS",
			"novos paradigmas de desenvolvimento",
			"novos modelos de desenvolvimento",
			"meio ambiente",
			"agricultura",
			"agroecologia",
			"agricultura familiar",
			"segurança alimentar",
			"água",
			"ods",
		)


	);
// echo "<pre>";
// print_r( $alteracoes);
// 	echo "</pre>";
	// get_term( $term, $taxonomy, $output, $filter );
	foreach ($alteracoes as $tags ) {
		// echo "<pre>";
		// print_r( array_search($tags, $alteracoes));
		// echo "</pre>";
		$postlist = get_posts( 
		array(	
			'posts_per_page'   => -1,
			'post_type'=>'noticia',
			'tax_query' => array(
				array(
					'taxonomy' => 'post_tag',
					'field' => 'name',
					'terms' => $tags
				)
			)
		)
		);
		// print_r(count($postlist));
		foreach ( $postlist as $post ) {
			$category = get_term_by('name',array_search($tags, $alteracoes), 'category');
			// print_r($post->ID);
			// echo " ";
			wp_set_post_categories( $post->ID, $category, true ) ;
		}
	}
	

	// wp_update_post( array('ID'=>1929, 'post_category' => 'OSC'  ) );
	
	// echo "<pre>";
	// print_r($posts);
	// echo '</pre>';

}
function SearchFilter($query) {
	if (isset($query->query['post_type'])){
	
		if ($query->is_search AND $query->query['post_type'] != 'pratica' AND $query->query['post_type'] != 'fonte' ) {
			$query->set('post_type', array('noticia','publicacao', 'video'));
		}

		return $query;
	}
	elseif ($query->is_search){
		$query->set('post_type', array('noticia','publicacao', 'video'));
		return $query;
	}


}

add_filter('pre_get_posts','SearchFilter');

function busca_tax( $where, &$wp_query )
// busca nos nomes dos termos o valor inserido no formulario de busca padrao do wordpress
// trocar 'fonte pelo CPT e 'tema_fonte' pelo nome da sua taxonomia

{
   		global $wpdb;
    	global $wp_query;
   	if (isset($wp_query->query['post_type'])){
		if ($wp_query->is_main_query() AND $wp_query->is_search AND $wp_query->query['post_type'] == 'fonte' ) {
			$busca = $_GET['s']; 
			$where .= " 
				OR $wpdb->posts.ID 
				IN (SELECT tr.object_id 
					FROM $wpdb->term_relationships 
					AS tr 
					INNER JOIN $wpdb->term_taxonomy 
					AS tt 
					ON tr.term_taxonomy_id = tt.term_taxonomy_id 
					WHERE tt.taxonomy = 'tema_fonte'  
					AND tt.term_id 
					IN (SELECT t.term_id 
						FROM $wpdb->terms 
						AS t 
						WHERE name 
						LIKE '%$busca%'
					)
				)";  
		return $where;

		}
		
	}  

	return $where; 
}

add_filter( 'posts_where', 'busca_tax', 10, 2 );
