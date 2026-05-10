FROM php:8.4-apache

# 1. Instalar dependencias necesarias
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

# 2. Configurar el puerto dinámico de Railway y el ServerName
# Esto permite que Apache use la variable ${PORT} que le da Railway
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf \
    && sed -i 's/Listen 80/Listen ${PORT}/g' /etc/apache2/ports.conf \
    && sed -i 's/:80/:${PORT}/g' /etc/apache2/sites-available/000-default.conf

# 3. Configurar el MPM correctamente de forma permanente
RUN a2dismod mpm_event mpm_worker || true && a2enmod mpm_prefork

# 4. Preparar los archivos de la app
WORKDIR /var/www/html
COPY . .

# 5. Permisos básicos para evitar errores 403
RUN chown -R www-data:www-data /var/www/html

CMD ["apache2-foreground"]