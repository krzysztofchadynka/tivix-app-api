#!/bin/bash

cp .env.example .env
composer install
php artisan migrate
php artisan db:seed
php artisan key:generate
php artisan cache:clear
php artisan route:cache
