<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package hdg
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'hdg-post stack' ); ?> itemscope itemtype="http://schema.org/BlogPosting">

    <div class="hdg-block hdg-hero is-style-default  alignfull has-text-align-left has-image ">
        <div class="hdg-block__background">
        <figure>
            <picture>
            <source media="(min-width: 64em)" srcset="<?php echo get_template_directory_uri(); ?>/dist/images/hero/6-Community-1536x561.png">
            <img src="<?php echo get_template_directory_uri(); ?>/dist/images/hero/6-Community-640x234.png" alt="" width="640" height="234" style="background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAGCAYAAADKfB7nAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAA40lEQVQYlUXMOVLDUBRFwfMG6ctDYZyQUMWeCUlZIRhPkvXfJSCgF9D2+b5+TDs4HKOOL7B/Vr6+se730BGrQIAD4UaY4fzLxxJlAZebGK/QDqxfFzEDFkIG7jC4MUh4gMwwoHd5ni8wlOgpqollFD+C6SaGSQyD0QbYDMYmDApPhwwrd6s8nUQucJe4uvg20dai3cS0g90Wnibn0UAjkGBuRekvO59hbJX3K1xCa1jhvZOL2C1w7EYXIPMkSKMyhIfhQeU8UzVTdOGpsrGoEE4xB+TobJvYN6uHxNrxXlYrkAG/4CN1w1h+yngAAAAASUVORK5CYII=)" fetchpriority="high">
            </picture>
        </figure>
        </div>


        <div class="hdg-hero__wrapper">
            <div class="hdg-hero__inner">   
                <div class="hdg-hero__content stack">
                    <div class="acf-innerblocks-container">
                        <?php the_title( '<h1 class="wp-block-heading" itemprop="headline">', '</h1>' ); ?>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="entry-content wp-block-post-content is-layout-flow wp-block-post-content-is-layout-flow">
        <?php get_template_part( 'template-parts/_molecules/breadcrumb' ); ?>
	    <?php the_content(); ?>	
    </div>

	<div class="entry-footer">
	<?php
	$categories_list = get_the_category_list( esc_html__( ', ', 'hdg' ) );
	if ( $categories_list ) {
		/* translators: 1: list of categories. */
		printf( '<span class="cat-links">' . esc_html__( '%1$s', 'hdg' ) . '</span>', $categories_list ); // WPCS: XSS OK.
	}
	?>
	</div><!-- .entry-content -->
	
</article><!-- #post-<?php the_ID(); ?> -->
