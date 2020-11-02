<?php

	namespace mu\init;


	// Inicializar i18n
		function theme_load_theme_textdomain()
		{
			load_theme_textdomain( 'mu-domain', get_template_directory() . '/languages' );
		}
		add_action( 'after_setup_theme', 'mu\init\theme_load_theme_textdomain' );
	// ---

    // Imagenes
		add_filter( 'big_image_size_threshold', '__return_false' );
        add_filter( 'intermediate_image_sizes_advanced', function ( $sizes ) {

			// Eliminar los tamaños por defecto de WP
				unset( $sizes['2048x2048'] );
				unset( $sizes['1536x1536'] );
				unset( $sizes['thumbnail'] );
				unset( $sizes['medium'] );
				unset( $sizes['medium_large'] );
				unset( $sizes['large'] );
			// ---

            return $sizes;
		} );
	// ---

	/* SETUP */
	function after_setup_theme()
	{
		show_admin_bar(false);

		/* WP SUPPORT */
			register_nav_menus( array(
				'primary' => esc_html__( 'Principal', 'mu-domain' ),
				'secondary' => esc_html__( 'Secundario', 'mu-domain' ),
			) );
			add_theme_support('menus');
			add_theme_support('post-thumbnails');
			add_theme_support('responsive-embeds');

		/* ACF */
			if ( class_exists('ACF') )
			{
				/* Configuración  */
				acf_add_options_page(	array(
											'page_title'  => __('Configuración','mu-domain'),
											'menu_title' => __('Configuración','mu-domain'),
											'menu_slug'  => 'theme-settings',
											'capability' => 'edit_posts',
											'redirect'  => false
										)
				);

				/* Recupera la configuración */
				global $theme_options;
				$theme_options = get_fields('option');
				if(!empty($theme_options))
				{
					foreach ($theme_options as $k => $v)
					{
						global ${$k};
						${$k} = $v;
					}
				}

				// Google Map
				acf_update_setting('google_api_key', $google_api_key);

				add_filter('acf/settings/row_index_offset', '__return_zero');
			}


		/* --- */
	}
	add_action('after_setup_theme', 'mu\init\after_setup_theme');
/* --- */