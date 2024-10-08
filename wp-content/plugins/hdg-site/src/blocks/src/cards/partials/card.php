<?php
/**
 * Template part for displaying cards - based on ID variable
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cfc
 */
?>
<?php
//Image
$image = wp_get_attachment_image_url(
    get_post_thumbnail_id($card),
    $thumbnail_size
);
$image_alt = get_post_meta(
    get_post_thumbnail_id($card),
    "_wp_attachment_image_alt",
    true
);
$has_image = has_post_thumbnail($card) ? true : false;
$is_featured = ( $featured == $card ) ? true : false;
?>
<div class="hdg-card <?php echo has_post_thumbnail( $card )
    ? " has-post-thumbnail"
    : ""; ?> card-<?php echo $card_index; ?><?php echo ( $is_featured ) ? ' is-featured' : ''; ?>"> 
	<div class="hdg-card__inner">

	<?php if ($has_image): ?>
			<?php if (!empty($image)): ?>
			<figure class="hdg-card__image">
			<picture>
				<?php if (has_post_thumbnail($card)) { ?>
				<img src="<?php echo $image; ?>" alt="<?php echo $image_alt
    ? $image_alt
    : ""; ?>" loading="lazy" />
				<?php } ?>
			</picture>
			</figure>
			<?php endif; ?>
	<?php else : ?>
			<div class="hdg-card__image hdg-card__image-placeholder"></div>
	<?php endif; ?>
		
		<div class="hdg-card__content">

			<?php if ($has_kicker) { ?>
				<?php require HDG_SITE_PLUGIN_BLOCKS . 'build/cards/partials/taxonomy.php'; ?>
			<?php } ?>

			<<?php echo $heading_level ?> class="hdg-card__heading">

				<a class="hdg-card__link" href="<?php echo esc_url(get_permalink($card)); ?>">
					<?php echo esc_html(get_the_title($card)); ?>
            	</a>

			</<?php echo $heading_level ?>>

			<?php if($has_meta) : ?>
				<div class="hdg-card__meta">
					<?php hdg_posted_on(); ?>
				</div>
			<?php endif; ?>

			<?php if($has_date) :
				//start date
				$start_date = get_field('event_start_date', $card);
				//Convert to date object
				$start_date = new DateTime($start_date);
				//Format date
				$start_date = $start_date->format('j F Y');
				$end_date = get_field('event_end_date', $card) ?? '';
				?>
				<span class="hdg-card__date">
				<?php 
				//Echo start date and end date but only end date if it exists
				echo $start_date;
				if ($end_date) {
					//Convert to date object
					$end_date = new DateTime($end_date);
					//Format date
					$end_date = $end_date->format('j F Y');
					echo ' &mdash; ' . $end_date;
				}
				?>
				</span>
			<?php endif; ?>

   			<?php if($has_description) : ?>
				<div class="hdg-card__excerpt">
				<?php 
				if (has_excerpt($card)) {
					echo esc_html(get_the_excerpt($card));
				} else {
					echo esc_html(hdg_standfirst(30, $card));
				}
				?> 
				</div>
			<?php endif; ?>

			<?php if($has_author) : ?>
				<?php hdg_posted_by(); ?>
			<?php endif; ?>
			
		</div>



	</div>
</div>