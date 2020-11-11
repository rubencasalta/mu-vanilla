<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<section>
	<article>
	<?php $blocks = parse_blocks( get_the_content() ); ?>
	<?php foreach ( $blocks as $block ) : ?>
		<?php if(empty($block['blockName'])) continue; ?>
		<?php if (preg_match('#^acf/mu-#', $block['blockName']) === 1) : ?>
			<?=render_block( $block )?>
		<?php else : ?>
			<div class="container">
				<?=apply_filters( 'the_content', render_block( $block ) )?>
			</div>
		<?php endif; ?>
	<?php endforeach; ?>
	</article>
</section>

	<!--div class="container">
		<section class="row">
			<article class="col-md-6">
				<h2>Notícia 0 Lorem ipsum, dolor sit amet consectetur adipisicing elit.</h2>
				<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore sed veritatis maxime soluta eaque voluptatem illo eos a dignissimos excepturi quibusdam voluptates, esse, amet beatae atque, quia dolore possimus nesciunt?</p>
			</article>
			<article class="col-md-6">
				<h2>Notícia 1 Lorem ipsum, dolor sit amet consectetur adipisicing elit.</h2>
				<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore sed veritatis maxime soluta eaque voluptatem illo eos a dignissimos excepturi quibusdam voluptates, esse, amet beatae atque, quia dolore possimus nesciunt?</p>
			</article>
			<article class="col-md-6">
				<h2>Notícia 2 Lorem ipsum, dolor sit amet consectetur adipisicing elit.</h2>
				<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore sed veritatis maxime soluta eaque voluptatem illo eos a dignissimos excepturi quibusdam voluptates, esse, amet beatae atque, quia dolore possimus nesciunt?</p>
			</article>
			<article class="col-md-6">
				<h2>Notícia 3 Lorem ipsum, dolor sit amet consectetur adipisicing elit.</h2>
				<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore sed veritatis maxime soluta eaque voluptatem illo eos a dignissimos excepturi quibusdam voluptates, esse, amet beatae atque, quia dolore possimus nesciunt?</p>
			</article>
		</section>
	</div-->

<?php endwhile; else : ?>

	<div class="container">
		<p class="text-danger"><?php get_template_part('template-parts/message', 'no-match') ?></p>
	</div>

<?php endif ?>
<?php get_footer(); ?>