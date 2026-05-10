FROM php:8.4-apache

# Instalación de dependencias y extensiones (lo que ya tenías)
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

# ESTO ES LO QUE TE FALTA: Copiar tu código al contenedor
COPY . /var/www/html

WORKDIR /var/www/html

# Nota: He quitado el a2dismod de aquí porque es más fiable 
# hacerlo en el Start Command de Railway como te puse arriba.