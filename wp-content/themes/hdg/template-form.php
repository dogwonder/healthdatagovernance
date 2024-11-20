<?php
/**
 * Template Name: Form
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
							<nav class="hdg-contents-list" aria-label="Sections in this page" role="navigation" id="navbar-contents-list" x-data="scrollSpy()">
								<h2 class="hdg-contents-list__title visually-hidden"><?php esc_html_e( 'Page contents', 'hdg' ); ?></h2>
								<ol class="hdg-contents-list__list">
									<li><a href="#step-1"><?php esc_html_e( 'Step 1 - Country-Specific Legislation', 'hdg' ); ?></a></li>
									<li><a href="#step-2"><?php esc_html_e( 'Step 2 - Country-Specific Detail', 'hdg' ); ?></a></li>
									<li><a href="#step-3"><?php esc_html_e( 'Step 3 - Country-Specific Summary', 'hdg' ); ?></a></li>
								</ol>
							</nav>
						</div>
				</div>

				<div class="entry-main stack">
						
					<?php get_template_part( 'template-parts/_tools/form' ); ?>			

				</div>
			</div>
		</div>

		</article>
		
	 </div><!-- #primary -->
 
 <?php
 get_footer();
 
