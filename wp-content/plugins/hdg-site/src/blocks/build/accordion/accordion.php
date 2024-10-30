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
$class_name = 'hdg-block hdg-accordion';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}

// Block attributes (set in native block editor)
$block_attrs  = hdg_Site_Public::hdg_get_block_attrs( $block ) ? : '';
$block_classes = $block_attrs['class'] ? $block_attrs['class'] : '';
$block_styles = $block_attrs['style'] ? $block_attrs['style'] : '';

// Block fields
$accordion_sections = get_field( 'accordion_sections' ) ? : '';

// Class list
$block_classes_arr = array( $class_name, $block_classes );
?>
<div id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( implode( ' ', $block_classes_arr ) ); ?>"<?php echo ($block_styles ? ' style="' . $block_styles . '"' : ''); ?>>
		<div class="govuk-accordion" data-module="govuk-accordion" id="accordion-default">
		<?php
		if ( have_rows( 'accordion_sections' ) ) :
			while ( have_rows( 'accordion_sections' ) ) :
				the_row();
				?>
			<?php // print_r($accordion_sections); ?>
			<?php
			$accordion_section_heading = esc_html( get_sub_field( 'heading' ) ) ? : '';
			$accordion_section_content = get_sub_field( 'content' ) ? : '';
			?>
				
			<div class="govuk-accordion__section">

					<div class="govuk-accordion__section-header">
					<h2 class="govuk-accordion__section-heading">
						<span class="govuk-accordion__section-button" id="accordion-default-heading-<?php echo get_row_index(); ?>">
							<?php echo $accordion_section_heading; ?>
						</span>
					</h2>
					</div>

					<div id="accordion-default-content-<?php echo get_row_index(); ?>" class="govuk-accordion__section-content" aria-labelledby="accordion-default-heading-<?php echo get_row_index(); ?>">
						<?php echo $accordion_section_content; ?>
					</div>

			</div>

			<?php
			endwhile;
			endif;
			?>

		</div>
</div>
