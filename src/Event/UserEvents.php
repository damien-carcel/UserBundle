<?php

/*
 * This file is part of CarcelUserBundle.
 *
 * Copyright (c) 2016 Damien Carcel <damien.carcel@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Carcel\Bundle\UserBundle\Event;

/**
 * @author Damien Carcel (damien.carcel@gmail.com)
 */
class UserEvents
{
    /**
     * This event is dispatched just before a user is updated.
     *
     * The event listener receives a
     * Symfony\Component\EventDispatcher\GenericEvent instance.
     *
     * @const string
     */
    const PRE_UPDATE = 'carcel_user.event.pre_update';

    /**
     * This event is dispatched just after a user is updated.
     *
     * The event listener receives a
     * Symfony\Component\EventDispatcher\GenericEvent instance.
     *
     * @const string
     */
    const POST_UPDATE = 'carcel_user.event.post_update';

    /**
     * This event is dispatched just before a user is removed.
     *
     * The event listener receives a
     * Symfony\Component\EventDispatcher\GenericEvent instance.
     *
     * @const string
     */
    const PRE_REMOVE = 'carcel_user.event.pre_remove';

    /**
     * This event is dispatched just after a user is removed.
     *
     * The event listener receives a
     * Symfony\Component\EventDispatcher\GenericEvent instance.
     *
     * @const string
     */
    const POST_REMOVE = 'carcel_user.event.post_remove';

    /**
     * This event is dispatched just before the role of a user is changed.
     *
     * The event listener receives a
     * Symfony\Component\EventDispatcher\GenericEvent instance.
     *
     * @const string
     */
    const PRE_SET_ROLE = 'carcel_user.event.pre_set_role';

    /**
     * This event is dispatched just after the role of a user is changed.
     *
     * The event listener receives a
     * Symfony\Component\EventDispatcher\GenericEvent instance.
     *
     * @const string
     */
    const POST_SET_ROLE = 'carcel_user.event.post_set_role';
}
