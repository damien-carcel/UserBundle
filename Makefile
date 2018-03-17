composer :
	docker-compose run --rm php composer update --prefer-dist --optimize-autoloader

phpcs :
	docker-compose run --rm php vendor/bin/phpcs -p --standard=PSR2 --extensions=php src

php-cs-fixer :
	docker-compose run --rm php vendor/bin/php-cs-fixer fix --dry-run -v --diff --config=.php_cs.php

phpspec :
	docker-compose run --rm php vendor/bin/phpspec run

acceptance :
	docker-compose run --rm php vendor/bin/behat --suite=acceptance

integration :
	docker-compose run --rm php vendor/bin/behat --suite=integration

tests : phpcs php-cs-fixer phpspec acceptance integration
