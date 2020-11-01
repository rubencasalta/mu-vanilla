<?php

	// Definición
		$name = $className = 'mu-block-group';

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
		$content_image = get_field('block_container_image');
	// ---

?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">

	<div class="container">
		<div class="block-container__inner">
			<div class="block-container__content">
				<InnerBlocks />
			</div>
			<div class="block-container__image">
				<?=wp_get_attachment_image( $content_image, 'header', false, array('class'=>'img-fluid') ) ?>
			</div>
		</div>
	</div>

</div>


