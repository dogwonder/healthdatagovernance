<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://wp.dgw.ltd
 * @since      1.0.0
 *
 * @package    HDG_Site
 * @subpackage HDG_Site/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    HDG_Site
 * @subpackage HDG_Site/public
 * @author     Rich Holman <dogwonder@gmail.com>
 */
class HDG_Site_Public {

	/**
	 * The ID of this plugin.
	 *

	 * @access   private
	 * @var      string    $HDG_Site    The ID of this plugin.
	 */
	private $HDG_Site;


	/**
	 * The version of this plugin.
	 *

	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *

	 * @param      string $HDG_Site       The name of the plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $hdg_site, $version ) {

		$this->hdg_site = $hdg_site;
		$this->version       = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 */
	public function hdg_enqueue_theme_styles() {

		wp_enqueue_style( $this->hdg_site, plugin_dir_url( __FILE__ ) . 'css/hdg-site-theme.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 */

	public function hdg_enqueue_theme_scripts()
    {
        $asset_file = include plugin_dir_path(__DIR__) .
            "dist/hdg-site-theme.asset.php";
        wp_enqueue_script(
            $this->hdg_site,
            HDG_SITE_PLUGIN_URL . "dist/hdg-site-theme.js",
            $asset_file["dependencies"],
            $asset_file["version"],
            true
        );
    }

	/**
	 * Add type=module to script tags
	 *
	 */
	public function hdg_add_type_attribute($tag, $handle, $src) {
		// if not your script, do nothing and return original $tag
		if ( 'hdg-site' !== $handle ) {
			return $tag;
		}
		// change the script tag by adding type="module" and return it.
		$tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';
		return $tag;
	}


	/**
	 * Get the embedded video host, YouTube or Vimeo
	 *
	 */
	public static function hdg_parse_video_uri( $url ) {

		// Parse the url
		$parse = parse_url( $url );

		// Set blank variables
		$video_type = '';
		$video_id   = '';

		// Url is http://youtu.be/xxxx
		if ( isset( $parse['host'] ) && $parse['host'] == 'youtu.be' ) {

			$video_type = 'youtube';
			$video_id   = ltrim( $parse['path'], '/' );

		}

		// Url is http://www.youtube.com/watch?v=xxxx
		// or http://www.youtube.com/watch?feature=player_embedded&v=xxx
		// or http://www.youtube.com/embed/xxxx
		if ( isset( $parse['host'] ) && ( $parse['host'] == 'youtube.com' ) || isset( $parse['host'] ) && ( $parse['host'] == 'www.youtube.com' ) ) {

			$video_type = 'youtube';

			parse_str( $parse['query'], $output );

			// print_r($output);

			$video_id = $output['v'];

			if ( ! empty( $feature ) ) {
				$video_id = end( explode( 'v=', $parse['query'] ) );
			}

			if ( strpos( $parse['path'], 'embed' ) == 1 ) {
				$video_id = end( explode( '/', $parse['path'] ) );
			}
		}

		// Url is http://www.vimeo.com
		if ( isset( $parse['host'] ) && ( $parse['host'] == 'vimeo.com' ) || isset( $parse['host'] ) && ( $parse['host'] == 'www.vimeo.com' ) ) {

			$video_type = 'vimeo';

			$video_id = ltrim( $parse['path'], '/' );

		}

		// If recognised type return video array
		if ( ! empty( $video_type ) ) {

			$video_array = array(
				'type' => $video_type,
				'id'   => $video_id,
			);

			return $video_array;

		} else {

			return false;

		}
	}

	/**
	 * Get an ACF block's color settings.
	 *
	 * @param array $block The block settings and attributes.
	 */
	public static function hdg_get_block_attrs( $block = null ) {

		if ( ! $block ) {
			return;
		}

		$block_class = null;
		$block_style = null;
		$block_align = null;
		$block_align_text = null;

		$blockOptStyle = $block['style'] ?? null;
		$blockOptBackgroundColor = $block['backgroundColor'] ?? null;
		$blockOptTextColor = $block['textColor'] ?? null;
		$blockOptAlign = $block['align'] ?? null;
		$blockOptAlignText = $block['alignText'] ?? null;
		$blockOptStyleColorBackground = $block['style']['color']['background'] ?? null;
		$blockOptStyleColorText = $block['style']['color']['text'] ?? null;

		if ( $blockOptBackgroundColor ) {
			$block_class .= ' has-background has-' . $block['backgroundColor'] . '-background-color ';
		}

		if ( $blockOptTextColor ) {
			$block_class .= ' has-text-color has-' . $block['textColor'] . '-color ';
		}

		if ( $blockOptAlign ) {
			$block_class .= ' align' . $block['align'];
		}

		if ( $blockOptAlignText ) {
			$block_class .= ' has-text-align-' . $block['alignText'];
		}

		if ( is_array($blockOptStyle) && $blockOptStyleColorBackground ) {
			$block_class .= ' has-background ';
			$block_style .= 'background-color: ' . $block['style']['color']['background'] . ';';
		}

		if ( is_array($blockOptStyle) && $blockOptStyleColorText ) {
			$block_class .= ' has-text-color ';
			$block_style .= 'color: ' . $block['style']['color']['text'] . ';';
		}

		return array(
			'class' => $block_class,
			'style' => $block_style,
		);

	}

	/*
	 * Convert a HEX color to RGB using PHP.
	 *
	 */
	public static function hdg_hex2rgb( $hex ) {

		$hex = str_replace( '#', '', $hex );

		if ( strlen( $hex ) == 3 ) {
			$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
			$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
			$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
		} else {
			$r = hexdec( substr( $hex, 0, 2 ) );
			$g = hexdec( substr( $hex, 2, 2 ) );
			$b = hexdec( substr( $hex, 4, 2 ) );
		}

		$rgb = array( $r, $g, $b );

		return $rgb; // returns an array with the rgb values
	}

	/*
	 * Setup the card type mappings.
	 *
	 */
	public static function hdg_get_card_type_mappings() {
		//Card type
		$cardTypeMappings = [
			'default' => [
				'has_image' => true, 
				'has_kicker' => true,
				'has_description' => true,
				'grid_classes' => "",
				'heading_level' => "h2",
				'thumbnail_size' => "hdg-medium-card"
			],
			'news-summary-card' => [ 
				'has_kicker' => false, 
				'has_category' => true, 
				'has_description' => true,
				'has_date' => true
			]
		];
		return $cardTypeMappings;
	}

}
