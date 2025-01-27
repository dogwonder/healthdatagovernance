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

?>
<div class="hdg-card <?php echo has_post_thumbnail( $card )
    ? " has-post-thumbnail"
    : ""; ?> card-<?php echo $card_index; ?>"> 
	<div class="hdg-card__inner">

	<?php if($post_type == 'case-study') : ?>
		<div class="hdg-card__image hdg-card__image-placeholder hdg-card__image-placeholder--case-study">
			<img src="<?php echo get_template_directory_uri(); ?>/dist/images/logo.svg" alt="" loading="lazy" />
		</div>
	<?php else : ?>
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
	<?php endif; ?>
	
		
		<div class="hdg-card__content">

			<<?php echo $heading_level ?> class="hdg-card__heading">

			<?php 
			if($cards_type == 'article-card') :
				$article_link = get_field('article_link', $card) ?? '';
				if (!empty($article_link)) {
					echo '<a href="' . esc_url($article_link) . '">' . get_the_title($card) . '</a>';
				} else {
					echo '<a href="' . esc_url(get_permalink($card)) . '">' . get_the_title($card) . '</a>';
				}
			else : 
				if ($has_link) {
					echo '<a href="' . esc_url(get_permalink($card)) . '">' . get_the_title($card) . '</a>';
				} else {
					echo esc_html(get_the_title($card));
				}
			endif;
			?>

			</<?php echo $heading_level ?>>

			<?php if($has_meta) : ?>
				<div class="hdg-card__meta">
					<?php hdg_posted_on(); ?>
				</div>
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