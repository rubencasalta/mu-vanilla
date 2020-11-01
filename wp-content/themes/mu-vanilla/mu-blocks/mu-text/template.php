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
		$block_fullsize = get_field('block_text_fullsize');
	// ---

?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">

    <?php if( !$block_fullsize ) : ?>
        <div class="container">
    <?php else : ?>
        <div class="container-fluid">
    <?php endif; ?>

		<div class="capsule-content align-self-center">
			<?=$text_content?>
		</div>

		<InnerBlocks  />

    </div>

</div>