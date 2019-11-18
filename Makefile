.DEFAULT_GOAL := help
.PHONY: help docker-build docker-bash

run: docker-build docker-bash ## Build and run a container

docker-build: ## Build the docker image
	docker build -t ffi_uuid .

docker-bash: ## Run a docker container
	docker run -it -v $(shell pwd):/app ffi_uuid bash

help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-15s\033[0m %s\n", $$1, $$2}'
