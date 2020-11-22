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

	// Añadir tamaños de imágenes
		add_action('init', function(){
			add_image_size('mu-image-background', 1600, 700, TRUE);
		});
	// ---