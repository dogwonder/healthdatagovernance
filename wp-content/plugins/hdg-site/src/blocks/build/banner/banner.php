<?php
/**
 * Banner Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */
$block_id = $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$block_id = $block['anchor'];
}
// Create class attribute allowing for custom "className" and "align" values. and "align" values.
$class_name = 'sigur-block sigur-banner';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}

// Block attributes (set in native block editor)
$block_attrs  = Sigur_Site_Public::sigur_get_block_attrs( $block ) ? : '';
$block_classes = $block_attrs['class'] ? $block_attrs['class'] : '';
$block_styles = $block_attrs['style'] ? $block_attrs['style'] : '';

// Block Fields
$image    = get_field( 'background_image' ) ? : '';
$image_mobile    = get_field( 'background_image_mobile' ) ? : '';
$overlay  = get_field( 'overlay' ) ? : '';
if($overlay) {
	$overlay_opacity  = get_field( 'overlay_opacity' ) ? : '0';
	//Divide overlay_opacity by 100 to get decimal
	$overlay_opacity = $overlay_opacity / 100;
}

// Classes
$block_image    = $image ? 'has-image ' : '';
$block_overlay  = $overlay ? 'has-overlay ' : '';

// Class list
$block_classes_arr  = array( $class_name, $block_classes, $block_image, $block_overlay);

// JSX Innerblocks - https://www.billerickson.net/innerblocks-with-acf-blocks/
$allowed_blocks = array( 'core/heading', 'core/paragraph', 'core/button' );
$block_template = array(
	array(
		'core/heading',
		array(
			'level'       => 3,
			'placeholder' => 'Add lede...',
		),
	),
	array(
		'core/heading',
		array(
			'level'       => 2,
			'placeholder' => 'Add title...',
		),
	),
	array(
		'core/paragraph',
		array(
			'placeholder' => 'Add content...',
		),
	),
);
?>

<div id="<?php echo $block_id; ?>" class="<?php echo esc_attr( implode( ' ', $block_classes_arr ) ); ?>"<?php echo ($block_styles ? ' style="' . $block_styles . '"' : ''); ?>>

			<?php if ( ! empty( $image ) ) : ?>  
				<?php
				$image_tiny        = $image['sizes']['sigur-tiny'];
				if($image_mobile) {
					$image_small = $image_mobile['sizes']['sigur-medium'];	
					$image_small_width  = esc_attr( $image_mobile['sizes']['sigur-medium-width'] );
					$image_small_height = esc_attr( $image_mobile['sizes']['sigur-medium-height'] );
				} else {
					$image_small = $image['sizes']['sigur-medium'];
					$image_small_width  = esc_attr( $image['sizes']['sigur-medium-width'] );
					$image_small_height = esc_attr( $image['sizes']['sigur-medium-height'] );
				}
				$image_large       = $image['sizes']['sigur-large'];
				$image_alt         = esc_attr( $image['alt'] );
				$image_width       = esc_attr( $image['width'] );
				$image_height      = esc_attr( $image['height'] );
				// For Low quality image placeholders (LQIP)
				$type   = pathinfo( $image_tiny, PATHINFO_EXTENSION );
				$data   = file_get_contents( $image_tiny );
				$base64 = 'data:image/' . $type . ';base64,' . base64_encode( $data );
				?>
				<?php if ( $overlay ) : ?>
				<style>
					#<?php echo $block_id; ?>.sigur-banner:before {
						display: block;
						z-index: 2;
						content: '';
						position: absolute;
						top: 0;
						right: 0;
						bottom: 0;
						left: 0;
						background-color: <?php echo $overlay; ?>;
						opacity:<?php echo ($overlay_opacity ? $overlay_opacity : '0.7'); ?>;
					}
				</style>
				<?php endif; ?>  
					<div class="block__background">
						<figure>
						<picture>
							<source media="(min-width: 900px)" srcset="<?php echo $image_large; ?>">
							<img 
							src="<?php echo $image_small; ?>" 
							width="<?php echo $image_small_width; ?>" 
							height="<?php echo $image_small_height; ?>" 
							alt="<?php echo $image_alt ?>" 
							loading="lazy" 
							style="background-image: url(<?php echo $base64; ?>)" 
							/>
						</picture>
						</figure>
					</div>
			<?php endif; ?>    

			<div class="sigur-banner__wrapper">
				<div class="sigur-banner__inner">   

				<div class="sigur-banner__content">
					<InnerBlocks allowedBlocks="<?php echo esc_attr( wp_json_encode( $allowed_blocks ) ); ?>" template="<?php echo esc_attr( wp_json_encode( $block_template ) ); ?>" />
				</div>
				
				</div>
			</div>

</div>
