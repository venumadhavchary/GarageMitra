########################################
# 1. Frontend build (Node)
########################################
FROM node:22-alpine AS frontend

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci

COPY resources ./resources
COPY vite.config.js ./
COPY public ./public

RUN npm run build


########################################
# 2. Backend build (Composer)
########################################
FROM composer:2 AS backend

WORKDIR /app

# Install required PHP extensions for Filament
RUN apk add --no-cache \
    icu-dev \
    && docker-php-ext-install intl

COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

COPY . .


########################################
# 3. Runtime (PHP + Nginx)
########################################
FROM php:8.3-fpm-alpine

# System deps
RUN apk add --no-cache \
    nginx \
    bash \
    curl \
    libzip-dev \
    icu-dev \
    oniguruma-dev \
    mysql-client \
    supervisor

# PHP extensions
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    intl \
    zip \
    bcmath \
    opcache

# Nginx config
COPY docker/nginx.conf /etc/nginx/nginx.conf

# App files
WORKDIR /var/www/html
COPY --from=backend /app ./
COPY --from=frontend /app/public/build ./public/build

# Laravel setup
RUN php artisan config:cache \
 && php artisan route:cache \
 && php artisan view:cache

# Create volume directories for persistent storage
RUN mkdir -p \
    /var/www/html/storage/app/public \
    /var/www/html/storage/logs \
    /var/www/html/storage/framework/sessions \
    /var/www/html/storage/framework/cache/data

# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache public \
 && chmod -R 775 storage bootstrap/cache

# Volumes for persistent data
VOLUME ["/var/www/html/storage/app", "/var/www/html/storage/logs"]

# Health check for Coolify
HEALTHCHECK --interval=30s --timeout=3s --start-period=5s --retries=3 \
  CMD curl -f http://localhost:80/health || exit 1

EXPOSE 80

CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]