FROM dunglas/frankenphp

# Cài composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Cài extension PHP cần cho Laravel
RUN install-php-extensions \
    pdo_mysql \
    gd \
    intl \
    zip \
    opcache \
		pcntl

# Cài thêm gói hệ thống
RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev zip unzip git curl procps \
 && rm -rf /var/lib/apt/lists/*

# Copy source Laravel
WORKDIR /app
COPY ./laravel-app .
COPY ./docker/franken-php-worker/Caddyfile /etc/caddy/Caddyfile

# Cài Laravel dependencies
RUN cp .env.example .env \
 && composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist \
 && php artisan key:generate \
 && php artisan config:clear || true \
 && php artisan route:clear || true \
 && php artisan cache:clear || true \
 && php artisan view:clear || true

# Set quyền storage & bootstrap
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache \
 && chmod -R 777 /app/storage /app/bootstrap/cache

# Expose cổng
EXPOSE 80

# Chạy FrankenPHP (Laravel worker mode)
CMD ["php", "artisan", "octane:frankenphp", "--workers=4", "--max-requests=500"]
