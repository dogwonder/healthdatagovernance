<?php
/**
 * Template Name: Guide page
 *
 * The template for displaying a guide
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package dgwltd
 */

get_header();

// Post parent ID (which can be 0 if there is no parent)
$parent = wp_get_post_parent_id( $id );

// Check the page template so we can ignore stray parents
$page_template = get_page_template_slug( $parent );

if ( class_exists( 'acf' ) ) {
	$hidden_title     = esc_html( get_field( 'hide_title' ) );
	$overridden_title = esc_html( get_field( 'overide_title', $post->ID ) );
}
?>
<div id="primary" class="hdg-content-wrapper">
	
<?php while ( have_posts() ) : the_post(); ?>
	
		<article id="post-<?php the_ID(); ?>" <?php post_class('hdg-page stack'); ?>>

			<?php
			// First we need to check where we are in the tree, if the current page is not the parent page then display the title of the parent page
			if ( ! $parent ) :
			?>
			
			
			<div class="entry-header">
				<?php get_template_part( 'template-parts/_molecules/breadcrumb' ); ?>
				<h1 class="wp-block-post-title<?php echo ( $hidden_title ? ' visually-hidden' : '' ); ?>"><?php the_title(); ?></h1>
			</div><!-- .entry-header -->
			<?php else : ?>
			<div class="entry-header">
				<?php if ( $page_template === 'template-guide.php' ) : ?>
				<h1 class="wp-block-post-title<?php echo ( $hidden_title ? ' visually-hidden' : '' ); ?>"><?php echo esc_html( get_the_title( $parent ) ); ?></h1>
				<?php else : ?>
				<h1 class="wp-block-post-title<?php echo ( $hidden_title ? ' visually-hidden' : '' ); ?>"><?php echo esc_html( get_the_title( $post->ID ) ); ?></h1>
				<?php endif; ?>
			</div><!-- .entry-header -->
			<?php endif; ?>	

			<div class="entry-content wp-block-post-content is-layout-flow">

				<?php get_template_part( 'template-parts/_molecules/contents-list' ); ?>

				<?php
				// If this is the parent page (and an extra check for template type) then display the current page title (or custom title)
				if ( $parent && $page_template === 'template-guide.php' ) :
					?>
					<?php if ( ! empty( $overridden_title ) ) : ?>
					<h2 class="govuk-heading-l<?php echo ( $hidden_title ? ' visually-hidden' : '' ); ?>"><?php echo $overridden_title; ?></h2>
					<?php else : ?>
					<h2 class="govuk-heading-l<?php echo ( $hidden_title ? ' visually-hidden' : '' ); ?>"><?php echo get_the_title( $post->ID ); ?></h2>
					<?php endif; ?>
				<?php endif; ?>

				<?php the_content(); ?>						
		
				<?php get_template_part( 'template-parts/_molecules/contents-navigation' ); ?>

			</div>

		</article><!-- #post-<?php the_ID(); ?> -->
	<?php endwhile; // End of the loop. ?>

</div><!-- #primary -->

<?php
get_footer();