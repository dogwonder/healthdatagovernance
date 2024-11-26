<?php
/**
 * Template Name: Principles core elements
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

 <style>
	.hdg-contents-list__item.h3:before, 
	.entry-main h3:before {
		font: var(--fa-font-solid);
		background: none;
		width: auto;
		display: inline-block;
  		text-rendering: auto;
  		-webkit-font-smoothing: antialiased;
		margin-inline-end: 1ch;
	} 

  .protect-individuals-and-communities:before, 
  #h-protect-individuals-and-communities:before {
 	content: '\e533';
  }

  .build-trust-in-data-systems:before, 
  #h-build-trust-in-data-systems:before {
	content: '\f2b5';
  }

  .ensure-data-security:before, 
  #h-ensure-data-security:before {
	content: '\f023';
  }

  .enhance-health-systems-and-services:before, 
  #h-enhance-health-systems-and-services:before {
	content: '\e3b2';
  }

  .promote-data-sharing-and-interoperability:before, 
  #h-promote-data-sharing-and-interoperability:before {
	content: '\f0ee';
  }

  .facilitate-innovation-using-health-data:before, 
  #h-facilitate-innovation-using-health-data:before {
	content: '\f0eb';
  }

  .promote-equitable-benefits-from-health-data:before,
  #h-promote-equitable-benefits-from-health-data:before {
	content: '\f63d';
  }

  .establish-data-rights-and-ownership:before, 
  #h-establish-data-rights-and-ownership:before {
	content: '\e05c';
  }
</style>
 
	 <div id="primary" class="hdg-content-wrapper">

	 	<article id="post-<?php the_ID(); ?>" <?php post_class('hdg-page stack'); ?>>

	 	<div class="entry-wrapper">
        	<div class="entry-wrapper__inner">
				<div class="entry-sidebar stack">
					<div class="sticky">
					<?php 
					$contentsList = HDG_Site_Public::hdg_list_post_headings(false, array(2, 3));

					if ($contentsList) {
						echo '<nav class="hdg-contents-list" aria-label="Sections in this page" role="navigation" id="navbar-contents-list" x-data="scrollSpy()">';
						echo '<h2 class="hdg-contents-list__title visually-hidden">' . __('Page contents', 'hdg') . '</h2>';
						echo '<ol class="hdg-contents-list__list">';
						echo $contentsList;
						echo '</ol>';
						echo '</nav>';
					}
					?>
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
 
