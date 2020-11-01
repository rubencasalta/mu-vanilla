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

        // Theme supports
			add_theme_support('post-thumbnails'); // Añade thumbnails
			add_theme_support('align-wide');
		// ---


	// ---