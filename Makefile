.PHONY: build up

build:
	docker-compose build app

up:
	docker-compose up -d