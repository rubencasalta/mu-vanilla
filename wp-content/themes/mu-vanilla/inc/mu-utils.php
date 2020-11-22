<?php

	namespace mu\utils;

 	/* PAGINATION */
		function bootstrap_pagination( \WP_Query $wp_query = null, $echo = true ) {

			if ( null === $wp_query ) {
				global $wp_query;
			}

			$pages = paginate_links( [
					'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
					'format'       => '?paged=%#%',
					'current'      => max( 1, get_query_var( 'paged' ) ),
					'total'        => $wp_query->max_num_pages,
					'type'         => 'array',
					'show_all'     => false,
					'end_size'     => 3,
					'mid_size'     => 1,
					'prev_next'    => true,
					'prev_text'    => __( '« Anterior', 'mu-domain' ),
					'next_text'    => __( 'Siguiente »', 'mu-domain' ),
					'add_args'     => false,
					'add_fragment' => ''
				]
			);

			if ( is_array( $pages ) ) {
				//$paged = ( get_query_var( 'paged' ) == 0 ) ? 1 : get_query_var( 'paged' );

				$pagination = '<ul class="pagination justify-content-center">';

				foreach ($pages as $page) {
								$pagination .= '<li class="page-item' . (strpos($page, 'current') !== false ? ' active' : '') . '"> ' . str_replace('page-numbers', 'page-link', $page) . '</li>';
						}

				$pagination .= '</ul>';

				if ( $echo ) {
					echo $pagination;
				} else {
					return $pagination;
				}
			}

			return null;
		}
	/* --- */

	function pre($v='')
	{
		echo '<pre>';
		print_r($v);
		echo '</pre>';
	}
