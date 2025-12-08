FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    git curl libpq-dev zip unzip nodejs npm \
    && docker-php-ext-install pdo pdo_pgsql

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Build assets
RUN npm install && npm run build

# Remove this RUN command (it doesn't work here!)
# RUN php artisan migrate --force && php artisan storage:link  <-- DELETE THIS LINE

EXPOSE 8000

# Update CMD to run migrations AND start the server
# We use "sh -c" to chain multiple commands
CMD ["sh", "-c", "php artisan migrate --force && php artisan storage:link && npm run dev && php artisan serve --host=0.0.0.0 --port=8000"]
