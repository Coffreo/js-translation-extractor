.PHONY: install cs test test-ci

install:
	composer install

cs:
	vendor/bin/php-cs-fixer fix --verbose --diff

test:
	vendor/bin/simple-phpunit --coverage-html=build/coverage

test-ci:
	vendor/bin/simple-phpunit --coverage-text --coverage-clover=build/coverage.xml
	vendor/bin/php-cs-fixer fix --dry-run
