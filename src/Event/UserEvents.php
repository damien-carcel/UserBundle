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
     * @Event("Symfony\Component\EventDispatcher\GenericEvent"
     */
    const PRE_UPDATE = 'carcel_user.event.pre_update';

    /**
     * This event is dispatched just after a user is updated.
     *
     * @Event("Symfony\Component\EventDispatcher\GenericEvent"
     */
    const POST_UPDATE = 'carcel_user.event.post_update';

    /**
     * This event is dispatched just before a user is removed.
     *
     * @Event("Symfony\Component\EventDispatcher\GenericEvent"
     */
    const PRE_REMOVE = 'carcel_user.event.pre_remove';

    /**
     * This event is dispatched just after a user is removed.
     *
     * @Event("Symfony\Component\EventDispatcher\GenericEvent"
     */
    const POST_REMOVE = 'carcel_user.event.post_remove';

    /**
     * This event is dispatched just before the role of a user is changed.
     *
     * @Event("Symfony\Component\EventDispatcher\GenericEvent"
     */
    const PRE_SET_ROLE = 'carcel_user.event.pre_set_role';

    /**
     * This event is dispatched just after the role of a user is changed.
     *
     * @Event("Symfony\Component\EventDispatcher\GenericEvent"
     */
    const POST_SET_ROLE = 'carcel_user.event.post_set_role';

    /**
     * This event is dispatched just after a user is activated.
     *
     * @Event("Symfony\Component\EventDispatcher\GenericEvent"
     */
    const PRE_ACTIVATE = 'carcel_user.event.pre_activate';

    /**
     * This event is dispatched just after a user is activated.
     *
     * @Event("Symfony\Component\EventDispatcher\GenericEvent"
     */
    const POST_ACTIVATE = 'carcel_user.event.post_activate';

    /**
     * This event is dispatched just after a user is deactivated.
     *
     * @Event("Symfony\Component\EventDispatcher\GenericEvent"
     */
    const PRE_DEACTIVATE = 'carcel_user.event.pre_deactivate';

    /**
     * This event is dispatched just after a user is deactivated.
     *
     * @Event("Symfony\Component\EventDispatcher\GenericEvent"
     */
    const POST_DEACTIVATE = 'carcel_user.event.post_deactivate';
}
