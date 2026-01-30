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

COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

COPY . .


########################################
# 3. Runtime (PHP + Nginx)
########################################
FROM php:8.2-fpm-alpine

# System deps
RUN apk add --no-cache \
    nginx \
    bash \
    libzip-dev \
    icu-dev \
    oniguruma-dev \
    mysql-client

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

# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache

EXPOSE 80

CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]
