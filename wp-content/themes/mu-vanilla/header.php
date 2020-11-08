<?php global $theme_options; ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php echo bloginfo('charset'); ?>">
	<title><?php wp_title('|',true,'right'); ?><?php bloginfo('name'); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php wp_head(); ?>

	<?=$theme_options['google_analytics']?>
</head>

<body <?php body_class(); ?>>

	<nav class="menu-header navbar navbar-expand-md navbar-dark bg-dark sticky-top" role="navigation">
		<div class="container">
			<div class="navbar-brand">
				<a class="site-title navbar-brand__title" href="<?=get_home_url()?>">
					<img class="img-fluid navbar-brand__logo" src="<?=esc_html( bloginfo('template_url') )?>/assets/images/logo.png" alt="<?php esc_url(bloginfo('name')); ?>">
				</a>
			</div>

			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#bs-navbar-collapse" aria-controls="bs-navbar-collapse" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'mu-domain' ); ?>">
				<span class="navbar-toggler-icon"></span>
			</button>

			<?php
			wp_nav_menu( array(
				'theme_location'    => 'primary',
				'depth'             => 2,
				'container'         => 'div',
				'container_class'   => 'collapse navbar-collapse',
				'container_id'      => 'bs-navbar-collapse',
				'menu_class'        => 'nav navbar-nav ml-auto',
				'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
				'walker'            => new WP_Bootstrap_Navwalker(),
			) );
			?>
		</div>
	</nav>
