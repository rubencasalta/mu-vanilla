<?php

	// Definición
		$args =	array(
						'name'				=> 'mu-text',
						'title'				=> __('Texto', 'mu-domain'),
						'description'		=> __('Bloque: Texto', 'mu-domain'),
						'category'			=> 'mu-blocks',
						'icon'				=> 'block-default',
						'keywords'			=> array( 'texto', 'imagen' ),
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

	//** Encolar los assets
	//	add_action( 'enqueue_block_assets', function() use ( $args ) {
	//		wp_enqueue_style( 'block-'.$args['name'], get_stylesheet_directory_uri() . '/mu-blocks/'.$args['name'].'/style.min.css', array() );
	//	});
	// ---