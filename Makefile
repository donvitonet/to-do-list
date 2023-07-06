.PHONY: build up logs nginx

build:
	docker-compose build app

up:
	docker-compose up -d

logs:
	docker-compose logs -f -t app >> /dev/stdout

nginx:
	docker-compose logs -f -t nginx >> /dev/stdout