<?php 
	define('IMG', get_template_directory_uri().'/assets/img');
	define('CSS', get_template_directory_uri().'/assets/css');
	define('JS', get_template_directory_uri().'/assets/js');
	define('LIB', get_template_directory_uri().'/assets/lib');
	define('IMAGES', get_template_directory_uri().'/assets/images');


	function load_scripts()
	{


		/* Registering style */
		wp_register_style( 'bootstrapcss', CSS . '/bootstrap.min.css', array(), '0.0.1', false );
		wp_register_style( 'animatecss', LIB . '/animate/animate.min.css', array(), '0.0.1', false );
		wp_register_style( 'font-awesomecss', LIB . '/font-awesome/css/font-awesome.min.css', array(), '0.0.1', false );
		wp_register_style( 'ioniconscss', LIB . '/ionicons/css/ionicons.min.css', array(), '0.0.1', false );
		wp_register_style( 'magnific-popupcss', LIB . '/magnific-popup/magnific-popup.css', array(), '0.0.1', false );
		wp_register_style( 'appcss', CSS . '/app.css', array(), '0.0.1', false );

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

 ?>