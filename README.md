# Poker hands

## How to run

### Pre-requisites
- Docker
- Docker Compose

### Setup

Clone this repo and run the following commands, in the given order:

1. `cp .env.example .env`
2. `docker-compose up -d`
3. `docker-compose exec united_remote_web composer install`
4. `docker-compose exec united_remote_web php artisan key:generate`
5. `docker-compose exec united_remote_web php artisan migrate`

> Note that the application uses the ports 80 and 3306 in order to run, so make sure no other service is using those ports.

The application will be up and running at [http://localhost]() or [http://127.0.0.1]().


You can authenticate using the following credentials:
EMAIL       : rfoliveira@rfoliveira.com
PASSWORD    : password
