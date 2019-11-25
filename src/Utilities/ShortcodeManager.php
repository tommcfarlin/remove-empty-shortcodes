<?php

/*
 * This file is part of Destrict Content.
 *
 * (c) Tom McFarlin <tom@tommcfarlin.com>
 *
 * This source file is subject to the GPL license that is bundled
 * with this source code in the file LICENSE.
 */

namespace DestrictContent\Utilities;

/**
 * Processes incoming content looking for incoming shortcodes to make sure that
 * we are removing only orphaned shortcodes.
 */
class ShortcodeManager
{
    /**
     * A referemce to the global active shortcode tags.
     */
    private $shortcodeTags;

    /**
     * An array of active shortcodes.
     */
    private $activeShortcodes;

    public function __construct()
    {
        global $shortcode_tags;

        $this->shortcodeTags = $shortcode_tags;
        $this->activeShortcodes = [];
    }

    /**
     * Looks for shortcodes in the incoming content.
     *
     * @param string $content the content to process
     *
     * @return string the content without it's active shortcodes
     */
    public function processShortcodes(string $content)
    {
        return ($this->hasActiveShortcodes()) ?
            $this->removeShortcodes($content) :
            $this->keepActiveShortcodes($content);
    }

    /**
     * Removes shortcodes that are no longer used in the content.
     *
     * @param string $content the content to process
     *
     * @return string the content without it's active shortcodes
     */
    private function removeShortcodes(string $content)
    {
        return preg_replace("#(?:\[/?)[^/\]]+/?\]#s", '', $content);
    }

    /**
     * Determines if there are active shortcodes.
     *
     * @return bool true if there are active shortcodes; otherwise, false
     */
    private function hasActiveShortcodes(): bool
    {
        $this->activeShortcodes =
            (\is_array($this->shortcodeTags) && !empty($this->shortcodeTags)) ?
                array_keys($this->shortcodeTags) :
                [];

        return !empty($this->activeShortcodes);
    }

    /**
     * Keeps active shortcodes in the content.
     *
     * @param string $content The content from which to
     *
     * @return string the content without its inactive shortcodes
     */
    private function keepActiveShortcodes(string $content)
    {
        $keepAactive = implode('|', $this->activeShortcodes);

        return preg_replace("#(?:\[/?)(?!(?:$keepAactive))[^/\]]+/?\]#s", '', $content);
    }
}
