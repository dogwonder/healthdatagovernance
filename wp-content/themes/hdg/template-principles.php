<?php
/**
 * Template Name: Principles
 *
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package hdg
 */

get_header();
?>
<style>
	#principles {
		max-width: 50%;
	}
	.hdg-content-wrapper {
		text-align:center;
	}
</style>
<div id="primary" class="hdg-content-wrapper">

	<?php 
	get_template_part( 'template-parts/_molecules/principles' );
	?>

	<?php
	while ( have_posts() ) :
		the_post();
		get_template_part( 'template-parts/_templates/content', 'page' );
	endwhile; // End of the loop.
	?>
</div><!-- #primary -->
<?php
get_footer();
