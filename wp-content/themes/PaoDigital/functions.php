<?php

	function tatwerat_startSession() {

		if(!session_id()) {
			session_start();
		}
	}

	add_action('init', 'tatwerat_startSession', 1);

	define('IMG', get_template_directory_uri().'/assets/img');
	define('CSS', get_template_directory_uri().'/assets/css');
	define('JS', get_template_directory_uri().'/assets/js');
	define('LIB', get_template_directory_uri().'/assets/lib');
	define('IMAGES', get_template_directory_uri().'/assets/images');

	require_once (__DIR__.'/lib/wp-database-custom.php');
	require_once (__DIR__.'/lib/wp-posts-custom.php');
	require_once (__DIR__.'/lib/wp-wordpress-actions.php');
	


	function load_scripts()
	{


		/* Registering style */
		wp_register_style( 'bootstrapcss', CSS . '/bootstrap.min.css', array(), '0.0.1', false );
		wp_register_style( 'animatecss', LIB . '/animate/animate.min.css', array(), '0.0.1', false );
		wp_register_style( 'font-awesomecss', LIB . '/font-awesome/css/font-awesome.min.css', array(), '0.0.1', false );
		wp_register_style( 'ioniconscss', LIB . '/ionicons/css/ionicons.min.css', array(), '0.0.1', false );
		wp_register_style( 'magnific-popupcss', LIB . '/magnific-popup/magnific-popup.css', array(), '0.0.1', false );
		wp_register_style( 'appcss', CSS . '/app.css', array(), '0.0.3', false );

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
		wp_enqueue_script('mainjs');
		//wp_enqueue_script('swiperjs');
		//wp_enqueue_script('masterjs');
		
	}

	add_action('wp_enqueue_scripts', 'load_scripts');



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
				__('Users'),
				//__('Settings'),
				__('Comments'),
				__('Plugins'),
				__('Options')
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
		//remove_menu_page('edit.php?post_type=acf-field-group');
		//die();
	}
	add_action('admin_menu', 'remove_menus');


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


	







 ?>