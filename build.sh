#!/bin/bash
composer install --no-dev --optimize-autoloader
cp .env.example .env
php artisan key:generate --force
touch database/database.sqlite
php artisan migrate --force
php artisan db:seed --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
