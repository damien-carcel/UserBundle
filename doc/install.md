# Installation and configuration

The following instructions only works if using Symfony Flex.

## Download using composer and activate the bundle

Require the bundle

```bash
composer require carcel/user-bundle --no-scripts
```

## Configure the bundle

- Copy the files present in `vendor/carcel/user-bundle/config/packages/` into `config/packages/`.
- Add the routes present in `vendor/carcel/user-bundle/config/routes.yaml` into `config/routes.yaml`
- Add the following environment variable to `.env`: `MAILER_USER="your.email@address.com"`
- Run `composer auto-scripts`

## Update the database schema

Run the following commands to create the database table and (optionally) populate it with minimal fixture set:

```bash
bin/console doctrine:schema:update --force
bin/console doctrine:fixtures:load
```

## Deploy the assets

Copy the files `bower.json` and `.bowerrc` from the CarcelUserBundle to the root of your application, then run the following command to download and install JQuery and Bootstrap.

```bash
bower update
```

However, you can skip this step if you intend to customize the the bundle forms and not make use of Bootstrap and JQuery.

## Run the application

The application is now ready to run. You can either configure a HTTP server of your choice (Apache, nginx…) or use the Symfony internal server:

```bash
make serve
```

You should now be able to display the login page (`localhost:8000/login` if using the Symfony server).
