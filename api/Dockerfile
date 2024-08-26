FROM php:8.2-fpm

RUN apt-get update && apt-get install -y --no-install-recommends \
    libpq-dev \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_pgsql zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY . .

RUN composer install --no-dev --optimize-autoloader --no-scripts --prefer-dist \
    && chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage

CMD ["php-fpm"]