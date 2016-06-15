# Test project for PI based on Sonata Admin Bundle

Setup:

* <code>composer install</code>;
* <code>php app/console doctrine:database:create</code> - create database;
* <code>php app/console doctrine:migrations:migrate</code> - apply migrations;
* <code>php php app/console fos:user:create --super-admin</code> - create first user;
