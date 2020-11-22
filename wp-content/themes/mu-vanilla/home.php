<?php get_header(); ?>
<?php if ( have_posts() ) : ?>

	<div class="blog-list">
		<div class="container">
			<h1 class="blog-list__section-title"><?php _e('Blog','mu-domain') ?></h1>
			<h3 class="blog-list__section-subtitle"><?php _e('Lorem ipsum, dolor sit amet consectetur adipisicing elit.','mu-domain') ?></h3>
			<hr class="blog-list__line">
			<section class="row masonry">
				<?php while ( have_posts() ) : the_post(); ?>

				<article class="col-md-6 masonry-item blog-list__container">
					<h2 class="blog-list__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<date class="blog-list__date"><?= get_the_date(); ?></date>

					<?php if ( '' !== get_the_post_thumbnail() ) : ?>
					<div class="blog-list__thumbnail-container">
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail('list',array('class' => 'img-fluid blog-list__thumbnail')); ?>
						</a>
					</div>
					<?php endif; ?>

					<div class="blog-list__exceprt">
						<?php the_excerpt(); ?>
					</div>

					<?php if( has_category() ) : ?>
					<div class="blog-list__categories">
						<?php the_category(' - '); ?>
					</div>
					<?php endif; ?>

					<?php if( has_tag() ) : ?>
					<div class="blog-list__tags">
						<?php the_tags('', ' - '); ?>
					</div>
					<?php endif; ?>

				</article>

				<?php endwhile; ?>
			</section>

			<div class="justify-content-center">
				<?php mu\utils\bootstrap_pagination(); ?>
			</div>
		</div>
	</div>

<?php else : ?>

	<div class="container">
		<p class="text-danger"><?php get_template_part('template-parts/message', 'no-match') ?></p>
	</div>

<?php endif ?>
<?php get_footer(); ?>