<?php

/*
 * This file is part of Destrict Content.
 *
 * (c) Tom McFarlin <tom@tommcfarlin.com>
 *
 * This source file is subject to the GPL license that is bundled
 * with this source code in the file LICENSE.
 */

namespace DestrictContent\WordPress;

/**
 * Processes the post content by looking to see if the Restrict Content Pro shortcode
 * exists and then removes it from displaying it from the user.
 */
class PostContentProcessor
{
    /**
     * @param string $content the filtered post content
     *
     * @return string $content the filtered post content without the shortcode
     */
    public function run($content)
    {
        if (!$this->hasRestrictContentProShortcode()) {
            return $content;
        }

        add_shortcode('restrict', '__return_false');

        return $content;
    }

    /**
     * Determines if there is a Restrict Content Pro shortcode in the content.
     *
     * @return bool true if a shortcode is found, false; otherwise
     */
    private function hasRestrictContentProShortcode(): bool
    {
        global $post;

        // Look for all of the shortocdes in the post content.
        preg_match_all('/\[(.*?)\]/', $post->post_content, $matches);
        $matches = $matches[0];

        // If 'restrict' is not found in the matches array, then return false immediately.
        foreach ($matches as $match) {
            if (false === strpos($match, 'restrict')) {
                return false;
            }
        }

        return true;
    }
}
