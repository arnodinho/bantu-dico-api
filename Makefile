
assets: ## Install assets
	@./bin/install.sh ${env}

warmup: ## Warmup project
	php bin/console cache:clear --no-warmup --env="${env}"; \
	php bin/console cache:warmup --env="${env}"; \
	chmod -Rf 777 ./var;

checkcomposer: ## Check composer dependencies
	command -v composer >/dev/null 2>&1 || { echo >&2 "I require composer but it's not installed. Aborting."; exit 1; }

unit-test: ## Launch unit testing
	./vendor/bin/simple-phpunit --colors=always --exclude-group=exclude

unit-test-coverage-html: ## Export unit coverage in HTML format
	./vendor/bin/simple-phpunit --colors=always --exclude-group=exclude --coverage-html=build/coverage --testdox
