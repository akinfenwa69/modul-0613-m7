FROM php:8.4-apache

# 1. Instalar extensiones necesarias para Laravel
RUN apt-get update && apt-get install -y \
    git unzip zip curl libzip-dev libpng-dev libjpeg62-turbo-dev \
    libwebp-dev libfreetype6-dev libicu-dev libxml2-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install pdo_mysql mysqli gd intl zip \
    && a2enmod rewrite headers \
    && rm -rf /var/lib/apt/lists/*

# 2. LIMPIEZA AGRESIVA DE MPM (El error de los 3 días)
# Borramos CUALQUIER configuración de MPM que exista y forzamos solo prefork.
RUN find /etc/apache2/mods-enabled -name "mpm_*" -delete \
    && a2enmod mpm_prefork

# 3. Configurar DocumentRoot para LARAVEL
# Laravel necesita que la raíz sea la carpeta /public, no la raíz del proyecto.
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf \
    && echo "ServerName localhost" >> /etc/apache2/apache2.conf

# 4. Copiar archivos usando la estructura real de tu repo
# Asumiendo que el contexto de build de Railway es la raíz del repositorio:
WORKDIR /var/www/html
COPY app/laravel/ . 

# Copiar tu configuración de PHP personalizada
COPY docker/web/php-dev.ini $PHP_INI_DIR/conf.d/

# 5. Permisos para Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 6. Puerto dinámico (Obligatorio para Railway)
# Aunque pongas 80 en el panel, Railway puede ignorarlo. Esto lo hace infalible.
CMD sh -c "sed -i 's/Listen 80/Listen ${PORT:-80}/g' /etc/apache2/ports.conf && \
           sed -i 's/:80/:${PORT:-80}/g' /etc/apache2/sites-available/000-default.conf && \
           apache2-foreground"