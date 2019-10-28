.PHONY: docker-build docker-up

docker-build:
	docker build -t ffi_uuid .

docker-bash:
	docker run -it --name ffi_uuid ffi_uuid bash
