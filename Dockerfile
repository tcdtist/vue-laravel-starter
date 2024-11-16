# Stage 1: Build frontend assets
FROM node:18-alpine as node-build
WORKDIR /app

# Copy package.json and yarn.lock
COPY package.json yarn.lock ./
RUN yarn install --frozen-lockfile

# Copy toàn bộ project (bao gồm cả Laravel PHP)
COPY . .

# Stage 2: Setup Laravel with PHP
FROM php:8.1-fpm as php-build
WORKDIR /var/www

# Install necessary PHP extensions
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    && docker-php-ext-install pdo pdo_mysql zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

# Copy toàn bộ project sang container php
COPY . .

# Chạy composer install trước để tạo thư mục vendor
RUN composer install --optimize-autoloader --no-dev

# Copy frontend build files từ node-build stage (lúc này thư mục vendor đã tồn tại)
COPY --from=node-build /app /var/www

# Chạy build frontend sau khi đã cài Composer
RUN yarn build

# Set correct permissions for Laravel
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage \
    && chmod -R 755 /var/www/bootstrap/cache

# Expose port 9000 and start PHP-FPM server
EXPOSE 9000
CMD ["php-fpm"]
