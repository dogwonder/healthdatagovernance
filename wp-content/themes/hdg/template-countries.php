<?php
/**
 * Template Name: Country snapshots
 *
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package hdg
 */

get_header();

global $post;
$paged       = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$numberposts = '-1';

$post_args = array(
	'post_type'      => 'country',
	'posts_per_page' => $numberposts,
	'post_status'    => 'publish'
);

$country_query = new WP_Query( $post_args );
?>
<style>
#svg-map {
	fill: none;
	width: 100%;
}
#background {
	fill: none;
}
text {
	text-anchor: middle;
	cursor: default;
	font-family: Arial, Helvetica, sans-serif;
}
.landxx {
	stroke-width: 0.5;
	fill-rule: evenodd;
	fill: var(--wp--preset--color--light);
	stroke: var(--wp--preset--color--dark);
}

.coastxx {
	stroke-width: 0.2;
}

.limitxx {
	opacity: 0;
	/* Change opacity to 1 to display all territories */
}

.antxx {
	opacity: 1;
	/* Change opacity to 0 to hide all territories */
}

/* Hover animation */
g,
path {
	transition: fill 0.24s ease-in-out;
}

g:hover path, path:hover, path.hover, g.hover path {
	cursor: pointer;
	fill: var(--wp--preset--color--green);
}

</style>

<div id="primary" class="hdg-content-wrapper">
	<?php
	while ( have_posts() ) :
		the_post();
		get_template_part( 'template-parts/_templates/content', 'page' );
	endwhile; // End of the loop.
	?>
	<hr />
	<?php if ( $country_query->have_posts() ) : ?>
		<div class="hdg-list">
		<?php
		while ( $country_query->have_posts() ) :
			$country_query->the_post();
			?>
			<div class="hdg-country">
				<?php the_title( '<span class="hdg-country__title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></span>' ); ?>
			</div>
		<?php endwhile; // End of the loop.
		endif;
		//https://github.com/ahuseyn/SVG-World-Map-with-labels?tab=readme-ov-file
		get_template_part( 'template-parts/_molecules/countries');
		?>

		</div>
		<?php wp_reset_postdata(); ?>
		<?php wp_reset_query(); ?>	
</div><!-- #primary -->
<?php
get_footer();
