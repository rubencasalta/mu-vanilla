<?php

add_action( 'init', function() {
	register_extended_post_type( 'mu-book', array(

		# Mostrar todas las publicaciones en el archivo de tipo de publicación:
		'archive' => array(
			'nopaging' => true
		),

		# Agregue algunas columnas personalizadas a la pantalla de administración:
		'admin_cols' => array(
			'genre' => array(
				'taxonomy' => 'mu-genre'
			),
			'featured_image' => array(
				'title'          => __('Ilustración', 'mu-domain'),
				'featured_image' => 'thumbnail',
				'width'          => '64',
			),
			'last_modified' => array(
				'title'      => __('Última modificación', 'mu-domain'),
				'post_field' => 'post_modified',
			),

			/* Se puede añadir un metacampo
			'published' => array(
				'title'       => __('Publicado','mu-domain'),
				'meta_key'    => 'published_date',
				'date_format' => 'd/m/Y'
			),
			*/
		),

		# Agregue un filtro desplegable a la pantalla de administración:
		'admin_filters' => array(
			'genre' => array(
				'taxonomy' => 'mu-genre'
			)
		)

	), array(

		'singular'	=> __('Libro', 'mu-domain'),
		'plural'	=> __('Libros', 'mu-domain'),
		'slug'		=> __('libros', 'mu-domain'),
		'add_new'	=> __('Añadir', 'mu-domain'),

	) );

	register_extended_taxonomy( 'mu-genre', 'mu-book', array(

		// 'simple', 'radio', 'dropdown'
		'meta_box' => 'radio',

		# Mostrar esta taxonomía en el widget del panel de control 'De un vistazo':
		'dashboard_glance' => false,

		# Agregar una columna personalizada a la pantalla de administración:
		/*
		'admin_cols' => array(
			'updated' => array(
				'title'       => __('Actualizado', 'mu-domain'),
				'meta_key'    => 'updated_date',
				'date_format' => 'd/m/Y'
			),
		),
		*/

	), array(

		# Override the base names used for labels:
		'singular' => __('Genero', 'mu-domain'),
		'plural'   => __('Generos', 'mu-domain'),
		'slug'     => __('generos', 'mu-domain')

	) );
} );