<?php

/*
 * This file is part of Remove Empty Shortcodes.
 *
 * (c) Tom McFarlin <tom@tommcfarlin.com>
 *
 * This source file is subject to the GPL license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TomMcFarlin\RESC\WordPress;

/**
 * Processes the post content by looking to see if any orphaned shortcode
 * exists and then removes it from displaying it from the user.
 */
class PostContentProcessor
{
    /**
     * A reference to the Shortcode Manager for processing orphaned shortcodes.
     */
    private $shortcodeManager;

    /**
     * Initializes the class by setting up a reference to the Registry and the
     * Shortcode Manager.
     */
    public function __construct()
    {
        $registry = apply_filters('rescRegistry', null);
        $this->shortcodeManager = $registry->get('shortcodeManager');
    }

    /**
     * @param string $content the filtered post content
     *
     * @return string $content the filtered post content without the shortcode
     */
    public function run(string $content): string
    {
        return $this->shortcodeManager->processShortcodes($content);
    }
}
