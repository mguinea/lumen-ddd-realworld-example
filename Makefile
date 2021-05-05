PROJECT_NAME := lumen-ddd-realworld-example
DOCKER_COMPOSE = docker-compose -p $(PROJECT_NAME) -f docker-compose.yml

install:
	@docker network inspect lumen-ddd-realworld-example-network > /dev/null || docker network create lumen-ddd-realworld-example-network
	@make build
	@make up
	@make composer-install

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

jwt-secret:
	@docker exec -it -w /var/www/apps/blog-api blog-api.app php artisan jwt:secret

bash:
	@docker exec -it -w /var/www/apps/blog-api blog-api.app bash
