<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>


<div class="ed-grid m-grid-4">
	<section class="m-cols-3 front-page">
		<article>
			<?php the_title( '<h2 class="front-page__title">', '</h2>' ); ?>
			<?php if (has_post_thumbnail( $post->ID ) ): ?>
				<?php the_post_thumbnail('header', array('class'=>'img-fluid front-page__image')) ?>
			<?php endif; ?>

			<div class="front-page__content">
				<?php the_content() ?>
			</div>
		</article>
	</section>
	<section class="front-page s-cross-center s-main-center">
		<article>
			<h2 class="front-page__title">Aquí no hay nada que ver.</h2>
		</article>
	</section>
</div>



<?php endwhile; else : ?>

	<div class="container">
		<p class="text-danger"><?php get_template_part('template-parts/message', 'no-match') ?></p>
	</div>

<?php endif ?>
<?php get_footer(); ?>
