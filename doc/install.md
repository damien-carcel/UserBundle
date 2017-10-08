# Installation and configuration

## Download using composer and activate the bundle

Require the bundle

```bash
composer require carcel/user-bundle
```

## Configure the bundle

- Copy the content of  `vendor/carcel/user-bundle/config/fos_user.yaml` into `app/config/config.yml`.
- Copy the content of  `vendor/carcel/user-bundle/config/security.yaml` into `app/config/security.yml`.
- Add the routes present in `vendor/carcel/user-bundle/config/routes.yaml` into `app/config/routes.yaml`

## Deploy the assets

Copy the files `bower.json` and `.bowerrc` from the CarcelUserBundle to the root of your application, then run the following command to download and install JQuery and Bootstrap.

```bash
bower update
```

However, you can skip this step if you intend to customize the the bundle forms and not make use of Bootstrap and JQuery.

## Update the database schema

Run the following commands to create the database table and (optionally) populate it with minimal fixture set:

```bash
bin/console doctrine:schema:update --force
bin/console doctrine:fixtures:load
```

## Run the application

The application is now ready to run. You can either configure a HTTP server of your choice (Apache, nginx…) or use the Symfony internal server:

```bash
make serve
```

You should now be able to display the login page (`localhost:8000/login` if using the Symfony server).
