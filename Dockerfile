# Stage 1: Build frontend assets
FROM node:18-alpine as node-build
WORKDIR /app
COPY package.json yarn.lock ./
RUN yarn install --frozen-lockfile
COPY . .
RUN yarn build

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

# Copy project files
COPY . .

# Set correct permissions for Laravel
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage \
    && chmod -R 755 /var/www/bootstrap/cache

# Install Laravel dependencies via Composer
RUN composer install --optimize-autoloader --no-dev

# Copy frontend build files from Stage 1
COPY --from=node-build /app/public ./public

# Expose port 9000 and start PHP-FPM server
EXPOSE 9000
CMD ["php-fpm"]
