
warmup: ## Warmup project
	php bin/console cache:clear --no-warmup --env="${env}"; \
	php bin/console cache:warmup --env="${env}"; \
	chmod -Rf 777 ./var;

unit-test: ## Launch unit testing
	./vendor/bin/phpunit --colors=always --exclude-group=exclude

unit-test-coverage-html: ## Export unit coverage in HTML format
	./vendor/bin/phpunit --colors=always --exclude-group=exclude --coverage-html=build/coverage --testdox

