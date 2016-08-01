# CarcelUserBundle

CarcelUserBundle is a ready to use user management system for Symfony 3 applications, using Doctrine ORM for database storage.

It provides all the element you need out of the box, yet let you the possibility to customize it at your liking.

This bundle is build upon the [FOSUserBundle](https://github.com/FriendsOfSymfony/FOSUserBundle).

# Installation and configuration

## Download using composer and activate the bundle

Require the bundle

```bash
composer require friendsofsymfony/user-bundle "~2.0@dev"
composer require carcel/user-bundle "dev-master"
```

Then enable it and the FOSUserBundle in the application kernel

```php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = [
        ...
        new FOS\UserBundle\FOSUserBundle(),
        new Carcel\Bundle\UserBundle\CarcelUserBundle(),
    ];
}
```

## Configure the application security

Edit your `app/config/security.yml` as follow:

```yaml
security:
    encoders:
        FOS\UserBundle\Model\UserInterface: bcrypt

    role_hierarchy:
        ROLE_ADMIN:       ROLE_USER
        ROLE_SUPER_ADMIN: ROLE_ADMIN

    providers:
        fos_userbundle:
            id: fos_user.user_provider.username

    firewalls:
        dev:
            pattern: ^/(_(profiler|wdt)|css|images|js)/
            security: false
        main:
            pattern: ^/
            form_login:
                provider: fos_userbundle
                csrf_token_generator: security.csrf.token_manager
                use_referer: true
                use_forward: true
            logout:
                path: fos_user_security_logout
                target: /
                success_handler: carcel_user.handler.logout_success_handler
            anonymous: true
            remember_me:
                secret: '%secret%'

    access_control:
        - { path: ^/login$, role: IS_AUTHENTICATED_ANONYMOUSLY }
        - { path: ^/register, role: IS_AUTHENTICATED_ANONYMOUSLY }
        - { path: ^/resetting, role: IS_AUTHENTICATED_ANONYMOUSLY }
        - { path: ^/admin/, role: ROLE_ADMIN }
```

Please refer to the [corresponding documentation](https://symfony.com/doc/master/bundles/FOSUserBundle/index.html#step-4-configure-your-application-s-security-yml) for more informations.

## Configure the bundle

Enable the translator:

```yaml
# app/config/config.yml

parameters:
    locale: en

framework:
    translator: { fallbacks: ["%locale%"] }
```

Then add the following lines to the application configuration:

```yaml
# app/config/config.yml

fos_user:
    db_driver: orm
    firewall_name: main # This must be the firewall you define in the previous step, whatever the name you gave it
    user_class: Carcel\Bundle\UserBundle\Entity\User
```

Then add the following parameters (don't forget to add it to your `app/config/parameters.yml.dist` file too):

```yaml
#app/config/parameters.yml

carcel_user_mailer_address: your.address@your.domain
```

Finally, import the routing:

```yaml
# app/config/routing.yml
fos_user:
    resource: "@FOSUserBundle/Resources/config/routing/all.xml"

carcel_user:
    resource: "@CarcelUserBundle/Resources/config/routing.yml"
    prefix: /

# redirecting the root
root:
    path: /
    defaults:
        _controller: FrameworkBundle:Redirect:urlRedirect
        path: /
        permanent: true
```

You should now be able to clear the application cache without any error.

```bash
bin/console cache:clear
```

## Update the database schema

Run the following command:

```bash
bin/console doctrine:schema:update --force
```

## Deploy the assets

Run the following command:

```bash
bin/console assets:install
```

Finally, copy the files `bower.json` and `.bowerrc` from the CarcelUserBundle to the root of your application, then run the following command to download and install JQuery and Bootstrap.

```bash
bower update
```

However, you can skip this step if you intend to customize the the bundle forms and not make use of Bootstrap and JQuery.

You should now be able to display the login page (your.application.domain.name/login).
