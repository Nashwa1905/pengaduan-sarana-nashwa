#!/bin/bash
set -e

# Setup environment
cp .env.example .env
php artisan key:generate --force

# Setup database
touch database/database.sqlite
php artisan migrate --force
php artisan db:seed --force

# Cache for performance
php artisan config:cache
php artisan route:cache
php artisan view:cache
