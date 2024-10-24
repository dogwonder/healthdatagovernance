<?php 
$contentsList = HDG_Site_Public::hdg_list_post_headings( false );

if ($contentsList) {
    echo '<nav class="hdg-contents-list" aria-label="Sections in this page" role="navigation" id="navbar-contents-list" x-data="scrollSpy()">';
    echo '<h2 class="hdg-contents-list__title visually-hidden">' . __('Page contents', 'cfc') . '</h2>';
    echo '<ol class="hdg-contents-list__list">';
    echo $contentsList;
    echo '</ol>';
    echo '</nav>';
}
?>