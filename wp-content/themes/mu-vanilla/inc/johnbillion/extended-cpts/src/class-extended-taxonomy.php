<?php
declare( strict_types=1 );

class Extended_Taxonomy {

	/**
	 * Default arguments for custom taxonomies.
	 * Several of these differ from the defaults in WordPress' register_taxonomy() function.
	 *
	 * @var array
	 */
	protected $defaults = [
		'public'          => true,
		'show_ui'         => true,
		'hierarchical'    => true,
		'query_var'       => true,
		'exclusive'       => false, # Custom arg
		'allow_hierarchy' => false, # Custom arg
	];

	/**
	 * @var string
	 */
	public $taxonomy;

	/**
	 * @var array
	 */
	public $object_type;

	/**
	 * @var string
	 */
	public $tax_slug;

	/**
	 * @var string
	 */
	public $tax_singular;

	/**
	 * @var string
	 */
	public $tax_plural;

	/**
	 * @var string
	 */
	public $tax_singular_low;

	/**
	 * @var string
	 */
	public $tax_plural_low;

	/**
	 * @var array
	 */
	public $args;

	/**
	 * Class constructor.
	 *
	 * @see register_extended_taxonomy()
	 *
	 * @param string       $taxonomy    The taxonomy name.
	 * @param array|string $object_type Name(s) of the object type(s) for the taxonomy.
	 * @param array        $args        Optional. The taxonomy arguments.
	 * @param string[]     $names       Optional. An associative array of the plural, singular, and slug names.
	 */
	public function __construct( string $taxonomy, $object_type, array $args = [], array $names = [] ) {
		/**
		 * Filter the arguments for this taxonomy.
		 *
		 * @since 2.0.0
		 *
		 * @param array $args The taxonomy arguments.
		 */
		$args  = apply_filters( "ext-taxos/{$taxonomy}/args", $args );

		/**
		 * Filter the names for this taxonomy.
		 *
		 * @since 2.0.0
		 *
		 * @param string[] $names The plural, singular, and slug names (if any were specified).
		 */
		$names = apply_filters( "ext-taxos/{$taxonomy}/names", $names );

		if ( isset( $names['singular'] ) ) {
			$this->tax_singular = $names['singular'];
		} else {
			$this->tax_singular = ucwords( str_replace( [ '-', '_' ], ' ', $taxonomy ) );
		}

		if ( isset( $names['slug'] ) ) {
			$this->tax_slug = $names['slug'];
		} elseif ( isset( $names['plural'] ) ) {
			$this->tax_slug = $names['plural'];
		} else {
			$this->tax_slug = $taxonomy . 's';
		}

		if ( isset( $names['plural'] ) ) {
			$this->tax_plural = $names['plural'];
		} else {
			$this->tax_plural = ucwords( str_replace( [ '-', '_' ], ' ', $this->tax_slug ) );
		}

		$this->object_type = (array) $object_type;
		$this->taxonomy    = strtolower( $taxonomy );
		$this->tax_slug    = strtolower( $this->tax_slug );

		# Build our base taxonomy names:
		# Lower-casing is not forced if the name looks like an initialism, eg. FAQ.
		if ( ! preg_match( '/[A-Z]{2,}/', $this->tax_singular ) ) {
			$this->tax_singular_low = strtolower( $this->tax_singular );
		} else {
			$this->tax_singular_low = $this->tax_singular;
		}

		if ( ! preg_match( '/[A-Z]{2,}/', $this->tax_plural ) ) {
			$this->tax_plural_low = strtolower( $this->tax_plural );
		} else {
			$this->tax_plural_low = $this->tax_plural;
		}

		# Build our labels:
		$this->defaults['labels'] = [
			'menu_name'                  => $this->tax_plural,
			'name'                       => $this->tax_plural,
			'singular_name'              => $this->tax_singular,
			'search_items'               => sprintf( __('Buscar', 'mu-domain') ),
			'popular_items'              => sprintf( __('Popular', 'mu-domain') ),
			'all_items'                  => sprintf( __('Todos', 'mu-domain') ),
			'parent_item'                => sprintf( __('Padre', 'mu-domain') ),
			'parent_item_colon'          => sprintf( __('Padre:', 'mu-domain') ),
			'edit_item'                  => sprintf( __('Editar %s', 'mu-domain'), $this->tax_singular ),
			'view_item'                  => sprintf( __('Ver %s', 'mu-domain'), $this->tax_singular ),
			'update_item'                => sprintf( __('Actualizar', 'mu-domain') ),
			'add_new_item'               => sprintf( __('Añadir', 'mu-domain') ),
			'new_item_name'              => sprintf( __('Nuevo nombre', 'mu-domain') ),
			'separate_items_with_commas' => sprintf( __('Separar con comas', 'mu-domain') ),
			'add_or_remove_items'        => sprintf( __('Añade o elimina', 'mu-domain') ),
			'choose_from_most_used'      => sprintf( __('Elige de entre los mas buscados', 'mu-domain') ),
			'not_found'                  => sprintf( __('Sin resultados', 'mu-domain') ),
			'no_terms'                   => sprintf( __('Sin %s', 'mu-domain'), $this->tax_plural_low ),
			'items_list_navigation'      => sprintf( __('Lista de navegacion', 'mu-domain') ),
			'items_list'                 => sprintf( __('Lista', 'mu-domain') ),
			'most_used'                  => __('Más usados', 'mu-domain'),
			'back_to_items'              => sprintf( __('&larr; Volver', 'mu-domain') ),
			'no_item'                    => sprintf( __('Sin %s', 'mu-domain'), $this->tax_singular_low ), # Custom label
			'filter_by'                  => sprintf( __('Filtrado por %s', 'mu-domain'), $this->tax_singular_low ), # Custom label
		];

		# Only set rewrites if we need them
		if ( isset( $args['public'] ) && ! $args['public'] ) {
			$this->defaults['rewrite'] = false;
		} else {
			$this->defaults['rewrite'] = [
				'slug'         => $this->tax_slug,
				'with_front'   => false,
				'hierarchical' => isset( $args['allow_hierarchy'] ) ? $args['allow_hierarchy'] : $this->defaults['allow_hierarchy'],
			];
		}

		# Merge our args with the defaults:
		$this->args = array_merge( $this->defaults, $args );

		# This allows the 'labels' arg to contain some, none or all labels:
		if ( isset( $args['labels'] ) ) {
			$this->args['labels'] = array_merge( $this->defaults['labels'], $args['labels'] );
		}

		# Rewrite testing:
		if ( $this->args['rewrite'] ) {
			add_filter( 'rewrite_testing_tests', [ $this, 'rewrite_testing_tests' ], 1 );
		}

		# Register taxonomy:
		$this->register_taxonomy();

		/**
		 * Fired when the extended taxonomy instance is set up.
		 *
		 * @since 4.0.0
		 *
		 * @param Extended_Taxonomy $instance The extended taxonomy instance.
		 */
		do_action( "ext-taxos/{$taxonomy}/instance", $this );
	}

