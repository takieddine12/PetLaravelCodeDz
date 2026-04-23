FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev curl \
    && docker-php-ext-install pdo pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader

# Laravel setup
RUN php artisan config:clear

EXPOSE 8000

CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8000