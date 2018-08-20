init:
	./bin/console doctrine:database:create
	./bin/console doctrine:schema:create
	./bin/console doctrine:fixtures:load