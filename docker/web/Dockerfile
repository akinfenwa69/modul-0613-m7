FROM php:8.4-apache

# 1. Instalar lo básico
RUN apt-get update && apt-get install -y \
    git unzip zip curl libzip-dev libpng-dev libjpeg62-turbo-dev \
    libwebp-dev libfreetype6-dev libicu-dev libxml2-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install pdo_mysql mysqli gd intl zip \
    && a2enmod rewrite headers \
    && rm -rf /var/lib/apt/lists/*

# 2. ATAQUE DIRECTO AL MPM (Aquí está tu error de los 3 días)
# Borramos físicamente los archivos de configuración de los módulos conflictivos
RUN rm -f /etc/apache2/mods-enabled/mpm_event.* \
    && rm -f /etc/apache2/mods-enabled/mpm_worker.* \
    && a2enmod mpm_prefork

# 3. Configurar Laravel (DocumentRoot a /public)
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf \
    && echo "ServerName localhost" >> /etc/apache2/apache2.conf

# 4. Copiar archivos (Asegúrate de estar en la raíz de tu repo al subir)
WORKDIR /var/www/html
COPY app/laravel/ .
COPY docker/web/php-dev.ini $PHP_INI_DIR/conf.d/

# 5. Permisos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 6. Puerto dinámico para Railway
# Forzamos a Apache a escuchar en el puerto que Railway asigne
CMD sh -c "sed -i 's/Listen 80/Listen ${PORT:-80}/g' /etc/apache2/ports.conf && \
           sed -i 's/:80/:${PORT:-80}/g' /etc/apache2/sites-available/000-default.conf && \
           apache2-foreground"