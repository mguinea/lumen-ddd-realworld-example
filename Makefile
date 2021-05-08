PROJECT_NAME := lumen-ddd-realworld-example
DOCKER_COMPOSE = docker-compose -p $(PROJECT_NAME) -f docker-compose.yml

install:
	@docker network inspect realworld > /dev/null || docker network create realworld
	@make build
	@make up
	@make composer-install
	@make migrate

build:
	$(DOCKER_COMPOSE) build

upa:
	$(DOCKER_COMPOSE) up --force-recreate

up:
	$(DOCKER_COMPOSE) up -d --force-recreate

destroy:
	$(DOCKER_COMPOSE) down
	$(DOCKER_COMPOSE) rm -f

services:
	$(DOCKER_COMPOSE) ps

networks:
	@docker network ls

composer-install:
	@docker exec -it blog-api.app composer install

composer-update:
	@docker exec -it blog-api.app composer update

composer-dump-autoload:
	@docker exec -it blog-api.app composer dump-autoload

migrate:
	@docker exec -it -w /var/www/apps/blog-api blog-api.app php artisan migrate

migrate-fresh:
	@docker exec -it -w /var/www/apps/blog-api blog-api.app php artisan migrate:fresh

jwt-secret:
	@docker exec -it -w /var/www/apps/blog-api blog-api.app php artisan jwt:secret

bash:
	@docker exec -it -w /var/www/apps/blog-api blog-api.app bash

.PHONY: tests
tests:
	@docker exec -it blog-api.app php vendor/bin/phpunit apps/blog-api/tests --order-by=random --configuration=apps/blog-api/phpunit.xml
