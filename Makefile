DOCKER_IMAGE=itabashi

include Makefile.docker

.PHONY: check-version
check-version:
	docker run --rm --entrypoint md5sum $(DOCKER_NAMESPACE)/$(DOCKER_IMAGE):$(VERSION) /var/www/html/generate.php
