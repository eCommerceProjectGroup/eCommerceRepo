
## Installation
 
composer install
```
#### Database
Setup the database connection in .env then run
```
php bin/console doctrine:database:create
php bin/console doctrine:schema:create
```
#### Admin user creation
```
php bin/console app:create-admin-user 'email' 'password'
```
###To start:
 php -S localhost:8000 -t public

## Built with
- Symfony 4
- Doctrine
- Twig
- Bootstrap
- Paypal rest-api-sdk
