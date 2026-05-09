FROM php:8.4-apache

# Instalar dependencias
RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev zip unzip git curl

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Habilitar rewrite para Laravel
RUN a2enmod rewrite

# FIX: Corregir el error "More than one MPM loaded"
RUN a2dismod mpm_event || true && a2dismod mpm_worker || true && a2enmod mpm_prefork || true

# Configurar DocumentRoot
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf
RUN sed -ri -e 's!/var/www/conf-available/docker-php.conf!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

WORKDIR /var/www/html
COPY app/laravel .

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80
CMD ["apache2-foreground"]