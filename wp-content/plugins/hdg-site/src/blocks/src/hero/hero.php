<?php
/**
 * Hero Block Template.
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
$class_name = 'hdg-block hdg-hero';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}

// Random ID
$rand = substr( md5( microtime() ), wp_rand( 0, 26 ), 5 );

// Image
$image           = get_field( 'background_image' ) ? : '';
// Video
$has_video        = get_field( 'has_video' ) ? : '';
$video           = get_field( 'video', false, false );

//Logo	
$has_logo        = get_field( 'has_logo' ) ? : '';

// Block attributes (set in native block editor)
$block_attrs  = HDG_Site_Public::hdg_get_block_attrs( $block ) ? : '';
$block_classes = $block_attrs['class'] ? $block_attrs['class'] : '';
$block_styles = $block_attrs['style'] ? $block_attrs['style'] : '';

$overlay  = get_field( 'overlay' ) ? : '';
if($overlay) {
	//Convert to RGB
	$overlay_color  = get_field( 'overlay_color' ) ? : '';
	$hex2rgb = HDG_Site_Public::hdg_hex2rgb( $overlay_color );
	$overlay_opacity  = get_field( 'overlay_opacity' ) ? : '0.7';
	$overlay_opacity = $overlay_opacity / 100;
	//Loop through RGB values and add opacity
	$overlay_rgb = 'rgba(' . $hex2rgb[0] . ',' . $hex2rgb[1] . ',' . $hex2rgb[2] . ')';
	$overlay_rgba = 'rgba(' . $hex2rgb[0] . ',' . $hex2rgb[1] . ',' . $hex2rgb[2] . ',' . $overlay_opacity . ')';
	$overlay_rgba_full = 'rgba(' . $hex2rgb[0] . ',' . $hex2rgb[1] . ',' . $hex2rgb[2] . ', 0)';
}

// Classes
$block_image   = $image ? 'has-image ' : '';
$block_video   = $video ? 'has-video ' : '';
$block_overlay  = $overlay ? 'has-overlay ' : '';
$block_logo = $has_logo ? 'has-logo ' : '';

// Class list
$block_classes_arr = array( $class_name, $block_classes, $block_image, $block_video, $block_overlay, $block_logo);

// JSX Innerblocks - https://www.billerickson.net/innerblocks-with-acf-blocks/
$allowed_blocks = array( 'core/heading', 'core/paragraph', 'core/list', 'core/button' );
$block_template = array(
	array(
		'core/heading',
		array(
			'level'       => 1,
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

				//Consider using 'bits' for this and using the pages feaured image 
				//https://make.wordpress.org/core/2024/06/08/proposal-bits-as-dynamic-tokens/ 
				
				$image_tiny        = $image['sizes']['hdg-tiny'];
				$image_small = $image['sizes']['hdg-medium'];
				$image_small_width  = esc_attr( $image['sizes']['hdg-medium-width'] );
				$image_small_height = esc_attr( $image['sizes']['hdg-medium-height'] );
				$image_large       = $image['sizes']['hdg-large'];
				$image_alt         = esc_attr( $image['alt'] );
				$image_width       = esc_attr( $image['width'] );
				$image_height      = esc_attr( $image['height'] );
				// For Low quality image placeholders (LQIP)
				$type   = pathinfo( $image_tiny, PATHINFO_EXTENSION );
				$data   = file_get_contents( $image_tiny );
				$base64 = 'data:image/' . $type . ';base64,' . base64_encode( $data );
				?>
				<link rel="preload" href="<?php echo $image_small; ?>" as="image" media="(max-width: 39.6875em)">
				<link rel="preload" href="<?php echo $image_large; ?>" as="image" media="(min-width: 40.0625em)">
				<?php if ( $overlay ) : ?>
					<style>
					#<?php echo $block_id; ?>.hdg-hero:before {
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
					<?php 
					//Don't lazyload this https://cloudfour.com/thinks/stop-lazy-loading-product-and-hero-images/
					?>
					<figure>
						<picture>
							<source media="(min-width: 64em)" srcset="<?php echo $image_large; ?>">
							<img 
							src="<?php echo $image_small; ?>" 
							alt="<?php echo $image_alt ?>" 
							width="<?php echo $image_small_width; ?>" 
							height="<?php echo $image_small_height; ?>" 
							style="background-image: url(<?php echo $base64; ?>)" 
							fetchpriority="high"
							/>
						</picture>
					</figure>
				</div>
			<?php endif; ?> 
			
			<?php if ( ! empty( $video ) && $has_video) : 
			$parse = parse_url( $video );

			if ( $parse['host'] == 'youtu.be' ) {
				$video_type = 'youtube';
				$video_id   = ltrim( $parse['path'], '/' );
			}

			if ( ( $parse['host'] == 'youtube.com' ) || ( $parse['host'] == 'www.youtube.com' ) ) {

				$video_type = 'youtube';						
				$video_id   = ltrim( $parse['query'], 'v=' );

				if ( strpos( $parse['path'], 'embed' ) == 1 ) {
					$video_id = end( explode( '/', $parse['path'] ) );
				}
			}
			if ( ( $parse['host'] == 'vimeo.com' ) || ( $parse['host'] == 'www.vimeo.com' ) ) {
				$video_type = 'vimeo';
				$video_id   = ltrim( $parse['path'], '/' );
			}
			?>
			<?php if ( $video_type == 'youtube' ) { ?>
					<iframe 
					id="youtube_player" 
					title="<?php esc_html_e( 'Video modal', 'hdg' ); ?>"
					src="http://www.youtube.com/embed/<?php echo $video_id; ?>?enablejsapi=1" 
					frameborder="0" 
					allowfullscreen 
					></iframe>
				<?php } ?>
				<?php if ( $video_type == 'vimeo' ) { ?>
					<iframe 
					id="vimeo_player" 
					title="<?php esc_html_e( 'Video modal', 'hdg' ); ?>"
					src="https://player.vimeo.com/video/<?php echo $video_id; ?>" 
					frameborder="0" 
					allowfullscreen 
					></iframe>
				<?php } ?>
			<?php endif; ?>


			<div class="hdg-hero__wrapper">

				<div class="hdg-hero__inner">   

					<div class="hdg-hero__content stack">

						<?php if ( isset( $block_logo ) && ! empty( $block_logo ) ) : ?>
							<div class="hdg-hero__logo">
								<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/dist/images/logo-alt.png" alt="<?php esc_html_e( 'Sigur Rós', 'hdg' ); ?>">
							</div>
						<?php endif; ?>

						<InnerBlocks allowedBlocks="<?php echo esc_attr( wp_json_encode( $allowed_blocks ) ); ?>" template="<?php echo esc_attr( wp_json_encode( $block_template ) ); ?>" />
						
						

					</div>
				</div>

			</div>

</div>