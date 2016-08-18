<?php

/*
 * This file is part of CarcelUserBundle.
 *
 * Copyright (c) 2016 Damien Carcel <damien.carcel@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Carcel\Bundle\UserBundle\Controller;

use Carcel\Bundle\UserBundle\Entity\Repository\UserRepositoryInterface;
use Carcel\Bundle\UserBundle\Form\Factory\UserFormFactoryInterface;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Global administration of the application users.
 *
 * @author Damien Carcel (damien.carcel@gmail.com)
 */
class AdminController extends Controller
{
    /**
     * Renders the list of administrated users.
     *
     * @return Response
     */
    public function indexAction()
    {
        $users = $this->get('carcel_user.manager.users')->getAdministrableUsers();
        $deleteForms = $this->getUserFormFactory()->createDeleteFormViews($users, 'carcel_user_admin_remove');

        return $this->render(
            'CarcelUserBundle:Admin:index.html.twig',
            [
                'users'        => $users,
                'delete_forms' => $deleteForms,
            ]
        );
    }

    /**
     * Shows a user profile.
     *
     * @param string $username
     *
     * @return Response
     */
    public function showProfileAction($username)
    {
        $user = $this->findUserByUsernameOr404($username);

        return $this->render(
            'CarcelUserBundle:Admin:show.html.twig',
            ['user' => $user]
        );
    }

    /**
     * Changes the user's role.
     *
     * @param Request $request
     * @param string  $username
     *
     * @return RedirectResponse|Response
     */
    public function setRoleAction(Request $request, $username)
    {
        $rolesManager = $this->get('carcel_user.manager.roles');
        $user = $this->findUserByUsernameOr404($username);
        $userRole = $rolesManager->getUserRole($user);
        $choices = $rolesManager->getChoices();
        $form = $this->getUserFormFactory()->createSetRoleForm($choices, $userRole);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $selectedRole = $form->getData();
            $user->setRoles([$choices[$selectedRole['roles']]]);

            $this->get('doctrine.orm.entity_manager')->flush();

            $this->addFlash(
                'notice',
                $this->get('translator')->trans('carcel_user.notice.set_role')
            );

            return $this->redirect($this->generateUrl('carcel_user_admin_index'));
        }

        return $this->render(
            'CarcelUserBundle:Admin:set_role.html.twig',
            [
                'form'     => $form->createView(),
                'username' => $user->getUsername(),
            ]
        );
    }

    /**
     * Displays a form to edit a user profile.
     *
     * @param string $username
     *
     * @return RedirectResponse|Response
     */
    public function editProfileAction($username)
    {
        $user = $this->findUserByUsernameOr404($username);
        $form = $this->getUserFormFactory()->createEditForm(
            $user,
            'Carcel\Bundle\UserBundle\Form\Type\UserType',
            'carcel_user_admin_update'
        );

        return $this->render(
            'CarcelUserBundle:Admin:edit.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * Updates a user's profile.
     *
     * @param Request $request
     * @param string  $username
     *
     * @return RedirectResponse|Response
     */
    public function updateProfileAction(Request $request, $username)
    {
        $user = $this->findUserByUsernameOr404($username);
        $form = $this->getUserFormFactory()->createEditForm(
            $user,
            'Carcel\Bundle\UserBundle\Form\Type\UserType',
            'carcel_user_admin_update'
        );

        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->get('doctrine.orm.entity_manager')->flush();

            $this->addFlash(
                'notice',
                $this->get('translator')->trans('carcel_user.notice.update')
            );

            return $this->redirect($this->generateUrl('carcel_user_admin_index'));
        }

        return $this->render(
            'CarcelUserBundle:Admin:edit.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * Removes a user account and send a message to warn the user that
     * his account has been destroyed.
     *
     * @param Request $request
     * @param string  $username
     *
     * @return RedirectResponse|Response
     */
    public function removeUserAction(Request $request, $username)
    {
        $form = $this->getUserFormFactory()->createDeleteForm($username, 'carcel_user_admin_remove');
        $form->handleRequest($request);

        if ($form->isValid()) {
            $user = $this->findUserByUsernameOr404($username);
            $email = $user->getEmail();

            $this->get('doctrine.orm.entity_manager')->remove($user);
            $this->get('doctrine.orm.entity_manager')->flush();

            $this->addFlash(
                'notice',
                $this->get('translator')->trans('carcel_user.notice.delete.label')
            );

            $this->get('carcel_user.manager.mail')->send($email, $username);
        }

        return $this->redirect($this->generateUrl('carcel_user_admin_index'));
    }

    /**
     * Finds and returns a User from its username.
     *
     * @param string $username
     *
     * @throws NotFoundHttpException
     *
     * @return UserInterface
     */
    protected function findUserByUsernameOr404($username)
    {
        $user = $this->getUserRepository()->findOneBy(['username' => $username]);

        if (null === $user) {
            throw new  NotFoundHttpException(
                'The user with the name %username% does not exists',
                ['%username%' => $username]
            );
        }

        return $user;
    }

    /**
     * @return UserRepositoryInterface
     */
    protected function getUserRepository()
    {
        return $this->get('doctrine.orm.entity_manager')->getRepository('CarcelUserBundle:User');
    }

    /**
     * @return UserFormFactoryInterface
     */
    protected function getUserFormFactory()
    {
        return $this->get('carcel_user.factory.user_form');
    }
}
