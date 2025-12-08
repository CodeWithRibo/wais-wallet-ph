FROM php:8.2-fpm


RUN apt-get update && apt-get install -y \
    git curl libpq-dev zip unzip nodejs npm \
    && docker-php-ext-install pdo pdo_pgsql

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader


RUN npm install && npm run build

EXPOSE 8000


CMD ["sh", "-c", "php artisan migrate:fresh --force && php artisan storage:link && php artisan serve --host=0.0.0.0 --port=8000"]
