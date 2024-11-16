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
COPY . .

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer
RUN composer install --optimize-autoloader --no-dev

# Copy frontend build files from Stage 1
COPY --from=node-build /app/public ./public

# Expose port 9000 and start PHP-FPM server
EXPOSE 9000
CMD ["php-fpm"]
