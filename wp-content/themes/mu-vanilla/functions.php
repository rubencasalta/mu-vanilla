<?php

	// https://developer.wordpress.org/themes/

	namespace mu;

	require_once( __DIR__ . '/inc/mu-init.php');
	require_once( __DIR__ . '/inc/mu-junk.php');
	require_once( __DIR__ . '/inc/mu-admin.php');
	require_once( __DIR__ . '/inc/class-wp-bootstrap-navwalker.php');
	require_once( __DIR__ . '/inc/johnbillion/extended-cpts/extended-cpts.php');
	require_once( __DIR__ . '/mu-blocks/mu-blocks.php');


	require_once( __DIR__ . '/mu-cpt/mu-story.php');




	function add_theme_scripts()
	{
		// CSS
			// Theme y Bootstrap
			wp_register_style( 'theme', get_template_directory_uri() . '/assets/theme/css/theme.min.css', array(), NULL, 'all' );

			// Hay veces que el cliente quiere tocar css.
			wp_register_style( 'custom', get_template_directory_uri() . '/assets/theme/css/custom.css', array(), NULL, 'all' );

			// Encolando estilos.
			wp_enqueue_style( array('theme', 'custom') );
		// ---

		// JS
			// Bootstrap
			wp_register_script('bootstrap-cdn', 'https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js', '', '0', TRUE);

			// Theme
			wp_register_script( 'theme', get_template_directory_uri() . '/assets/theme/js/theme.js', FALSE, NULL, TRUE);

			// Install jQuery 3.4.1 - Google CDN
    		wp_deregister_script('jquery');
    		wp_register_script('jquery', ("https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"), false);

			// Encolar los JSs
			wp_enqueue_script( array ( 'jquery', 'bootstrap-cdn', 'theme' ));
		// ---
	}
	add_action( 'wp_enqueue_scripts', 'mu\add_theme_scripts' );

	// Registrar menús
		register_nav_menus( array(
			'primary' => __( 'Menú principal', 'mu-domain' ),
			'secondary' => __( 'Menú secundario', 'mu-domain' ),
		) );


	// Media
		function jpeg_quality()
		{
			return 75;
		}
		add_filter( 'jpeg_quality', 'mu\jpeg_quality');

		function set_media()
		{
			// Tamaños de imagenes
				add_image_size( 'header', 1200, 675, TRUE ); // Para las cabeceras
				add_image_size( 'list', 600, 375, TRUE ); // Para los listados
		}
		add_action('init', 'mu\set_media');
	// ---

	/* Menú / Admin */
		function remove_menu_pages()
		{
			// Posts / Entradas
			remove_menu_page('edit.php');
			// Comentarios
			remove_menu_page('edit-comments.php');
		}
		add_action('admin_menu', 'mu\remove_menu_pages');

		function custom_menu_order($menu_ord)
		{
			if (!$menu_ord) return true;
			return array(
							'index.php',
							'edit.php',
							'edit.php?post_type=page',
							'upload.php'
						);
		}

		add_filter('custom_menu_order', 'mu\custom_menu_order');
		add_filter('menu_order', 'mu\custom_menu_order');
	// ---

	function do_shortcode_gutemberg($block_content, $block)
	{
		return do_shortcode($block_content);
	}
	add_filter( 'render_block', 'mu\do_shortcode_gutemberg', 99, 2 );