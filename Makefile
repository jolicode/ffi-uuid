.PHONY: docker-build docker-up

docker-build:
	docker build -t ffi_uuid .

docker-bash:
	docker run -it -v $(shell pwd):/app ffi_uuid bash
