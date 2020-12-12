# Invillia PHP Challenge
Challenge by Invillia

To run this project you need to have composer and mysql installed and running.
  
Then execute the following commands:
 - composer install
 - docker-compose build
 - docker-compose exec app php artisan migrate 
 
To start the application:
 - docker-compose up
 
The application will be available at http://localhost:8000/

To run phpunit tests:
 - docker-compose exec app php artisan test
