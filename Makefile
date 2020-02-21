setup:
	docker-compose pull
	sudo docker-compose build
	docker-compose up -d