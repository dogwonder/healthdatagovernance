<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package hdg
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'hdg-list__item' ); ?> itemscope itemtype="http://schema.org/BlogPosting">

	<div class="hdg-list__header">
			<?php the_title( '<h2 class="hdg-list__title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
			<div class="entry-meta hdg-list__meta">
				<?php hdg_posted_on(); ?>
			</div>
	</div><!-- .entry-header -->

	<div class="hdg-list__content">
		<?php
		// Display the excerpt is exists
		if ( has_excerpt( $post->ID ) ) {
			echo esc_html( get_the_excerpt( $post->ID ) );
		} else {
			echo esc_html( hdg_standfirst( 80, $post->ID ) );
		}
		?>
		<?php
		$categories_list = get_the_category_list( esc_html__( ', ', 'hdg' ) );
		if ( $categories_list ) {
			/* translators: 1: list of categories. */
			printf( '<span class="cat-links">' . esc_html__( '%1$s', 'hdg' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}
		?><!-- .entry-footer -->
	</div><!-- /content-->   
		<!-- /wrapper-->   

</article><!-- #post-<?php the_ID(); ?> -->
