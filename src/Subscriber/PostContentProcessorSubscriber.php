<?php

/*
 * This file is part of Remove Empty Shortcodes.
 *
 * (c) Tom McFarlin <tom@tommcfarlin.com>
 *
 * This source file is subject to the GPL license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TomMcFarlin\RESC\Subscriber;

use TomMcFarlin\RESC\WordPress\PostContentProcessor;

/**
 * Initialises.
 */
class PostContentProcessorSubscriber extends AbstractSubscriber
{
    /**
     * @param string $hook the hook to which this class is registered with WordPress
     */
    public function __construct(string $hook)
    {
        parent::__construct($hook);
    }

    /**
     * Initializes and loads the object responsible for filtering empty shortcodes.
     *
     * @return mixed either nothing or the processed content without the shortcode
     */
    public function load()
    {
        // TODO: This should always be set but I'd like more time to set breakpoints.
        if (!isset(\func_get_args()[0])) {
            return;
        }

        $content = \func_get_args()[0];
        if (is_admin()) {
            return $content;
        }

        if ('post' !== get_post_type() && 'page' !== get_post_type()) {
            return $content;
        }

        return (new PostContentProcessor())->run($content);
    }
}
