<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package hdg
 */

?>
<?php
// Hide title via custom field
if ( class_exists( 'acf' ) ) {
	$hidden_title = get_field( 'hide_title' );
	$accent_colour  = get_field( 'accent_colour' ) ? : '';
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('hdg-page stack'); ?>>

	<?php if ( ! $hidden_title ) : ?>
	<div class="entry-header">
		<?php echo do_blocks( '<!-- wp:post-title {"level":1,"className":"wp-block-post-title"} /-->' ); ?>
	</div><!-- .entry-header -->
	<?php else : ?>
	<div class="entry-header visually-hidden">
		<?php echo do_blocks( '<!-- wp:post-title {"level":1,"className":"wp-block-post-title"} /-->' ); ?>
	</div><!-- .entry-header -->
	<?php endif; ?>
	
	<div class="entry-content wp-block-post-content is-layout-flow">
		<?php the_content(); ?>
	</div>

</article><!-- #post-<?php the_ID(); ?> -->