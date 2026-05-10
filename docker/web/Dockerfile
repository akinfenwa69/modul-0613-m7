FROM php:8.4-apache

# 1. Instalar dependencias
RUN apt-get update && apt-get install -y \
    git unzip zip curl libzip-dev libpng-dev libjpeg62-turbo-dev \
    libwebp-dev libfreetype6-dev libicu-dev libxml2-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install pdo_mysql mysqli gd intl zip \
    && a2enmod rewrite headers \
    && rm -rf /var/lib/apt/lists/*

# 2. Mantener la cura del MPM (Esto ya funciona, no lo toques)
RUN a2dismod mpm_event mpm_worker || true && a2enmod mpm_prefork

# 3. CORRECCIÓN DEL 403: Apuntar Apache a la carpeta /public de Laravel
# Por defecto Apache busca en /var/www/html, pero Laravel está en /var/www/html/public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# 4. Configurar el puerto para Railway y el ServerName
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf \
    && sed -i 's/Listen 80/Listen ${PORT}/g' /etc/apache2/ports.conf \
    && sed -i 's/:80/:${PORT}/g' /etc/apache2/sites-available/000-default.conf

# 5. Copiar los archivos correctamente
# Copiamos lo que hay DENTRO de app/laravel a la raíz del contenedor
WORKDIR /var/www/html
COPY app/laravel/ .

# 6. Permisos críticos para que Laravel no explote al escribir logs
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 7. Ejecutar
CMD ["apache2-foreground"]