SHELL=sh
.DEFAULT_GOAL := help

APP_NAME = sorted-linked-list
DOCKER_EXEC = docker exec -it ${APP_NAME}
COMPOSE_FILE = docker-compose -f docker-compose.yml

help:
	@printf "\n%s\n________________________________________________\n" $(shell basename ${APP_NAME})
	@printf "\n\033[32mAvailable commands:\n\033[0m"
	@fgrep -h "##" $(MAKEFILE_LIST) | fgrep -v fgrep  | sed -e 's/\\$$//' | sed -e 's/##//' | awk 'BEGIN {FS = ":"}; {printf "\033[33m%s:\033[0m%s\n", $$1, $$2}'

setup: 		## Setup library local development environment
	#cp -n .env.example .env || true
	${COMPOSE_FILE} --profile ${APP_NAME} up -d
	make install
	make test

rebuild: 	## Rebuild docker images
	${COMPOSE_FILE} --profile ${APP_NAME} build --no-cache
	${COMPOSE_FILE} --profile ${APP_NAME} up -d --force-recreate

stop: 		## Stop docker containers
	${COMPOSE_FILE} --profile ${APP_NAME} stop

start: 		## Start docker containers
	${COMPOSE_FILE} --profile ${APP_NAME} start

restart: 	## Restart docker containers
	${COMPOSE_FILE} --profile ${APP_NAME} restart

remove: 	## Remove docker containers
	${COMPOSE_FILE} --profile ${APP_NAME} rm -f --stop

shell: 		## Run container shell
	${DOCKER_EXEC} sh

run: 		## Run container
	${COMPOSE_FILE} --profile ${APP_NAME} up

install:	## Install dependencies
	${DOCKER_EXEC} composer install

cs-fix: 	## Apply source code coding standards
	${DOCKER_EXEC} php vendor/bin/php-cs-fixer fix

rector-fix:	## Upgrade or refactor source code with provided rectors
	${DOCKER_EXEC} php vendor/bin/rector process

test:		## Run tests
	${DOCKER_EXEC} php vendor/bin/phpunit --coverage-html tests/reports/html-coverage

analyze:	## Run static analyze
	${DOCKER_EXEC} composer static:analyze

.PHONY: help setup rebuild stop start restart remove shell run install cs-fix rector-fix test analyze
