<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

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

<?php endwhile; else : ?>

	<div class="container">
		<p class="text-danger"><?php get_template_part('template-parts/message', 'no-match') ?></p>
	</div>

<?php endif ?>
<?php get_footer(); ?>
