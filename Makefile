.PHONY: install cs test test-ci

install:
	composer install

test:
	vendor/bin/simple-phpunit --coverage-html=build/coverage

test-ci:
	vendor/bin/simple-phpunit --coverage-text --coverage-clover=build/coverage.xml
