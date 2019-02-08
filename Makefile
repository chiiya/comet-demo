SHELL := /bin/bash
PHP=php -d memory_limit=256M
PHPUNIT=vendor/bin/phpunit -d xdebug.max_nesting_level=250 -d memory_limit=1024M --coverage-text
DIR:=$(shell dirname $(realpath $(lastword $(MAKEFILE_LIST))))

test:
	@echo "Running unit and integration tests"; \
	sudo phpdismod -s cli xdebug; \
	sudo phpdismod -s fpm xdebug; \
	sudo service php7.2-fpm reload; \
	$(PHPUNIT);

code-coverage:
	@echo "Running unit and integration tests"; \
	sudo phpenmod -s cli xdebug; \
	sudo phpenmod -s fpm xdebug; \
	sudo service php7.2-fpm reload; \
	$(PHPUNIT); \
	sudo phpdismod -s cli xdebug; \
	sudo phpdismod -s fpm xdebug; \
	sudo service php7.2-fpm reload;

dusk:
	@echo "Running browser tests"; \
	php artisan dusk;
