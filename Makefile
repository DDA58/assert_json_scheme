tests: run_verbose_tests
phpfix: run_phpfix
composeri: run_composeri
psalm: run_psalm

run_verbose_tests:
	docker-compose exec app_cli ./vendor/bin/phpunit --verbose --testdox

run_phpfix:
	docker-compose exec app_cli ./vendor/bin/phpcbf

run_composeri:
	docker-compose exec app_cli composer install

run_psalm:
	docker-compose exec app_cli ./vendor/bin/psalm --no-cache --config=psalm.xml
