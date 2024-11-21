<?php

/**
 * Template part for displaying cards
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package hdg
 */
?>
<div class="hdg-card<?php echo ( has_post_thumbnail() ? ' has-image' : '' ); ?>">
	<a class="hdg-card__link-wrapper" href="<?php the_permalink(); ?>">
		<?php if ( has_post_thumbnail() ) { ?>
			<?php
			the_post_thumbnail(
				'hdg-medium-crop',
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
		</div>
	</a>
</div>