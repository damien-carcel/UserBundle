<?php

namespace Carcel\Bundle\UserBundle\Handler;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;

/**
 * Redirect user after logout to the last page he was.
 *
 * @author    Damien Carcel (damien.carcel@gmail.com)
 * @copyright 2016 Damien Carcel (https://github.com/damien-carcel)
 * @license   https://opensource.org/licenses/mit   The MIT license (MIT)
 */
class LogoutSuccessHandler implements LogoutSuccessHandlerInterface
{
    /**
     * {@inheritdoc}
     */
    public function onLogoutSuccess(Request $request)
    {
        $url = $request->headers->get('referer');

        if (null !== $url) {
            return new RedirectResponse($url);
        }

        return new RedirectResponse('/');
    }
}
