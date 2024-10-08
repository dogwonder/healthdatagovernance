<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package sigur
 */

get_header();
?>

	<div id="primary" class="sigur-content-wrapper">

		<div class="entry-header">
			<h1 class="wp-block-post-title">
				<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>
			</h1>
		</div>

		<div class="entry-content wp-block-post-content is-layout-flow">

			<?php if ( have_posts() ) : ?>
				<div class="sigur-list">
					<?php
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/_templates/content-list' );

					endwhile;
					?>
				</div><!-- .sigur-list -->

				<?php
					get_template_part( 'template-parts/_molecules/pagination' );
				else :
					get_template_part( 'template-parts/_templates/content', 'none' );
				endif;
				?>
			</div>
	
		</div><!-- #primary -->

<?php
get_footer();
