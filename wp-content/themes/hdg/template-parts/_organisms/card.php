<?php

/**
 * Template part for displaying cards
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package sigur
 */
?>
<div class="sigur-card<?php echo ( has_post_thumbnail() ? ' has-image' : '' ); ?>">
	<a class="sigur-card__link-wrapper" href="<?php the_permalink(); ?>">
		<?php if ( has_post_thumbnail() ) { ?>
			<?php
			the_post_thumbnail(
				'sigur-medium-crop',
				array(
					'alt'   => the_title_attribute(
						array(
							'echo' => false,
						)
					),
					'class' => 'sigur-card__image',
				)
			);
			?>
		<?php } ?>
		<div class="sigur-card__content">
			<h2 class="sigur-card__heading"><?php the_title(); ?></h2>
			<div class="sigur-card__description">
			<?php
			// Display the excerpt is exists
			if ( has_excerpt( $post->ID ) ) {
				echo esc_html( get_the_excerpt( $post->ID ) );
			} else {
				echo esc_html( sigur_standfirst( 30, $post->ID ) );
			}
			?>
			</div>
		</div>
	</a>
</div>