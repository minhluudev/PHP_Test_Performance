FROM php:8.2-fpm

# Copy file cấu hình PHP-FPM custom
COPY ./docker/php-fpm/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf
# Cài extension cần thiết cho Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev zip unzip git curl procps \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Cài Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy code (chỉ khi build, dev thì mount volume)
COPY ./laravel-app .

RUN cp .env.example .env
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Clear cache Laravel
RUN php artisan key:generate \
 && php artisan config:clear || true \
 && php artisan route:clear || true \
 && php artisan cache:clear || true \
 && php artisan view:clear || true

# Quyền cho storage & bootstrap/cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
