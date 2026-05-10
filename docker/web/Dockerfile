FROM php:8.4-apache

RUN apt-get update && apt-get install -y \
    git unzip zip curl \
    libzip-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libwebp-dev \
    libfreetype6-dev \
    libicu-dev \
    libxml2-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install pdo_mysql mysqli gd intl zip \
    && a2enmod rewrite headers \
    && rm -rf /var/lib/apt/lists/*

# Desactivar mpm_event y mpm_worker para asegurar que solo prefork esté activo
RUN a2dismod mpm_event mpm_worker || true && a2enmod mpm_prefork

WORKDIR /var/www/html