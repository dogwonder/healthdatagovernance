<?php
/**
 * Custom functions for this theme
 *
 * @package sigur
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
if ( ! function_exists( 'sigur_body_classes' ) ) :
	function sigur_body_classes( $classes ) {
		// Adds a class of hfeed to non-singular pages.

		global $post;

		//Add root namespace class to all pages
		$classes[] = 'sigur';

		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		// Adds a class of no-sidebar when there is no sidebar present.
		if ( ! is_active_sidebar( 'sidebar-1' ) ) {
			$classes[] = 'no-sidebar';
		}

		//Accent color
		$accent_colour  = get_field( 'accent_colour' ) ? : '';

		$settings = WP_Theme_JSON_Resolver::get_theme_data()->get_settings();	
		if ( isset( $settings['color']['palette']['theme'] ) ) {
			$color_palette = $settings['color']['palette']['theme'];
		}
		// Initialize the class variable
		$accent_color = '';

		// Normalize the accent colour to lowercase to ensure case-insensitive comparison
		$normalized_accent = strtolower($accent_colour);

		// Flag to check if a match is found
		$match_found = false;

		// Iterate through the colors array to find a matching color
		foreach ($color_palette as $color) {
			// Normalize the color from the array
			$normalized_color = strtolower($color['color']);
			
			if ($normalized_color === $normalized_accent) {
				// Match found
				$accent_color = 'has-background has-' . htmlspecialchars($color['slug'] . '-background-color');
				$match_found = true;
				break; // Exit the loop as we found a match
			}
		}

		// If no match is found, fall back to the hex color without the '#'
		if (!$match_found) {
			// Remove the '#' from the accent colour
			$stripped_hex = ltrim($accent_colour, '#');
			
			// Optionally, validate that the stripped hex is a valid hex code (6 characters, hexadecimal)
			if (preg_match('/^[A-Fa-f0-9]{6}$/', $stripped_hex)) {
				$accent_color = 'has-background has-' . htmlspecialchars($stripped_hex) . '-background-color';
			} else {
				// Handle invalid hex format
				$accent_color = 'no-background'; // You can choose to set a default or handle it differently
			}
		}

		$classes[] = $accent_color;



		return $classes;
	}
	add_filter( 'body_class', 'sigur_body_classes' );
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
function sigur_the_category_filter( $thelist, $separator = ' ' ) {
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
add_filter( 'the_category', 'sigur_the_category_filter', 10, 2 );

// Callable for usort. Sorts the array based on the 'date' array value - using spaceship operator <=> PHP 7+
if ( ! function_exists( 'sigur_sort_dates' ) ) :
	function sigur_sort_dates( $a, $b ) {

		// order by date (closest first) - php 7
		return new DateTime( $a['start'] ) <=> new DateTime( $b['start'] );

	}
endif;