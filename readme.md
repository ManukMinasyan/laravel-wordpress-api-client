##Haze420 - API
General app structure info:
Because we are using wordpress database, for each resource was created SQL Views.


Documentation - Swagger.

Project setup process:
1. Create .env file (look at `.env.example`)
2. Run next commands:
````bash
composer install
php artisan migrate
php passport:install

````