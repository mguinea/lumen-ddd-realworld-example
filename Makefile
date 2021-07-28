PROJECT_NAME := lumen-ddd-realworld-example
DOCKER_COMPOSE = docker-compose -p $(PROJECT_NAME) -f docker-compose.yml

install:
	@docker network inspect realworld > /dev/null || docker network create realworld
	@make build
	@make up
	@make composer-install

build:
	$(DOCKER_COMPOSE) build

upa:
	$(DOCKER_COMPOSE) up --force-recreate --remove-orphans

up:
	$(DOCKER_COMPOSE) up -d --force-recreate --remove-orphans

destroy:
	$(DOCKER_COMPOSE) down
	$(DOCKER_COMPOSE) rm -f
	@docker volume rm lumen-ddd-realworld-example_realworld-dbdata-auth
	@docker volume rm lumen-ddd-realworld-example_realworld-dbdata-auth-test
	@docker volume rm lumen-ddd-realworld-example_realworld-dbdata-blog
	@docker volume rm lumen-ddd-realworld-example_realworld-dbdata-blog-test

services:
	$(DOCKER_COMPOSE) ps

networks:
	@docker network ls

volumes:
	@docker volume ls

composer-install:
	@docker exec -it realworld.blog.app composer install

composer-update:
	@docker exec -it realworld.blog.app composer update

composer-dump-autoload:
	@docker exec -it realworld.blog.app composer dump-autoload

migrate:
	@docker exec -it -w /var/www/apps/blog-api realworld.blog.app php artisan migrate
	@docker exec -it -w /var/www/apps/auth-api realworld.auth.app php artisan migrate

migrate-fresh:
	@docker exec -it -w /var/www/apps/blog-api realworld.blog.app php artisan migrate:fresh
	@docker exec -it -w /var/www/apps/auth-api realworld.auth.app php artisan migrate:fresh

bash-api:
	@docker exec -it -w /var/www/apps/blog-api realworld.blog.app bash

bash-auth:
	@docker exec -it -w /var/www/apps/auth-api realworld.auth.app bash

.PHONY: tests
tests:
	@docker exec -it -w /var/www/apps/blog-api realworld.blog.app APIURL=http://localhost:8880/api ./run-api-tests.sh
	# @make tests-blog-auth

tests-blog-auth:
	# @docker exec -it realworld.auth.app vendor/bin/phpunit apps/auth-api/tests --order-by=random --configuration=apps/auth-api/phpunit.xml

