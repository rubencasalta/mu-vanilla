<?php

	// https://developer.wordpress.org/themes/

	namespace mu;

	require_once( __DIR__ . '/inc/mu-init.php');
	require_once( __DIR__ . '/inc/mu-junk.php');
	require_once( __DIR__ . '/inc/mu-admin.php');
	require_once( __DIR__ . '/mu-blocks/mu-blocks.php');


	function add_theme_scripts()
	{
		// CSS
			// Theme
			wp_register_style( 'theme', get_template_directory_uri() . '/assets/theme/css/theme.css', array(), NULL, 'all' );

			// Encolar todos los estilos
			wp_enqueue_style( array('theme') );
		// ---

		// JS
			// Theme
			wp_register_script( 'theme', get_template_directory_uri() . '/assets/theme/js/theme.js', FALSE, NULL, TRUE);

			// Install jQuery 3.4.1 - Google CDN
    		wp_deregister_script('jquery');
    		wp_register_script('jquery', ("https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"), false);

			// Encolar los JSs
			wp_enqueue_script( array ( 'jquery', 'theme' ));
		// ---
	}
	add_action( 'wp_enqueue_scripts', 'mu\add_theme_scripts' );

	// Tamaños de imagenes
		add_image_size( 'header', 1200, 675, TRUE ); // Para las cabeceras
		add_image_size( 'list', 600, 375, TRUE ); // Para los listados
	// ---