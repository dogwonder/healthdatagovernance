<?php
/**
 * Custom template tags for this theme
 *
 * @package hdg
 */

if ( ! function_exists( 'hdg_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function hdg_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s" itemprop="datePublished">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( '%s', 'post date', 'hdg' ),
			// '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
			$time_string
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'hdg_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function hdg_posted_by() {

		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'By %s', 'post author', 'hdg' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);
		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;


if ( ! function_exists( 'hdg_get_excerpt' ) ) :
	// Get an excerpt outside of a loop
	function hdg_get_excerpt( $post ) {
		$the_excerpt = ( is_numeric( $post ) ) ? get_post_field( 'post_content', $post ) : $post->post_content;
		// Gets post_content to be used as a basis for the excerpt
		$the_excerpt = wp_strip_all_tags( strip_shortcodes( $the_excerpt ) ); // Strips tags and images
		return $the_excerpt;
	}
endif;


if ( ! function_exists( 'hdg_standfirst' ) ) :
	// Standfirst - limited excerpt
	function hdg_standfirst( $limit, $post ) {
		if ( ! empty( $post ) ) {
			$post_id    = ( is_numeric( $post ) ) ? $post : $post->ID;
			$standfirst = explode( ' ', hdg_get_excerpt( $post ), $limit );

			if ( count( $standfirst ) >= $limit ) {
				array_pop( $standfirst );
				$standfirst = implode( ' ', $standfirst ) . '...';
			} else {
				$standfirst = implode( ' ', $standfirst );
			}
			$standfirst = preg_replace( '`\[[^\]]*\]`', '', $standfirst );
		} else {
			$standfirst = '';
		}
		return $standfirst;
	}
endif;

// Remove taxonomy from title
add_filter(
	'get_the_archive_title',
	function ( $title ) {
		if ( is_category() ) {
			$title = single_cat_title( '', false );
		} elseif ( is_tag() ) {
			$title = single_tag_title( '', false );
		} elseif ( is_author() ) {
			$title = '<span class="vcard">' . get_the_author() . '</span>';
		} elseif ( is_tax() ) { // for custom post types
			$title = sprintf( __( '%1$s', 'hdg' ), single_term_title( '', false ) );
		}
		return $title;
	}
);