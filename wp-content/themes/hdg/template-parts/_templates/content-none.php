<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package sigur
 */

?>
<div class="stack">
	<?php if ( ! empty( $_GET['s'] ) ) : ?>
	<h2>
		<?php
		/* translators: %s: search query. */
		printf( esc_html__( 'No results found for %s', 'sigur' ), '<span>' . get_search_query() . '</span>' );
		?>
	</h2>
	<?php else : ?>
	<h2><?php esc_html_e( 'No results found. Sorry.', 'sigur' ); ?></h2>
	<?php endif; ?>

	<div id="search-form" class="site-search">
		<?php echo do_blocks( '<!-- wp:search {"label":"Search","showLabel":false,"width":100,"widthUnit":"%","buttonText":"Search","buttonUseIcon":true} /-->' ); ?>
	</div>
</div>

