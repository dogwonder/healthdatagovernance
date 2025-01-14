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

						<div id="hdg-default-content-<?php echo get_row_index(); ?>" class="hdg-accordion__section-content" aria-labelledby="hdg-default-heading-<?php echo get_row_index(); ?>">
							<?php echo $accordion_column_content; ?>
						</div>
						
						<div class="hdg-accordion__section-button">
							<button class="hdg-accordion__section-button" x-on:click="open = !open" aria-controls="hdg-default-content-<?php echo get_row_index(); ?>" x-bind:aria-expanded="open.toString()" aria-label="Toggle accordion content">
								<span class="hdg-accordion__section-button-text visually-hidden">Show/Hide</span>
								<span class="hdg-accordion__section-button-icon" aria-hidden="true">
									<svg class="button-open" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"/></svg>
									<svg class="button-close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M464 256A208 208 0 1 0 48 256a208 208 0 1 0 416 0zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256z"/></svg>
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
