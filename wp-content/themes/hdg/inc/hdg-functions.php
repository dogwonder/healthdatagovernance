<?php
/**
 * Custom functions for this theme
 *
 * @package hdg
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
if ( ! function_exists( 'hdg_body_classes' ) ) :
	function hdg_body_classes( $classes ) {
		// Adds a class of hfeed to non-singular pages.

		global $post;

		//Add root namespace class to all pages
		$classes[] = 'hdg';

		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		// Adds a class of no-sidebar when there is no sidebar present.
		if ( ! is_active_sidebar( 'sidebar-1' ) ) {
			$classes[] = 'no-sidebar';
		}

		return $classes;
	}
	add_filter( 'body_class', 'hdg_body_classes' );
endif;

/**
 * WCAG 2.0 Attributes for Dropdown Menus
 *
 * Adjustments to menu attributes tot support WCAG 2.0 recommendations
 * for flyout and dropdown menus.
 *
 * @ref https://www.w3.org/WAI/tutorials/menus/flyout/
 */
if ( ! function_exists( 'wcag_nav_menu_link_attributes' ) ) :
	function wcag_nav_menu_link_attributes( $atts, $item, $args, $depth ) {

		// Add [aria-haspopup] and [aria-expanded] to menu items that have children
		$item_has_children = in_array( 'menu-item-has-children', $item->classes );
		if ( $item_has_children ) {
			$atts['aria-haspopup'] = 'true';
			$atts['aria-expanded'] = 'false';
		}

		return $atts;
	}
	add_filter( 'nav_menu_link_attributes', 'wcag_nav_menu_link_attributes', 10, 4 );
endif;

/*
 * Exclude Uncategorized from get_the_category_list function.
 *
 * @access public
 */
function hdg_the_category_filter( $thelist, $separator = ' ' ) {
	if ( ! defined( 'WP_ADMIN' ) ) {
		$exclude = array( 1 );

		$exclude2 = array();
		foreach ( $exclude as $c ) {
			$exclude2[] = get_cat_name( $c );
		}

		$cats    = explode( $separator, $thelist );
		$newlist = array();
		foreach ( $cats as $cat ) {
			$catname = trim( wp_strip_all_tags( $cat ) );
			if ( ! in_array( $catname, $exclude2 ) ) {
				$newlist[] = $cat;
			}
		}
		return implode( $separator, $newlist );
	} else {
		return $thelist;
	}
}
add_filter( 'the_category', 'hdg_the_category_filter', 10, 2 );

// Callable for usort. Sorts the array based on the 'date' array value - using spaceship operator <=> PHP 7+
if ( ! function_exists( 'hdg_sort_dates' ) ) :
	function hdg_sort_dates( $a, $b ) {

		// order by date (closest first) - php 7
		return new DateTime( $a['start'] ) <=> new DateTime( $b['start'] );

	}
endif;

/**
 * Default setup routine
 *
 * @return void
 */
function setup(): void {
	add_filter( 'render_block_core/heading', __NAMESPACE__ . '\hdg_filter_the_markup', 10, 2 );
}

add_action( 'init', __NAMESPACE__ . '\setup' );


/**
 * Add `id` attribute to h2.
 *
 * @param string $content Block content.
 * @param array  $block   Block data.
 *
 * @return string
 */
function hdg_filter_the_markup( string $content, array $block ) : string {
	$block_level = $block['attrs']['level'] ?? false;
	$block_level = $block_level ? intval( $block_level ) : 2;
	// Only target h2 heading level.
	if ( 2 !== $block_level ) {
		return $content;
	}

	// Parse the HTML.
	$attributes = new WP_HTML_Tag_Processor( $content );

	$id = $attributes->get_attribute( 'id' ) ?? false;
	$id = $id ? strval( $id ) : '';
	// Bail early if we already have an `id` attribute.
	if ( ! empty( $id ) ) {
		return $content;
	}

	// Create a unique ID.
	$inner_html = $block['innerHTML'] ?? false;
	$inner_html = $inner_html ? strval( $inner_html ) : '';
	$inner_html = wp_strip_all_tags( $inner_html );
	$id_hash    = md5( $inner_html );
    $title_sanitize = sanitize_title($inner_html);

	// Add the attributes to the markup.
	if ( $attributes->next_tag( array( 'class' => 'wp-block-heading' ) ) ) {
        // $attributes->set_attribute( 'id', 'h-' . $id_hash );
        $attributes->set_attribute( 'id', 'h-' . $title_sanitize );
		$attributes->add_class( 'cfc-block-heading' );
	}

	return $attributes->get_updated_html();
}