#!/usr/bin/env bash

cd docker && docker-compose up -d workspace
sleep 1
docker-compose exec workspace composer global require hirak/prestissimo
docker-compose exec workspace composer install
docker-compose up -d mysql
sleep 3
docker-compose exec workspace php artisan migrate:refresh --seed
docker-compose up -d nginx redis phpmyadmin
sleep 2
docker-compose exec workspace ./vendor/bin/phpunit tests/Feature
echo "Finished. Please follow instructions from Installation guide on Github"