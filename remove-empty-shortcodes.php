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
 * Description:       Removes Restrict Content Pro shortcodes from standard posts.
 * Version:           0.6.0
 * Author:            Tom McFarlin
 * Author URI:        https://tommcfarlin.com
 * License:           GPL-3.0+
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.txt
 */

namespace TomMcFarlin\RESC;

// This file called directly.
defined( 'WPINC' ) || die;

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
 * Processes the content to remove empty shortcodes.
 *
 * @param string $content The post content to process.
 * @return string The processed content with empty shortcodes removed.
 */
function process_shortcodes( $content ) {

	// Only process posts and pages.
	if ( ! is_singular( array( 'post', 'page' ) ) ) {
		return $content;
	}

	// Custom regex pattern to match any shortcode.
	$pattern = '/\[(\[?)([^\s\]]+)(?![\w-])([^\]\/]*(?:\/(?!\])[^\]\/]*)*?)(?:(\/)\]|\](?:([^\[]*+(?:\[(?!\/\2\])[^\[]*+)*+)\[\/\2\])?)(\]?)/s';

	// Find all shortcodes in the content.
	if ( ! preg_match_all( $pattern, $content, $matches, PREG_SET_ORDER ) ) {
		return $content;
	}

	foreach ( $matches as $match ) {
		$original_shortcode = $match[0];
		$shortcode_name     = $match[2];
		$shortcode_content  = isset( $match[5] ) ? $match[5] : '';

		// Check if the shortcode is registered.
		if ( ! shortcode_exists( $shortcode_name ) ) {
			$content = str_replace( $original_shortcode, '', $content );
			continue;
		}

		// Process the shortcode.
		$processed = do_shortcode( $original_shortcode );

		// If processed content is empty or equals the original, remove it.
		if ( empty( trim( $processed ) ) || $processed === $original_shortcode ) {
			$content = str_replace( $original_shortcode, '', $content );
		}
	}

	// Clean up multiple empty lines.
	$content = preg_replace( "/[\r\n]{2,}/", "\n\n", $content );

	return trim( $content );
}
