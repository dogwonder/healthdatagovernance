<?php
$base_url = get_pagenum_link(1); 
//If there's only one page, don't continue
if ( $total_pages > 1 ) :
?>
<nav class="hdg-pagination border-top" aria-label="Pagination">
<ul class="hdg-pagination__list">
	<?php
 // If current page is not the first one
 if ($paged !== 1 && $total_pages > 1): ?>
	<li class="hdg-pagination__item hdg-pagination__item--previous">
		<a href="<?php echo $prev_url; ?>" class="hdg-pagination__link" rel="prev">
			<svg aria-hidden="true" focusable="false" class="icon icon-arrow-left"><use xlink:href="#icon-arrow-left" /></svg>
		</a>
	</li>
	<?php endif;
 if ($total_pages > 5):

   $start_page = max(2, $paged - 2);
   $end_page = min($total_pages - 1, $paged + 2);
   ?>
		<li class="hdg-pagination__item">
			<a href="<?php echo get_pagenum_link(
     '1'
   ); ?>" class="hdg-pagination__link">1</a>
		</li>
		<?php
  if ($paged > 3) {
    echo '<span>...</span>';
  }
  for ($i = $start_page; $i <= $end_page; $i++) { ?>
			<li class="hdg-pagination__item<?php echo $paged === $i
     ? ' hdg-pagination__item--active'
     : ''; ?>">
				<a href="<?php echo get_pagenum_link($i); ?>" class="hdg-pagination__link">
					<?php echo $i; ?>
				</a>
			</li>
			<?php }
  if ($paged < $total_pages - 2) {
    echo '<span class="hdg-pagination__seperator">...</span>';
  }
  ?>
		<li class="hdg-pagination__item">
			<a href="<?php echo get_pagenum_link(
     $total_pages
   ); ?>" class="hdg-pagination__link">
				<?php echo $total_pages; ?>
			</a>
		</li>
		<?php
 else:
   for ($i = 1; $i <= $total_pages; $i++): ?>
		<li class="hdg-pagination__item<?php echo $paged == $i
    ? ' hdg-pagination__item--active'
    : ''; ?>">
			<a href="<?php echo get_pagenum_link($i); ?>" class="hdg-pagination__link">
				<?php echo $i; ?>
			</a>
		</li>
		<?php endfor;
 endif;
 // If current page is not the same as the total number of pages
 if ($paged != $total_pages): ?>
	<li class="hdg-pagination__item hdg-pagination__item--next">
		<a href="<?php echo $next_url; ?>" class="hdg-pagination__link" rel="next">
			<svg aria-hidden="true" focusable="false" class="icon icon-arrow-right"><use xlink:href="#icon-arrow-right" /></svg>
		</a>
	</li>
	<?php endif;
 ?>
</ul>
</nav>
<?php endif; ?>