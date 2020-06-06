start:
	php -S localhost:8080 -t public src/index.php

release:
	./release-tasks.sh
	vendor/bin/heroku-php-nginx -C nginx_app.conf

