# symfony-admin-boilerplate

This branch already set up with:
 - Symfony 4.2
 - FOSUserBundle
 - MySQL
 - AdminLTE (https://adminlte.io/)

# Project setup and run

Install dependencies
```sh
$ composer install
```
Create database
```sh
$ php bin/console doctrine:database:create
```
Run migrations
```sh
$ php bin/console doctrine:migrations:migrate
```
Create first user
```sh
$ php bin/console fos:user:create
```
Promote user to ROLE_ADMIN
```sh
$ php bin/console fos:user:promote
```
