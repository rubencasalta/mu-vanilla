<?php

	namespace mu\init;

	if (!defined('AUTOSAVE_INTERVAL')) define('AUTOSAVE_INTERVAL', 300);
	if (!defined('WP_POST_REVISIONS')) define('WP_POST_REVISIONS', false);

	// Inicializar i18n
		function theme_load_theme_textdomain()
		{
			load_theme_textdomain( 'mu-domain', get_template_directory() . '/languages' );
		}
		add_action( 'after_setup_theme', 'mu\init\theme_load_theme_textdomain' );
	// ---


		/* Imagenes
			add_filter( 'big_image_size_threshold', '__return_false' );
			add_filter( 'intermediate_image_sizes_advanced', function ( $sizes ) {

				unset( $sizes['2048x2048'] );
				unset( $sizes['1536x1536'] );
				unset( $sizes['thumbnail'] );
				unset( $sizes['medium'] );
				unset( $sizes['medium_large'] );
				unset( $sizes['large'] );

				return $sizes;
			} );
		*/

		function set_media()
		{
			/* Tamaños por defecto */
			update_option('thumbnail_size_w', 200);
			update_option('thumbnail_size_h', 200);
			update_option('thumbnail_crop', TRUE);

			update_option('medium_size_w', 400);
			update_option('medium_size_h', 400);
			update_option('medium_crop', TRUE);

			update_option('medium_large_size_w', 600);
			update_option('medium_large_size_h', 600);
			update_option('medium_large_crop', TRUE);

			update_option('large_size_w', 800);
			update_option('large_size_h', 800);
			update_option('large_crop', TRUE);
		}
		add_action('init', 'mu\init\set_media');

	/* SETUP */
	function after_setup_theme()
	{
		//show_admin_bar(false);

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



function add_rel_preload($html, $handle, $href, $media) {
	if (is_admin())
		return $html;
	 $html = <<<EOT
<link rel='preload' as='style' onload="this.onload=null;this.rel='stylesheet'" id='$handle' href='$href' type='text/css' media='all' /> \n
EOT;
	return $html;
}
//add_filter( 'style_loader_tag', 'mu\init\add_rel_preload', 10, 4 );

function add_defer_attribute($tag, $handle) {
	// add script handles to the array below
	$scripts_to_defer = array('jquery', 'masonry', 'bootstrap-cdn', 'theme', 'contact-form-7');

	foreach($scripts_to_defer as $defer_script) {
	   if ($defer_script === $handle) {
		  return str_replace(' src', ' defer="defer" src', $tag);
	   }
	}
	return $tag;
 }
 //add_filter('script_loader_tag', 'mu\init\add_defer_attribute', 10, 2);
