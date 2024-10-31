<?php
/**
 * Anchor Block Template.
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
$class_name = 'hdg-block hdg-carousel';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
// Class list
$block_classes_arr  = array( $class_name );

//Gallery
$gallery = get_field('carousel_gallery');
// print_r($gallery);
$size = 'hdg-medium'; 
?>
<div id="<?php echo $block_id; ?>" class="<?php echo esc_attr( implode( ' ', $block_classes_arr ) ); ?>">
	<?php if( $gallery ): ?>
	<script src="https://unpkg.com/smoothscroll-polyfill@0.4.4/dist/smoothscroll.js"></script>
	<div class="carousel-container">
    	<div x-data="carousel()" x-init="init">
			<div x-on:keydown.right="next" x-on:keydown.left="prev" tabindex="0" role="region" aria-labelledby="carousel-label" class="carousel">
				<h2 id="carousel-label" class="visually-hidden" hidden>Gallery</h2>
				<button x-on:click="prev" :aria-disabled="atBeginning" :tabindex="atEnd ? -1 : 0" :class="{ 'opacity-50 cursor-not-allowed': atBeginning }">
					<span aria-hidden="true">
						<svg xmlns="http://www.w3.org/2000/svg" class="" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
					</span>
				</button>
				<ul x-ref="slider" role="listbox" class="carousel-items">
					<?php foreach($gallery as $image): ?>
						<li class="carousel-item" role="option">
							<figure>
								<?php echo wp_get_attachment_image($image['id'], $size); ?>
							</figure>
						</li>
					<?php endforeach; ?>
				</ul>
				<button x-on:click="next" :aria-disabled="atEnd" :tabindex="atEnd ? -1 : 0" :class="{ 'opacity-50 cursor-not-allowed': atEnd }">
					<span aria-hidden="true">
						<svg xmlns="http://www.w3.org/2000/svg" class="" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
					</span>
				</button>
			</div>
		</div>
	</div>
	<?php endif; ?>

</div>
<?php wp_reset_postdata(); // Reset post data ?>