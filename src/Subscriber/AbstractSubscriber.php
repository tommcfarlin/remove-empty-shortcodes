<?php

/*
 * This file is part of Remove Empty Shortcodes.
 *
 * (c) Tom McFarlin <tom@tommcfarlin.com>
 *
 * This source file is subject to the GPL license that is bundled
 * with this source code in the file LICENSE.
 */

namespace RESC\Subscriber;

use RESC\Utilities\Registry;

/**
 * An abstract implementation of a subscriber that requires a hook and the ability to
 * start the class.
 */
abstract class AbstractSubscriber
{
    /**
     * @var string a reference to the hook to which the subscriber should be registered
     */
    protected $hook;

    /**
     * @var Registry a reference to the simple container used to maintain plugin objects
     */
    protected $registry;

    /**
     * @param string $hook the hook to which the subscriber is registered
     */
    public function __construct(string $hook)
    {
        $this->hook = $hook;
        $this->registry = apply_filters('rescRegistry', null);
    }

    /**
     * @return string the hook to which the subscriber is registered
     */
    public function getHook(): string
    {
        return $this->hook;
    }

    abstract public function load();
}
