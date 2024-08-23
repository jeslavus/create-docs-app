# Указываем базовый образ
FROM php:8.1-fpm

# Устанавливаем системные зависимости
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl

# Устанавливаем PHP-расширения
RUN docker-php-ext-install pdo pdo_mysql gd

# Устанавливаем Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Копируем приложение в контейнер
COPY . /var/www

# Устанавливаем права
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage

# Устанавливаем рабочую директорию
WORKDIR /var/www

# Устанавливаем зависимости Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Устанавливаем права для хранения файлов и кеширования
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Указываем, что контейнер должен выполнять команду php-fpm
CMD ["php-fpm"]