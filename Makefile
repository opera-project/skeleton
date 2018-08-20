init:
	echo "{}" > public/build/manifest.json
	./bin/console doctrine:database:create
	./bin/console doctrine:schema:create
	./bin/console doctrine:fixtures:load
	./bin/console assets:install
	./bin/console ckeditor:install
	./bin/console assets:install public