<?php

	function tatwerat_startSession() {

		if(!session_id()) {
			session_start();
		}
	}

	define('VALOR_ENTREGA', 5.00 );
	define('VALOR_ENTREGA_G', "5,00" );


	$current_user = wp_get_current_user();		
	$parceiros = pods( 'user', $current_user->ID );
	$parceiro = $parceiros->field('parceiro');
	define('PARTNER', $parceiro['id'] );
		

	


	add_action('init', 'tatwerat_startSession', 1);

	define('IMG', get_template_directory_uri().'/assets/img');
	define('CSS', get_template_directory_uri().'/assets/css');
	define('JS', get_template_directory_uri().'/assets/js');
	define('LIB', get_template_directory_uri().'/assets/lib');
	define('IMAGES', get_template_directory_uri().'/assets/images');

	require_once (__DIR__.'/lib/wp-database-custom.php');
	require_once (__DIR__.'/lib/wp-posts-custom.php');
	require_once (__DIR__.'/lib/wp-wordpress-actions.php');
	require_once (__DIR__.'/lib/save-address.php');
	


	function load_scripts()
	{


		/* Registering style */
		wp_register_style( 'bootstrapcss', CSS . '/bootstrap.min.css', array(), '0.0.1', false );
		wp_register_style( 'animatecss', LIB . '/animate/animate.min.css', array(), '0.0.1', false );
		wp_register_style( 'font-awesomecss', LIB . '/font-awesome/css/font-awesome.min.css', array(), '0.0.1', false );
		wp_register_style( 'ioniconscss', LIB . '/ionicons/css/ionicons.min.css', array(), '0.0.1', false );
		wp_register_style( 'magnific-popupcss', LIB . '/magnific-popup/magnific-popup.css', array(), '0.0.1', false );
		wp_register_style( 'appcss', CSS . '/app.css', array(), '0.0.5', false );

		//wp_register_style('swipercss', CSS . '/swiper.css', array(), '0.0.1', false );
		//wp_register_style('style_css', CSS . '/app.css', array(), '0.0.4', false );


		/* Registering scripts */
		//wp_register_script( 'swiperjs', JS . '/swiper.js', array('jquery'), '0.0.1');
		wp_register_script( 'jqueryjs', LIB . '/jquery-migrate.min.js', array(), '0.0.1' );
		wp_register_script( 'bootstrapjs', JS . '/bootstrap.min.js', array('jquery'), '0.0.1');
		wp_register_script( 'bootsbund', LIB . '/bootstrap/js/bootstrap.bundle.min.js', array(), '0.0.1' );
		wp_register_script( 'easingjs', LIB . '/easing/easing.min.js', array(), '0.0.1' );
		wp_register_script( 'wowjs', LIB . '/wow/wow.min.js', array(), '0.0.1' );
		wp_register_script( 'hoverintent', LIB . '/superfish/hoverIntent.js', array(), '0.0.1' );
		wp_register_script( 'superfishjs', LIB . '/superfish/superfish.min.js', array(), '0.0.1' );
		wp_register_script( 'magnific-popupjs', LIB . '/magnific-popup/magnific-popup.min.js', array(), '0.0.1' );
		wp_register_script( 'mask', JS . '/mask.js', array(), '0.0.1' );
		wp_register_script( 'mainjs', JS . '/main.js', array(), '0.0.1' );
		//wp_register_script( 'masterjs', JS . '/master.js', array(), '0.0.1');
		

		wp_enqueue_style('bootstrapcss');
		wp_enqueue_style('animatecss');
		wp_enqueue_style('font-awesomecss');
		wp_enqueue_style('ioniconscss');
		wp_enqueue_style('agnific-popupcss');
		wp_enqueue_style('appcss');
		//wp_enqueue_style('swipercss');
		//wp_enqueue_style('style_css');

		wp_enqueue_script('jqueryjs');
		wp_enqueue_script('bootstrapjs');
		wp_enqueue_script('bootsbund');
		wp_enqueue_script('easingjs');
		wp_enqueue_script('wowjs');
		wp_enqueue_script('hoverintent');
		wp_enqueue_script('superfishjs');
		wp_enqueue_script('magnific-popupjs');
		wp_enqueue_script('mask');
		wp_enqueue_script('mainjs');
		//wp_enqueue_script('swiperjs');
		//wp_enqueue_script('masterjs');
		
	}

	add_action('wp_enqueue_scripts', 'load_scripts');



	


	// Disable Admin Bar for everyone
	add_action('admin_head', 'my_custom_fonts');

	function my_custom_fonts() { ?>
	  <style>
		#wp-admin-bar-comments, #wp-admin-bar-new-content, #wpfooter, #wp-admin-bar-wp-logo, #screen-meta-links, #navigatediv { display: none; }
	  </style>';
	<?php }


	//Add custom role
	remove_role('contributor');
	remove_role('subscriber');
	remove_role('author');
	remove_role('editor');
	remove_role('client');
	add_role( 
		'cliente', 
		__('Cliente' ),
		array(
			'read' => true, // true allows this capability
			'edit_posts' => true, // Allows user to edit their own posts
			'edit_pages' => true, // Allows user to edit pages
			'edit_others_posts' => true, // Allows user to edit others posts not just their own
			'create_posts' => true, // Allows user to create new posts
			'manage_categories' => true, // Allows user to manage post categories
			'publish_posts' => true, // Allows the user to publish, otherwise posts stays in draft mode
		)
	);

	add_role( 
		'padeiro', 
		__('Padeiro' ),
		array(
			'read' => true, // true allows this capability
			'edit_posts' => true, // Allows user to edit their own posts
			'edit_pages' => true, // Allows user to edit pages
			'edit_others_posts' => true, // Allows user to edit others posts not just their own
			'create_posts' => true, // Allows user to create new posts
			'manage_categories' => true, // Allows user to manage post categories
			'publish_posts' => true, // Allows the user to publish, otherwise posts stays in draft mode
		)
	);

	add_role( 
		'ajudante', 
		__('Ajudante' ),
		array(
			'read' => true, // true allows this capability
			'edit_posts' => true, // Allows user to edit their own posts
			'edit_pages' => true, // Allows user to edit pages
			'edit_others_posts' => true, // Allows user to edit others posts not just their own
			'create_posts' => true, // Allows user to create new posts
			'manage_categories' => true, // Allows user to manage post categories
			'publish_posts' => true, // Allows the user to publish, otherwise posts stays in draft mode
		)
	);




	//remve widgets of dashboard
	function remove_dashboard_widgets() {

		global $wp_meta_boxes;

		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);

		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	}
	add_action('wp_dashboard_setup', 'remove_dashboard_widgets');


	if( function_exists('acf_add_options_sub_page') ) {
		if (current_user_can( 'administrator' )):
			acf_add_options_sub_page(array(
				'page_title' 	=> 'Opções do Tema',
				'menu_title'	=> 'Opções do Tema',
				'menu_slug' 	=> 'theme-general-settings',
				'parent_slug'	=> 'edit.php?post_type=page',
				'capability'	=> 'edit_posts',
				'icon_url'		=> 'dashicons-welcome-write-blog',
				'redirect'		=> false
			));
		endif;
	}



	function send_payment()
	{

		$pod = pods( 'venda' ); 
		$plano = ['junior', 'pleno', 'master', 'corporativo', 'menu' => 'menu'];

		// To add a new item, let's set the data first 
		$data = array( 
			'pd_users_id'		=> get_current_user_id(),
			'pd_parceiros_id'	=> $_SESSION['paodigital']['parceiro'],
			'preco_total'		=> $_SESSION['paodigital']['cart']['subtotal'],
			'desconto'			=> 0,
			'taxas'				=> $_SESSION['paodigital']['cart']['ventrega'],
			'pagamento_status'	=> 0,
			'product_type'		=> $_SESSION['paodigital']['type'],
			'package_type'		=> $plano[ $_SESSION['paodigital']['plano'] ],
			'pacote_por_x_dias'	=> 0,
			'week_time'			=> 'A',
			'drive_time'		=> '0000-00-00 00:00:00',
			'phone'				=> '',
			'date_expiration'	=> '0000-00-00 00:00:00',
			'created'			=> date('Y-m-d H:i:s'),
			'modified'			=> '0000-00-00 00:00:00',
			'pedido'			=> 1
		); 


		//Add the new item now and get the new ID 
		$new_venda_id = $pod->add( $data ); 

		$myItens = $_SESSION['paodigital']['cart']['itens'];

		if( is_array($myItens) && count($myItens) > 0 ):

			foreach( $myItens as $key => $prod ):
				
				$pod = pods( 'item' ); 
				$datP = array( 
					'nome'			=> $prod['nome'],
					'quantidade'	=> $prod['quantidade'],
					'valor_no_ato'	=> $prod['valor'],
					'produto_id'	=> $key,
					'venda_id'		=> $new_venda_id
				);
				$pod->add( $datP );

			endforeach;

		endif;

		$_SESSION['paodigital'] = [];

	}


	function remove_menus () 
	{
		global $menu;
		if (current_user_can( 'administrator' ))
		{
			$restricted = array(
				//Remova ou comente as linhas a seguir para exibir os itens.
				__('Dashboard'),
				__('Posts'),
				__('Media'),
				__('Links'),
				//__('Pages'),
				__('Appearance'),
				__('Tools'),
				//__('Users'),
				//__('Settings'),
				__('Comments'),
				__('Plugins'),
				//__('Options')
			);

		} elseif (current_user_can( 'cliente' )) {
			$restricted = array(
				//Remova ou comente as linhas a seguir para exibir os itens.
				__('Dashboard'),
				__('Posts'),
				__('Media'),
				__('Links'),
				__('Pages'),
				__('Appearance'),
				__('Tools'),
				__('Users'),
				__('Settings'),
				__('Comments'),
				__('Plugins'),
				__('Options')
			);
			
		} elseif (current_user_can( 'ajudante' )) {
			$restricted = array(
				//Remova ou comente as linhas a seguir para exibir os itens.
				__('Dashboard'),
				__('Posts'),
				__('Media'),
				__('Links'),
				__('Pages'),
				__('Appearance'),
				__('Tools'),
				__('Users'),
				__('Settings'),
				__('Comments'),
				__('Plugins'),
				__('Options')
			);
			
		} elseif (current_user_can( 'padeiro' )) {
			$restricted = array(
				//Remova ou comente as linhas a seguir para exibir os itens.
				__('Dashboard'),
				__('Posts'),
				__('Media'),
				__('Links'),
				__('Pages'),
				__('Appearance'),
				__('Tools'),
				__('Users'),
				__('Settings'),
				__('Comments'),
				__('Plugins'),
				__('Options')
			);
			
		}
		
		end ($menu);
		while (prev($menu)){
			$value = explode(' ',$menu[key($menu)][0]);
			if( in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
		}

		//var_dump($menu);
		remove_menu_page('pods-manage-item');
		remove_menu_page('edit.php?post_type=acf-field-group');
		//die();
	}
	add_action('admin_menu', 'remove_menus');


	add_action( 'admin_init', 'the_dramatist_debug_admin_menu' );

	function the_dramatist_debug_admin_menu() {


		//$GLOBALS[ 'menu' ]['110'] = $GLOBALS[ 'menu' ]['70'];

		if( isset($GLOBALS[ 'menu' ]) ):

			foreach( $GLOBALS[ 'menu' ] as $key => $menu ):

				if( in_array( 'pods-manage-item', $menu ) )
					unset($GLOBALS[ 'menu' ][$key]);

				if( in_array( 'blue_admin', $menu ) )
					unset($GLOBALS[ 'menu' ][$key]);

				if( in_array( 'hide_wp', $menu ) )
					unset($GLOBALS[ 'menu' ][$key]);

				if( in_array( 'UsuarioEnderecos', $menu ) )
					unset($GLOBALS[ 'menu' ][$key]);

				if( in_array( 'Pods Admin', $menu ) )
					//unset($GLOBALS[ 'menu' ][$key]);

				if( in_array( 'users.php', $menu ) && $key !== 200 ):

					$GLOBALS[ 'menu' ]['200'] = $GLOBALS[ 'menu' ][$key];
					unset($GLOBALS[ 'menu' ][$key]);
				endif;
				

			endforeach;

		endif;

		//echo '<pre>' . print_r( $GLOBALS[ 'menu' ], TRUE) . '</pre>';
	}


function modify_contact_methods($profile_fields) {
	// Remove old fields
	$profile_fields = [];

	?>
        <script type="text/javascript">
            jQuery(".user-rich-editing-wrap").remove();
            jQuery(".user-syntax-highlighting-wrap").remove();
            jQuery(".user-admin-color-wrap").remove();
            jQuery(".user-comment-shortcuts-wrap").remove();
            jQuery(".user-admin-bar-front-wrap").remove();
            jQuery(".user-language-wrap").remove();
            jQuery("h2:contains('Opções pessoais')").remove();
            jQuery("h2:contains('Informações de contato')").remove();//
            jQuery(".user-url-wrap").remove();
            jQuery("h2:contains('Privilégios adicionais')").remove();//
            jQuery(".user-capabilities-wrap").remove();
        </script>
<?php

	$profile_fields['Endereco'] = 'Facebook URL';
	
	return $profile_fields;
}
add_filter('user_contactmethods', 'modify_contact_methods');


 ?>