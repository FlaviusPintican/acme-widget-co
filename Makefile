setup:
	docker-compose up -d
test:
	docker-compose exec app composer run test
analyze:
	docker-compose exec app composer run analyze
