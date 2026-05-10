FROM php:8.4-apache

# 1. Instalar dependencias del sistema y PHP
RUN apt-get update && apt-get install -y \
    git unzip zip curl libzip-dev libpng-dev libjpeg62-turbo-dev \
    libwebp-dev libfreetype6-dev libicu-dev libxml2-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install pdo_mysql mysqli gd intl zip \
    && a2enmod rewrite headers \
    && rm -rf /var/lib/apt/lists/*

# 2. FIX CRÍTICO: Resolver conflicto de MPM (Adiós al error de 3 días)
# Desactivamos los módulos que sobran y forzamos prefork para PHP
RUN a2dismod mpm_event mpm_worker || true && a2enmod mpm_prefork

# 3. FIX DEL 403: Apuntar el DocumentRoot a la carpeta /public de Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf \
    && sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# 4. FIX DEL 502: Configurar el puerto dinámico de Railway
# Forzamos a Apache a escuchar el puerto que Railway asigne en tiempo de ejecución
RUN sed -i 's/Listen 80/Listen ${PORT}/g' /etc/apache2/ports.conf \
    && sed -i 's/:80/:${PORT}/g' /etc/apache2/sites-available/000-default.conf \
    && echo "ServerName localhost" >> /etc/apache2/apache2.conf

# 5. Preparar la aplicación
WORKDIR /var/www/html

# Copiamos el contenido de tu carpeta local /app/laravel a la raíz del contenedor
COPY app/laravel/ .

# Copiamos tu php-dev.ini si lo necesitas
COPY docker/web/php-dev.ini /usr/local/etc/php/conf.d/

# 6. Permisos para que Laravel pueda escribir
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 7. Lanzar Apache
CMD ["apache2-foreground"]