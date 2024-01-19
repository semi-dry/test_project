APP=app
ARTISAN=docker-compose exec $(APP) php artisan $(ARTISAN_EXTRA)

# Set-up
run:  build npm key jwt migrate permissions

build:
	cp .env.local .env || true
	docker-compose build
	docker-compose up -d
	docker-compose exec $(APP) composer install
npm:
	docker-compose exec $(APP) npm install
key:
	$(ARTISAN) key:generate --ansi
jwt:
	$(ARTISAN) jwt:secret --ansi
update:
	docker-compose exec $(APP) composer update
migrate:
	$(ARTISAN) migrate
permissions:
	docker-compose exec $(APP) chmod 777 -R storage
rebuild:
	docker-compose down
	docker-compose build
	docker-compose up -d
route:
	$(ARTISAN) route:list
watch:
	docker-compose exec $(APP) npm run watch
# Clear
optimize:
	$(ARTISAN) optimize
clear:
	$(ARTISAN) route:clear
	$(ARTISAN) cache:clear
	$(ARTISAN) config:clear
	$(ARTISAN) view:clear
#Tests
test:
	$(ARTISAN) test
#
