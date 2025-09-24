FROM dunglas/frankenphp

# add additional extensions here:
RUN install-php-extensions \
	pdo_mysql \
	gd \
	intl \
	zip \
	opcache

# Set working dir
WORKDIR /app

# Copy code vào container
COPY ./simple-app /app


# Run FrankenPHP ở worker mode
# --worker: file PHP entrypoint (ở đây là index.php trong thư mục /app)
# --workers: số lượng worker process
# --max-requests: số request tối đa 1 worker xử lý trước khi restart
# CMD ["frankenphp", "run", "--config", "/etc/caddy/Caddyfile", "--adapter", "caddyfile"]
CMD ["frankenphp", "run", "--config", "/etc/caddy/Caddyfile", "--adapter", "caddyfile"]
