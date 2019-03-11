# Haze420 - API
General app structure.

Documentation with Postman - https://www.getpostman.com/collections/0b6f57ecde50443a8b78.

Require Wordpress Plugins:
1. CoCart
2. WP REST User

Project setup process:
1. Create .env file (look at `.env.example`)
2. Run next commands:
````bash
composer install
php artisan migrate --seed
php passport:install
````
