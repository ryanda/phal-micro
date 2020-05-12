CURRENTDIR=$(shell pwd)

build:
	docker-compose build

build-prod:
	docker-compose -f docker-compose.prod.yml build

up:
	docker-compose up

upd:
	docker-compose up -d

up-prod:
	docker-compose -f docker-compose.prod.yml up -d

down:
	docker-compose down

down-prod:
	docker-compose -f docker-compose.prod.yml down

sh:
	docker-compose exec phalcon sh

sh-prod:
	docker-compose -f docker-compose.prod.yml exec phalcon sh

restart: down upd

restart-prod: down-prod up-prod

start: upd

clear:
	clear

.PHONY: build build-prod up up-prod down down-prod sh sh-prod restart restart-prod start clear
