<?php

	// Definición
		$args =	array(
						'name'				=> 'mu-image-background',
						'title'				=> __('Imagen de fondo', 'mu-domain'),
						'description'		=> __('Bloque: Imagen de fondo', 'mu-domain'),
						'category'			=> 'mu-blocks',
						'icon'				=> 'block-default',
						'keywords'			=> array( 'imagen', 'fondo' ),
						'supports'			=> array(
													//'mode'  => false,
													'align' => false,
												),
					);
	// ---

	// Registro
		add_action('acf/init', function() use ( $args ) {
			$args['render_template'] = 'mu-blocks/'.$args['name'].'/template.php';
			acf_register_block_type($args);
		});
	// ---

	// Encolar los assets
//		add_action( 'enqueue_block_assets', function() use ( $args ) {
//			wp_enqueue_style( 'block-'.$args['name'], get_stylesheet_directory_uri() . '/mu-blocks/'.$args['name'].'/style.min.css', array() );
//		});
	// ---

	// Añadir tamaños de imágenes
		add_action('init', function(){
			add_image_size('mu-image-background', 1300, 800, TRUE);
		});
	// ---