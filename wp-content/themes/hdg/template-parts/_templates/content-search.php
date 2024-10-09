<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package hdg
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'hdg-list__item' ); ?> itemscope itemtype="http://schema.org/BlogPosting">

	<div class="entry-header">
			<?php the_title( '<h2 class="wp-block-post-title hdg-list__title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
			<div class="entry-meta hdg-list__meta">
				<?php hdg_posted_on(); ?>
			</div><!-- .entry-meta -->
	</div><!-- .entry-header -->
	
	<div class="entry-content wp-block-post-content is-layout-flow">        
	
		<div class="hdg-list__wrapper">
			<div class="hdg-list__content">
					<?php
					// Display the excerpt is exists
					if ( has_excerpt( $post->ID ) ) {
						echo esc_html( get_the_excerpt( $post->ID ) );
					} else {
						echo esc_html( hdg_standfirst( 80, $post->ID ) );
					}
					?>
			</div><!-- /content-->   
		</div>

	 </div><!-- /wrapper-->   

</article><!-- #post-<?php the_ID(); ?> -->
