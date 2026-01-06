# ======================
# 1️⃣ FRONTEND BUILD
# ======================
FROM node:18-bullseye AS frontend

WORKDIR /app
COPY package*.json ./
RUN npm install --legacy-peer-deps

COPY resources ./resources
COPY vite.config.js ./
RUN npm run build


# ======================
# 2️⃣ PHP + NGINX RUNTIME
# ======================
FROM php:8.2-fpm-bullseye

RUN apt-get update && apt-get install -y \
    nginx supervisor git unzip curl \
    libzip-dev libpng-dev libjpeg-dev libonig-dev libxml2-dev \
    zip \
    && docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath gd

WORKDIR /var/www
COPY . .

# Copy built assets
COPY --from=frontend /app/public/build /var/www/public/build

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

COPY docker/nginx.conf /etc/nginx/sites-available/default
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

EXPOSE 10000
CMD ["/usr/bin/supervisord", "-n"]
