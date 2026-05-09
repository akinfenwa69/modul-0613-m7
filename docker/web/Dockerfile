ARG PHP_VERSION=8.4
FROM php:${PHP_VERSION}-apache

# Instal·lació d'extensions i eines bàsiques
RUN apt-get update && apt-get install -y \
    git unzip zip curl libzip-dev libpng-dev libjpeg62-turbo-dev libwebp-dev \
    libfreetype6-dev libicu-dev libxml2-dev \
 && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
 && docker-php-ext-install -j"$(nproc)" pdo_mysql mysqli gd intl zip \
 && a2enmod rewrite headers \
 && rm -rf /var/lib/apt/lists/*

# Railway/Apache: evitar "More than one MPM loaded"
# Estrategia robusta: desactivar explícitamente todos los MPM y activar solo prefork.
RUN a2dismod mpm_event mpm_prefork mpm_worker 2>/dev/null || true \
 && rm -f /etc/apache2/mods-enabled/mpm_*.load /etc/apache2/mods-enabled/mpm_*.conf \
 && a2enmod mpm_prefork


# Copiem la configuració PHP personalitzada
COPY docker/web/php-dev.ini /usr/local/etc/php/conf.d/php-dev.ini

# DocumentRoot configurable
ARG DOCROOT=/var/www/html
ENV APACHE_DOCUMENT_ROOT=${DOCROOT}

RUN sed -i "s#DocumentRoot /var/www/html#DocumentRoot ${APACHE_DOCUMENT_ROOT}#g" /etc/apache2/sites-available/000-default.conf \
 && sed -i "s#<Directory /var/www/>#<Directory ${APACHE_DOCUMENT_ROOT}/>#g" /etc/apache2/apache2.conf \
 && sed -i "s/AllowOverride None/AllowOverride All/g" /etc/apache2/apache2.conf

WORKDIR /var/www/html

