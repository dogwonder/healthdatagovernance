<?php
/**
 * Accordion Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$block_id = $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$block_id = $block['anchor'];
}
// Create class attribute allowing for custom "className" and "align" values. and "align" values.
$class_name = 'hdg-block';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}

// Block attributes (set in native block editor)
$block_attrs  = hdg_Site_Public::hdg_get_block_attrs( $block ) ? : '';
$block_classes = $block_attrs['class'] ? $block_attrs['class'] : '';
$block_styles = $block_attrs['style'] ? $block_attrs['style'] : '';

// Block fields
$accordion_columns = get_field( 'accordion_columns' ) ? : '';

// Class list
$block_classes_arr = array( $class_name, $block_classes );
?>
<div id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( implode( ' ', $block_classes_arr ) ); ?>"<?php echo ($block_styles ? ' style="' . $block_styles . '"' : ''); ?>>
		<div class="hdg-accordion-columns" id="accordion-default">
		<?php
		if ( have_rows( 'accordion_columns' ) ) :
			while ( have_rows( 'accordion_columns' ) ) :
				the_row();
				?>
			<?php // print_r($accordion_columns); ?>
			<?php
			$accordion_column_heading = esc_html( get_sub_field( 'heading' ) ) ? : '';
			$accordion_column_content = get_sub_field( 'content' ) ? : '';
			$accordion_column_pdf = get_sub_field( 'pdf' ) ? : '';
			?>
			<div x-data="{ open: false }">
				<div class="hdg-accordion__section" :class="{ 'open': open }">

						<div class="hdg-accordion__section-counter">
							<span class="hdg-accordion__section-counter-number"><?php echo get_row_index(); ?></span>
						</div>

						<div class="hdg-accordion__section-header">
							<h4 id="hdg-default-heading-<?php echo get_row_index(); ?>" class="hdg-accordion__section-title">
								<span class="hdg-accordion__section-title-text" x-on:click="open = !open" x-bind:aria-expanded="open.toString()">
									<?php echo $accordion_column_heading; ?>
								</span>
							</h4>
						</div>

						<div id="hdg-default-content-<?php echo get_row_index(); ?>" class="hdg-accordion__section-content stack" aria-labelledby="hdg-default-heading-<?php echo get_row_index(); ?>" x-on:click="open" x-bind:aria-expanded="open.toString()">
							<?php echo $accordion_column_content; ?>
							<?php if($accordion_column_pdf) : 
								 $accordion_column_url = $accordion_column_pdf['url'];	
							?>
								<p><a href="<?php echo $accordion_column_url; ?>" target="_blank" class="hdg-accordion__section-pdf hdg-button hdg-button--small">Read more</a></p>
							<?php endif; ?>
						</div>
						
						<div class="hdg-accordion__section-button">
							<button class="hdg-accordion__section-button" x-on:click="open = !open" aria-controls="hdg-default-content-<?php echo get_row_index(); ?>" x-bind:aria-expanded="open.toString()" aria-label="Toggle accordion content">
								<span class="hdg-accordion__section-button-text visually-hidden">Show/Hide</span>
								<span class="hdg-accordion__section-button-icon" aria-hidden="true">
									<svg class="button-open" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM385 215c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-71-71L280 392c0 13.3-10.7 24-24 24s-24-10.7-24-24l0-214.1-71 71c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9L239 103c9.4-9.4 24.6-9.4 33.9 0L385 215z"/></svg>
									<svg class="button-close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Pro 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2025 Fonticons, Inc.--><path d="M256 32a224 224 0 1 0 0 448 224 224 0 1 0 0-448zm0 480A256 256 0 1 1 256 0a256 256 0 1 1 0 512zM363.3 283.3l-96 96c-6.2 6.2-16.4 6.2-22.6 0l-96-96c-6.2-6.2-6.2-16.4 0-22.6s16.4-6.2 22.6 0L240 329.4 240 144c0-8.8 7.2-16 16-16s16 7.2 16 16l0 185.4 68.7-68.7c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"/></svg>
								</span>
							</button>
						</div>
						

				</div>
			</div>

			<?php
			endwhile;
			endif;
			?>

		</div>
</div>
