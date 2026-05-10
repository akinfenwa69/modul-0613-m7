FROM php:8.4-apache

# 1. Instalar dependencias del sistema y extensiones de PHP necesarias
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
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

# 2. Configurar el MPM (Evita el error "More than one MPM loaded") 
RUN a2dismod mpm_event mpm_worker || true && a2enmod mpm_prefork

# 3. Eliminar el aviso "Could not reliably determine the FQDN" de los logs
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# 4. Preparar el directorio de trabajo y copiar tu código
WORKDIR /var/www/html
COPY . .

# 5. Ajustar permisos para que Apache no tenga problemas de escritura
RUN chown -R www-data:www-data /var/www/html

# 6. COMANDO CRÍTICO: Mapeo del puerto dinámico de Railway
# No podemos fijar el puerto 80 porque Railway asigna uno variable (ej. 8080) en cada despliegue.
# Este comando cambia el puerto en la configuración de Apache justo antes de arrancar.
CMD sh -c "sed -i 's/Listen 80/Listen ${PORT:-80}/g' /etc/apache2/ports.conf && \
           sed -i 's/:80/:${PORT:-80}/g' /etc/apache2/sites-available/000-default.conf && \
           apache2-foreground"