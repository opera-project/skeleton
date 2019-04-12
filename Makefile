init:
	composer install
	echo "{}" > public/build/manifest.json
	./bin/console doctrine:database:create
	./bin/console doctrine:schema:create
	./bin/console doctrine:fixtures:load
	./bin/console assets:install
	./bin/console ckeditor:install
	./bin/console assets:install public

rebuild:
	@php bin/console doctrine:database:drop --force
	@php bin/console doctrine:database:create
	@php bin/console doctrine:schema:create -q
	@php bin/console doctrine:fixtures:load --no-interaction
	@php bin/console cache:clear
