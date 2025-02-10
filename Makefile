install:
	composer install --dev
	cp .env.example .env
	./vendor/bin/sail up -d
	./vendor/bin/sail artisan key:generate
	sleep 5
	./vendor/bin/sail artisan migrate
	./vendor/bin/sail artisan db:seed
	./vendor/bin/sail artisan jwt:secret
