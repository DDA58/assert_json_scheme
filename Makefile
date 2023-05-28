tests: run_verbose_tests
phpfix: run_phpfix
composeri: run_composeri

run_verbose_tests:
	docker-compose run app_cli ./vendor/bin/phpunit --verbose --testdox

run_phpfix:
	docker-compose run app_cli ./vendor/bin/phpcbf

run_composeri:
	docker-compose run app_cli composer install
