<?php

	namespace mu;

	require_once( __DIR__ . '/inc/mu-init.php');
	require_once( __DIR__ . '/inc/mu-junk.php');
	require_once( __DIR__ . '/inc/mu-admin.php');
	require_once( __DIR__ . '/inc/mu-login.php');
	require_once( __DIR__ . '/inc/class-wp-bootstrap-navwalker.php');
	require_once( __DIR__ . '/inc/johnbillion/extended-cpts/extended-cpts.php');
	require_once( __DIR__ . '/mu-blocks/mu-blocks.php');

	// CPTs
	require_once( __DIR__ . '/mu-cpt/mu-story.php');


	function add_theme_scripts()
	{
		// CSS
			// Theme y Bootstrap
			wp_register_style('bootstrap-cdn', 'https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css');
			wp_register_style('fonts-cdn', 'https://fonts.googleapis.com/css2?family=Lilita+One&family=Montserrat:wght@400;700&display=swap', array(), NULL, 'all' );
			wp_register_style('theme', get_template_directory_uri() . '/assets/css/theme.min.css', array(), NULL, 'all' );

			// Hay veces que el cliente quiere tocar css.
			wp_register_style( 'custom', get_template_directory_uri() . '/assets/css/custom.css', array(), NULL, 'all' );

			// Encolando estilos.
			wp_enqueue_style( array('bootstrap-cdn', 'fonts-cdn', 'theme', 'custom') );
		// ---

		// JS
			// Bootstrap
			wp_register_script('bootstrap-cdn', 'https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js', '', '0', TRUE);

			// Theme
			wp_register_script( 'theme', get_template_directory_uri() . '/assets/js/theme.js', FALSE, NULL, TRUE);

			// Install jQuery - Mejora bastante el pageSpeed. Las pruebas que he hecho, mejora como un 15%.
    		wp_deregister_script('jquery');
    		wp_register_script('jquery', ("https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"), false);

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
		function set_media()
		{
			// Tamaños de imagenes extra
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
							'edit.php?post_type=mu-book',
							'upload.php'
						);
		}

		add_filter('custom_menu_order', 'mu\custom_menu_order');
		add_filter('menu_order', 'mu\custom_menu_order');
	// ---