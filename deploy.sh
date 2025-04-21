#!/bin/bash

# Turn on maintenance mode
php artisan down || true

cp .env.server .env

# Install/update composer dependecies
composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

# Run database migrations
php artisan migrate:fresh --seed

# Clear caches
php artisan cache:clear

# Clear and cache routes
 php artisan route:cache
#
# Clear and cache config
 php artisan config:cache

# Clear and cache views
 php artisan view:cache

# Turn off maintenance mode
php artisan up
