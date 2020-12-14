# Invillia PHP Challenge
Challenge by Invillia

To run this project you need to have composer and mysql installed and running.
  
Then execute the following commands:
 - composer install
 - docker-compose build
 - docker-compose exec app php artisan migrate --seed
 
To start the application:
 - docker-compose up
 
The application will be available at http://localhost:8000/

The api routes:
 - http://localhost:8000/api/orders - List orders
 - http://localhost:8000/api/people - List People
 - http://localhost:8000/api/users - List Users for login
 - http://localhost:8000/api/login - Login (Expect Json ["email", "password"])

To run phpunit tests:
 - docker-compose exec app php artisan test
