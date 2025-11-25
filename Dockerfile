FROM php:8.2-fpm

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    zip unzip git

RUN docker-php-ext-install pdo pdo_mysql gd zip

COPY . .

RUN chmod -R 777 storage bootstrap/cache
