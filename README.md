# Invillia PHP Challenge
Challenge by Invillia

To run this project you need to have composer and mysql installed and running.
  
Then execute the following commands:
 - composer install
 - docker build up
 - docker-compose exec app php artisan migrate 
 
To start the application:
 - docker-compose up

To run phpunit tests:
 - docker-compose exec app php artisan test
