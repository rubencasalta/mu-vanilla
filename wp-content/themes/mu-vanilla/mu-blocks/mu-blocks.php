<?php

	namespace mu\blocks;

	if( !class_exists('ACF') ) return FALSE;

	// Cargar bloques de forma automática
		$blocks_dir = get_template_directory() . '/mu-blocks/';
		$arDir  = scandir( $blocks_dir );
		$style_content = '';

		foreach ($arDir as $k => $block_name)
		{
			//if( in_array($block_name, array('youtube_background')) ) continue;

			if( "."!=$block_name && ".."!=$block_name && is_dir($blocks_dir.$block_name) )
			{
				require_once get_template_directory() . '/mu-blocks/'.$block_name.'/register.php';

				$style_content .= '@import "'.get_template_directory() . '/mu-blocks/'.$block_name.'/style";'."\n";
			}
		}
		file_put_contents(get_template_directory() . '/mu-blocks/_style.scss', str_replace('\\', '/', $style_content) );
    // ---


    // CONTROLAR LOS BLOQUES QUE SE CARGAN
        function allowed_block_types( $allowed_blocks, $post )
        {
            $registered_blocks = \WP_Block_Type_Registry::get_instance()->get_all_registered();
            $registered_blocks = array_keys( $registered_blocks );

            /*
            echo '<pre>';
            print_r($registered_blocks);
            echo '</pre>';
            */

            $allowed_blocks = array();

            foreach ($registered_blocks as $b_key => $b_value)
            {
                if (preg_match('#^acf/mu-#', $b_value) === 1)
                {
                    $allowed_blocks[] = $b_value;
                }
            }

            /*
            echo '<pre>';
            print_r($allowed_blocks);
            echo '</pre>';

            die();
            */

            return $allowed_blocks;
        }
        //add_filter( 'allowed_block_types', 'mu\blocks\allowed_block_types', 10, 2 );
    /* --- */

    // Categoría para los bloques de Musca
        function block_categories( $categories, $post )
        {
			$mu_theme = wp_get_theme();
			$mu_theme_name = esc_html( $mu_theme->get('Name') );

            return array_merge(
                        $categories,
                        array(
                            array(
                                'slug'      => 'mu-blocks',
                                'title'     => __( $mu_theme_name, 'mu-domain' ),
                                'icon'      => 'screenoptions',
                            ),
                        )
            );
        }
        add_filter( 'block_categories', 'mu\blocks\block_categories', 10, 2 );
    /* --- */