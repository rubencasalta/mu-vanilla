<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>


	<div class="front-page">
		<div class="container">
			<?php the_title( '<h2 class="front-page__title">', '</h2>' ); ?>
			<?php if (has_post_thumbnail( $post->ID ) ): ?>
				<?php the_post_thumbnail('header', array('class'=>'img-fluid front-page__image')) ?>
			<?php endif; ?>
		</div>

		<div class="front-page__content">
			<?php the_content() ?>
		</div>
	</div>


<?php endwhile; else : ?>

	<div class="container">
		<p class="text-danger"><?php get_template_part('template-parts/message', 'no-match') ?></p>
	</div>

<?php endif ?>
<?php get_footer(); ?>
