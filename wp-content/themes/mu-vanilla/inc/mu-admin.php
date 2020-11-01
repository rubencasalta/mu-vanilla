<?php

	namespace mu\admin;

    // Personalizar el admin
		function admin_enqueue_scripts()
		{
			wp_register_style('bootstrap-grid-admin', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap-grid.min.css');
			wp_enqueue_style('theme-admin-style', get_template_directory_uri() . '/assets/admin/css/theme-admin.css', array('bootstrap-grid-admin'));
		}
		add_action( 'admin_enqueue_scripts', 'mu\admin\admin_enqueue_scripts' );
	/* --- */