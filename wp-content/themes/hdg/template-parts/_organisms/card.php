<?php

/**
 * Template part for displaying cards
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package hdg
 */
$article_link = get_field( 'article_link' );
if ( $article_link ) {
	$card_link = $article_link;
} else {
	$card_link = get_the_permalink();
}
?>
<div class="hdg-card<?php echo ( has_post_thumbnail() ? ' has-image' : '' ); ?>">
	<a class="hdg-card__link-wrapper" href="<?php echo $card_link ?>">
		<?php if ( has_post_thumbnail() ) { ?>
			<?php
			the_post_thumbnail(
				'hdg-medium',
				array(
					'alt'   => the_title_attribute(
						array(
							'echo' => false,
						)
					),
					'class' => 'hdg-card__image',
				)
			);
			?>
		<?php } ?>
		<div class="hdg-card__content">
			<h2 class="hdg-card__heading"><?php the_title(); ?></h2>
		</div>
	</a>
</div>