	/**
	 * Add our rewrite tests to the Rewrite Rule Testing tests array.
	 *
	 * @codeCoverageIgnore
	 *
	 * @param array $tests The existing rewrite rule tests.
	 * @return array Updated rewrite rule tests.
	 */
	public function rewrite_testing_tests( array $tests ) : array {
		require_once __DIR__ . '/class-extended-rewrite-testing.php';
		require_once __DIR__ . '/class-extended-taxonomy-rewrite-testing.php';

		$extended = new Extended_Taxonomy_Rewrite_Testing( $this );

		return array_merge( $tests, $extended->get_tests() );
	}

	/**
	 * Registers our taxonomy.
	 */
	public function register_taxonomy() {
		if ( true === $this->args['query_var'] ) {
			$query_var = $this->taxonomy;
		} else {
			$query_var = $this->args['query_var'];
		}

		$post_types = get_post_types( [
			'query_var' => $query_var,
		] );

		if ( $query_var && count( $post_types ) ) {
			trigger_error( esc_html( sprintf(
				/* translators: %s: Taxonomy query variable name */
				__( 'Taxonomy query var "%s" clashes with a post type query var of the same name', 'extended-cpts' ),
				$query_var
			) ), E_USER_ERROR );
		} elseif ( in_array( $query_var, [ 'type', 'tab' ], true ) ) {
			trigger_error( esc_html( sprintf(
				/* translators: %s: Taxonomy query variable name */
				__( 'Taxonomy query var "%s" is not allowed', 'extended-cpts' ),
				$query_var
			) ), E_USER_ERROR );
		} else {
			register_taxonomy( $this->taxonomy, $this->object_type, $this->args );
		}
	}

}