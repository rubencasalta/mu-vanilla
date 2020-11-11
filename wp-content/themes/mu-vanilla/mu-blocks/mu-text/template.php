<?php

	// Definición
		$name = $className = 'mu-block-text';

		$id = $name . '-' . $block['id'];
		if( !empty($block['anchor']) )
		{
			$id = $block['anchor'];
		}

		if( !empty($block['className']) )
		{
			$className .= ' ' . $block['className'];
		}
		if( !empty($block['align']) )
		{
			$className .= ' align' . $block['align'];
		}
	// ---

	// Variables
		$text_content = get_field('block_text_content');
		$fullsize = get_field('block_fullsize');
	// ---

?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">

	<?php if( !$fullsize ) : ?>
		<div class="container">
	<?php else : ?>
		<div class="container-fluid p-0">
	<?php endif; ?>

		<div class="<?=$name?>__content align-self-center py-4">
			<?=$text_content?>
		</div>

    </div>

</div>