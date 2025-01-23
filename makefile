start-docker:
	clear && docker compose --env-file .env -f ./docker/docker-compose.yml up -d

stop-docker:
	clear && docker compose --env-file .env -f ./docker/docker-compose.yml down --remove-orphans

clean-docker:
	clear && \
	if [ -n "$$(docker container ls -aq)" ]; then \
		docker container stop $$(docker container ls -aq) && \
		docker container rm $$(docker container ls -aq); \
	fi && \
	if [ -n "$$(docker volume ls -q)" ]; then \
		docker volume rm $$(docker volume ls -q); \
	fi && \
	if [ -n "$$(docker images -q)" ]; then \
		docker rmi $$(docker images -q) -f; \
	fi
