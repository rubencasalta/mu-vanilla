<?php

	$name = $className = 'mu-block-image-background';

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

    $image_background_image = get_field('block_image_background_image');
    $image_background_content = get_field('block_image_background_content');
    $className .= ' ' . get_field('block_image_background_horizontal');
    $className .= ' ' . get_field('block_image_background_vertical');

    $fullsize = get_field('block_fullsize');

?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">

	<?php if( !$fullsize ) : ?>
		<div class="container">
	<?php else : ?>
		<div class="container-fluid p-0">
	<?php endif; ?>

		<div class="capsule-content" style="background-image: url(<?=$image_background_image['url']?>)">
			<div class="capsule-inner">
				<?=$image_background_content?>
			</div>
		</div>

    </div>


</div>