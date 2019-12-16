<?php

/**
 * Remove Empty Shortcodes
 *
 * Removes empty shortcodes from WordPress standard post types.
 *
 * @package   TomMcFarlin\RESC
 * @author    Tom McFarlin <tom@tommcfarlin.com>
 * @copyright 2019 Tom McFarlin
 * @license   GPL-3.0 <https://www.gnu.org/licenses/gpl-3.0.txt>
 * @link      https://github.com/tommcfarlin/remove-empty-shortcodes/
 *
 * @wordpress-plugin
 * Plugin Name:       Remove Empty Shortcodes
 * Plugin URI:        https://github.com/tommcfarlin/remove-empty-shortcodes/
 * Description:       Removes Restrict Content Pro shortcodes from standard posts.
 * Version:           0.5.0
 * Author:            Tom McFarlin
 * Author URI:        https://tommcfarlin.com
 * License:           GPL-3.0+
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.txt
 */

namespace TomMcFarlin\RESC;

use TomMcFarlin\RESC\Utilities\Registry;
use TomMcFarlin\Utilities\ShortcodeManager;
use TomMcFarlin\Subscriber\PostContentProcessorSubscriber;

// This file called directly.
defined('WPINC') || die;

// Include the Composer autoloader.
require_once __DIR__ . '/vendor/autoload.php';

// Setup a filter so we can retrieve the registry throughout the plugin.
$registry = new Registry();
add_filter('rescRegistry', function () use ($registry) {
    return $registry;
});

// Add Utilities.
$registry->add(
    'shortcodeManager',
    new ShortcodeManager()
);

// Add Subscribers.
$registry->add(
    'postContentProcessorSubscriber',
    new PostContentProcessorSubscriber('the_content')
);

// Start the machine.
(new Plugin($registry))->start();
