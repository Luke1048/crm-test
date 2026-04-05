FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    default-mysql-client \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip unzip git \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

WORKDIR /var/www/html
