<?php

	// Definición
		$args =	array(
			'name'				=> 'mu-container',
			'title'				=> __('Contenedor', 'mu-domain'),
			'description'		=> __('Bloque: Contenedor', 'mu-domain'),
			'category'			=> 'mu-blocks',
			'icon'				=> 'block-default',
			'keywords'			=> array( 'grupo' ),
			'supports'			=> array(
										//'mode'  => false,
										'align' => true,
										'jsx' => true,
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
		add_action( 'enqueue_block_assets', function() use ( $args ) {
			wp_enqueue_style( 'block-'.$args['name'], get_stylesheet_directory_uri() . '/mu-blocks/'.$args['name'].'/style.min.css', array() );
		});
	// ---
