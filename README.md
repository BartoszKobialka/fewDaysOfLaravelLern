# fewDaysOfLaravelLern #


## Requirements: ##
- xampp or other server (min. PHP 7.3, MYSQL)
- laravel
- npm
## Setup: ##
- clone repository
- create empty database for project
- copy .env.example and call it .env
- edit .env file

APP_URL=[__your_server_ip:port/__] for example *localhost:8000/*

__Setup DB and SMTP *(you can use https://mailtrap.io/)* connection in .env file__

- opne cmd in project directory end exec:
  - *composer update
  - *composer install
  - *npm install
  - *php artisan key:generate
  - *php artisan migrate
  
### For add a admin account for adding products you should insert admin's email into table *admins* ###
