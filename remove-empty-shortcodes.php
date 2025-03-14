<?php
/**
 * Remove Empty Shortcodes
 *
 * Removes empty shortcodes from WordPress standard post types.
 *
 * @package   TomMcFarlin\RESC
 * @author    Tom McFarlin <tom@tommcfarlin.com>
 * @copyright 2019 - 2025 Tom McFarlin
 * @license   GPL-3.0 <https://www.gnu.org/licenses/gpl-3.0.txt>
 * @link      https://github.com/tommcfarlin/remove-empty-shortcodes/
 *
 * @wordpress-plugin
 * Plugin Name:       Remove Empty Shortcodes
 * Plugin URI:        https://github.com/tommcfarlin/remove-empty-shortcodes/
 * Description:       Removes empty shortcodes from WordPress standard posts and pages.
 * Version:           0.6.0
 * Author:            Tom McFarlin
 * Author URI:        https://tommcfarlin.com
 * License:           GPL-3.0+
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.txt
 */

namespace TomMcFarlin\RESC;

// This file called directly.
defined( 'WPINC' ) || die;

// Define plugin constants.
const VERSION              = '0.6.0';
const SUPPORTED_POST_TYPES = array( 'post', 'page' );
const SHORTCODE_PATTERN    = '/\[(\[?)([^\s\]]+)(?![\w-])([^\]\/]*(?:\/(?!\])[^\]\/]*)*?)(?:(\/)\]|\](?:([^\[]*+(?:\[(?!\/\2\])[^\[]*+)*+)\[\/\2\])?)(\]?)/s';

/**
 * Initializes the plugin by adding the content filter.
 *
 * @since 0.6.0
 */
function init() {
	add_filter( 'the_content', __NAMESPACE__ . '\process_shortcodes' );
}
add_action( 'init', __NAMESPACE__ . '\init' );

/**
 * Determines if the current post type should be processed.
 *
 * @return bool True if the post type should be processed, false otherwise.
 */
function should_process_content() {
	return is_singular( SUPPORTED_POST_TYPES );
}

/**
 * Finds all shortcodes in the content.
 *
 * @param string $content The content to search.
 * @return array The shortcodes found in the content.
 */
function find_shortcodes( $content ) {
	if ( ! preg_match_all( SHORTCODE_PATTERN, $content, $matches, PREG_SET_ORDER ) ) {
		return array();
	}

	return $matches;
}

/**
 * Removes empty shortcodes from content.
 *
 * @param string $content The content to process.
 * @param array  $shortcodes The shortcodes to remove.
 * @return string The content with empty shortcodes removed.
 */
function remove_empty_shortcodes( $content, $shortcodes ) {
	foreach ( $shortcodes as $match ) {
		$original_shortcode = $match[0];
		$shortcode_name     = $match[2];

		if ( ! shortcode_exists( $shortcode_name ) ) {
			$content = str_replace( $original_shortcode, '', $content );
			continue;
		}

		if ( is_empty_shortcode( $original_shortcode ) ) {
			$content = str_replace( $original_shortcode, '', $content );
		}
	}

	return $content;
}

/**
 * Checks if a shortcode is empty.
 *
 * @param string $shortcode The shortcode to check.
 * @return bool True if the shortcode is empty, false otherwise.
 */
function is_empty_shortcode( $shortcode ) {
	$processed = do_shortcode( $shortcode );
	return empty( trim( $processed ) ) || $processed === $shortcode;
}

/**
 * Cleans up content formatting.
 *
 * @param string $content The content to clean up.
 * @return string The cleaned up content.
 */
function cleanup_content( $content ) {
	$content = preg_replace( "/[\r\n]{2,}/", "\n\n", $content );
	return trim( $content );
}

/**
 * Processes the content to remove empty shortcodes.
 *
 * @param string $content The post content to process.
 * @return string The processed content with empty shortcodes removed.
 */
function process_shortcodes( $content ) {
	// Only process supported post types.
	if ( ! should_process_content() ) {
		return $content;
	}

	$shortcodes = find_shortcodes( $content );
	if ( empty( $shortcodes ) ) {
		return $content;
	}

	$content = remove_empty_shortcodes( $content, $shortcodes );
	return cleanup_content( $content );
}
