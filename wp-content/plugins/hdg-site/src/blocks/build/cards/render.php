<?php
/**
 * Details Cards Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$block_id = $block["id"];
if (!empty($block["anchor"])) {
    $block_id = $block["anchor"];
}
// Create class attribute allowing for custom "className" and "align" values. and "align" values.
$class_name = "sigur-block sigur-cards sigur-section";
if (!empty($block["className"])) {
    $class_name .= " " . $block["className"];
}

// Block attributes (set in native block editor)
$block_attrs  = Sigur_Site_Public::sigur_get_block_attrs( $block ) ? : '';
$block_classes = $block_attrs["class"] ? $block_attrs["class"] : "";
$block_styles = $block_attrs["style"] ? $block_attrs["style"] : "";

// Class list
$block_classes_arr = [$class_name, $block_classes];

// JSX Innerblocks - https://www.billerickson.net/innerblocks-with-acf-blocks/
$allowed_blocks = ["core/heading", "acf/sigur-cards-query"];

//If layout_type is grid, use grid template
$block_template = [
    [
        "core/heading",
        [
            "level" => 2,
            "placeholder" => "Add section title...",
            "className" => "sigur-section-title",
        ],
    ],
    ["acf/sigur-cards-query"],
];
?>
<div id="<?php echo esc_attr($block_id); ?>" class="<?php echo esc_attr(
    implode(" ", $block_classes_arr)
); ?>"<?php echo $block_styles ? ' style="' . $block_styles . '"' : ""; ?>>

	<div class="sigur-cards__content">	

		<InnerBlocks allowedBlocks="<?php echo esc_attr(
      wp_json_encode($allowed_blocks)
  ); ?>" template="<?php echo esc_attr(
    wp_json_encode($block_template)
); ?>" templateLock="all" />
	
	</div>

</div>