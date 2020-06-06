start:
	php -S localhost:8080 -t public public/index.php

release:
	./release-tasks.sh
