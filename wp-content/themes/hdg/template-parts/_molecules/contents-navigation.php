<?php
// Get current post
$currentpost_id = $post->ID;

// Post parent ID (which can be 0 if there is no parent);
$parent = wp_get_post_parent_id( $currentpost_id );

// Check the page template so we can ignore stray parents
$page_template = get_page_template_slug( $parent );

if ( $page_template !== 'template-guide.php' ) :
	$parent_id = $post->ID;
else :
	$parent_id = $parent;
endif;

if ( $parent ) :

	// Get all the children of the parent based on menu order
	$childpages = get_pages(
		array(
			'child_of'       => $parent_id,
			'sort_column'    => 'menu_order',
			'sort_order'     => 'asc',
			'posts_per_page' => -1,
		)
	);

	// Get the child page IDs and add the parent to the beginning
	$children_ids = wp_list_pluck( $childpages, 'ID' );
	$ids          = array_merge( array( $parent ), $children_ids );

else :

	// Get all the children of this page based on menu order
	$childpages = get_pages(
		array(
			'child_of'       => $post->ID,
			'sort_column'    => 'menu_order',
			'sort_order'     => 'asc',
			'posts_per_page' => -1,
		)
	);

	// Get the child page IDs
	$children_ids = wp_list_pluck( $childpages, 'ID' );
	$ids          = $children_ids;

endif;

if ( is_page() && count( $childpages ) > 0 ) :

	// Now get all the pages
	$args        = array(
		'include'        => $ids,
		'sort_column'    => 'menu_order',
		'sort_order'     => 'asc',
		'posts_per_page' => -1,
	);
	$guide_pages = get_pages( $args );

	// Include the parent ID
	$page_ids = wp_list_pluck( $guide_pages, 'ID' );

	// Get current index
	$current = array_search( get_the_ID(), $page_ids );

	// Get next and prev IDs for child pages
	if ( $parent ) :
		// If the parent is not a guide template that don't link to it
		if ( $page_template === 'template-guide.php' ) :
			$prev_id = ( isset( $page_ids[ $current - 1 ] ) ) ? $page_ids[ $current - 1 ] : '';
		else :
			$prev_id = '';
		endif;
		$next_id = ( isset( $page_ids[ $current + 1 ] ) ) ? $page_ids[ $current + 1 ] : '';
else :
	// We dont have a previous as this is a parent
	$prev_id = '';
	$next_id = ( isset( $page_ids[ $current ] ) ) ? $page_ids[ $current ] : '';
endif;
?>
<nav class="hdg-pagination hdg-pagination--pages<?php echo ( empty( $prev_id ) ? ' hdg-pagination--noprev' : '' ); ?><?php echo ( empty( $next_id ) ? ' hdg-pagination--nonext' : '' ); ?>" aria-label="Pagination">
	<ul class="hdg-pagination__list">

	<?php if ( ! empty( $prev_id ) ) : ?>
		<li class="hdg-pagination__item hdg-pagination__item--previous">
		<a href="<?php echo esc_url( get_permalink( $prev_id ) ); ?>" class="hdg-pagination__link" rel="prev">
			<span class="hdg-pagination__link-title">
			<svg class="hdg-pagination__link-icon" xmlns="http://www.w3.org/2000/svg" height="13" width="17" viewBox="0 0 17 13">
			  <path d="m6.5938-0.0078125-6.7266 6.7266 6.7441 6.4062 1.377-1.449-4.1856-3.9768h12.896v-2h-12.984l4.2931-4.293-1.414-1.414z"></path>
			</svg>
			<span class="hdg-pagination__link-text">
			<?php esc_html_e( 'Previous page', 'hdg' ); ?>
			</span>
			</span>
			<span class="visually-hidden">:</span>
			<?php if ( $parent ) : ?>
			<span class="hdg-pagination__link-label">
				<?php echo esc_html( get_the_title( $prev_id ) ); ?>
			</span>
			<?php endif; ?>
		</a>
		</li>
	<?php endif; ?>
   
	<?php if ( ! empty( $next_id ) ) : ?>
		<li class="hdg-pagination__item hdg-pagination__item--next" rel="next">
		<a href="<?php echo esc_url( get_permalink( $next_id ) ); ?>" class="hdg-pagination__link">
			<span class="hdg-pagination__link-title">
			<svg class="hdg-pagination__link-icon" xmlns="http://www.w3.org/2000/svg" height="13" width="17" viewBox="0 0 17 13">
			  <path d="m10.107-0.0078125-1.4136 1.414 4.2926 4.293h-12.986v2h12.896l-4.1855 3.9766 1.377 1.4492 6.7441-6.4062-6.7246-6.7266z"></path>
			</svg>
			<span class="hdg-pagination__link-text">
			<?php esc_html_e( 'Next page', 'hdg' ); ?>
			</span>
			</span>
			 <span class="visually-hidden">:</span>
			 <span class="hdg-pagination__link-label">
				<?php echo esc_html( get_the_title( $next_id ) ); ?>
			 </span>
		</a>
		</li>
	<?php endif; ?>
	</ul>
</nav>
<?php endif; ?>
