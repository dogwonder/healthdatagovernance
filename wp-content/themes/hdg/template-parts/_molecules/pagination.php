<?php
// Get pagination
global $wp_query;
$paged       = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$prev_url    = get_previous_posts_page_link();
$next_url    = get_next_posts_page_link();
$total_pages = $wp_query->max_num_pages;
?>
<nav class="sigur-pagination" aria-label="Pagination">
<ul class="sigur-pagination__list">
<?php
	// If current page is not the first one
	if ( $paged !== 1 && $total_pages > 1 ) : ?>
	<li class="sigur-pagination__item sigur-pagination__item--previous">
		<a href="<?php echo $prev_url; ?>" class="sigur-pagination__link" rel="prev">
			<span class="sigur-pagination__link-title">
			<svg class="sigur-pagination__link-icon" xmlns="http://www.w3.org/2000/svg" height="13" width="17" viewBox="0 0 17 13">
			  <path d="m6.5938-0.0078125-6.7266 6.7266 6.7441 6.4062 1.377-1.449-4.1856-3.9768h12.896v-2h-12.984l4.2931-4.293-1.414-1.414z"></path>
			</svg>
			<span class="sigur-pagination__link-text">
			<?php esc_html_e( 'Previous page', 'sigur' ); ?>
			</span>
			</span>
			<span class="visually-hidden">:</span>
			<span class="sigur-pagination__link-label"><?php echo $paged - 1; ?> of <?php echo $total_pages; ?></span>
		</a>
	</li>
	<?php endif; ?>
	<?php
	// If current page is not the same as the total number of pages
	if ( $paged !== $total_pages && $total_pages > 1 ) :
		?>
	<li class="sigur-pagination__item sigur-pagination__item--next">
		<a href="<?php echo $next_url; ?>" class="sigur-pagination__link" rel="next">
			<span class="sigur-pagination__link-title">
			<svg class="sigur-pagination__link-icon" xmlns="http://www.w3.org/2000/svg" height="13" width="17" viewBox="0 0 17 13">
			  <path d="m10.107-0.0078125-1.4136 1.414 4.2926 4.293h-12.986v2h12.896l-4.1855 3.9766 1.377 1.4492 6.7441-6.4062-6.7246-6.7266z"></path>
			</svg>
			<span class="sigur-pagination__link-text">
			<?php esc_html_e( 'Next page', 'sigur' ); ?>
			</span>
			</span>
			<span class="visually-hidden">:</span>
			<span class="sigur-pagination__link-label"><?php echo $paged + 1; ?> of <?php echo $total_pages; ?></span>
		</a>
	</li>
	<?php endif; ?>
</ul>
</nav>
