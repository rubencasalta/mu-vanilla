<?php

	namespace mu\admin;

    // Personalizar el admin
		add_action( 'admin_enqueue_scripts', function(){
			global $post_type;
			if(!empty($post_type))
			{
				wp_register_style('theme-admin-style', get_template_directory_uri() . '/assets/admin/css/theme-admin.min.css');
				wp_enqueue_style( array('theme-admin-style') );
			}
		});
	/* --- */