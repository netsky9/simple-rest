.DEFAULT_GOAL := help

build: ## Docker build
	docker compose build

up: ## Docker up
	docker compose up -d

down: ## Docker down
	docker compose down

stat: ## Docker ps
	docker compose ps

logs: ## Show logs
	docker compose logs

bash: ## Bash
	docker-compose exec rest-apache bash
	
