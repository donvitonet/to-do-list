.PHONY: build up

build:
	docker-compose build app

up:
	docker-compose up -d

logs:
	docker-compose logs -f -t app >> /dev/stdout