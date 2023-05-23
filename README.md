# Laravel9 movie web
Fresh file laravel 9 with docker compose:
  - nginx:stable-alpine
  - php8:stable-alpine

System structure
- Controller
- Service
- Repositories
- Model

Docker-compose build nginx, mysql, and php8:
> docker-compose up -d --build

Update folder /vendor and Auto load
> docker-compose exec backend composer update

Migrate Database
> docker-compose exec backend php artisan migrate

Unit test Run
> docker-compose exec backend php artisan test

run project on local browser
> localhost:80

if the file read permission is limited
>chmod -R 777 web/

delete container
> docker-compose down






