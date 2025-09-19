FROM php:8.2-fpm

# Cài extension cần thiết cho Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev zip unzip git curl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Cài Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy code (chỉ khi build, dev thì mount volume)
COPY ./laravel-app .

RUN composer install

# Quyền cho storage & bootstrap/cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
