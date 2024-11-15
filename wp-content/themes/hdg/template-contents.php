<?php
/**
 * Template Name: Contents navigation
 *
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package hdg
 */

 get_header();
// Hide title via custom field
if ( class_exists( 'acf' ) ) {
	$hidden_title = get_field( 'hide_title' );
}
 ?>
 
	 <div id="primary" class="hdg-content-wrapper">

	 	<article id="post-<?php the_ID(); ?>" <?php post_class('hdg-page stack'); ?>>

	 	<div class="entry-wrapper">
        	<div class="entry-wrapper__inner">
				<div class="entry-sidebar stack">
					<div class="sticky">
						<?php include locate_template('template-parts/_partials/contents-list-headings.php');  ?>
					</div>
				</div>
				<div class="entry-main stack">

					<?php if ( ! $hidden_title ) : 
                    the_title(
                        '<h1 class="hdg-page-header__title" itemprop="headline">',
                        "</h1>"
                    );
					endif;
                    ?>
					<?php the_content(); ?>
				</div>

			</div>
		</div>

		</article>
		
	 </div><!-- #primary -->
 
 <?php
 get_footer();
 
