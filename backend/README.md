# Setup app
- cd into `src` folder
- run `cp .env.example .env` no need to modify environment
- run `docker run --rm --interactive --tty --volume $PWD:/app composer install`, installing dependencies

# Runing app
- cd to root directory
- run `cp .env.example .env` setup environment variable
- run `docker-compose -f docker-compose.yml -f docker-compose.dev.yml up --build` to build and run development mode
- run `docker-compose -f docker-compose.yml -f docker-compose.prod.yml up --build -d` to build and run production mode

# Oprimize and generate app key
- run `docker-compose exec app php artisan key:generate`
- run `docker-compose exec app php artisan optimize`
- run `docker-compose exec app php artisan jwt:secret`

# Migration & seeder
- run `docker-compose exec app php artisan migrate:fresh --seed`

# Migration & seeder 
- run `docker-compose exec app php artisan storage:link`

# Documentation
- run `docker-compose exec app php artisan l5-swagger:generate`
documentation can be accessed at `/api/documentation` endpoint.
