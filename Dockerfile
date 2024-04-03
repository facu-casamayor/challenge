# Utilizar la imagen oficial de PHP 8.2 con FPM (FastCGI Process Manager) y Alpine Linux como base
FROM php:8.2-fpm-alpine

# Instalar las dependencias necesarias para PHP y MySQL
RUN apk update && apk add --no-cache \
    bash \
    git \
    mysql-client \
    icu-dev \
    libzip-dev \
    zip \
    unzip

# Instalar las extensiones de PHP necesarias para Laravel
RUN docker-php-ext-install pdo_mysql intl zip

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Establecer el directorio de trabajo en el directorio raíz del servidor web
WORKDIR /var/www/html

# Copiar el código de la aplicación Laravel al contenedor
COPY prex-challenge /var/www/html

# Instalar las dependencias de Laravel usando Composer
RUN composer install --no-dev --optimize-autoloader

# Exponer el puerto 3000 para el servidor PHP-FPM
EXPOSE 3000

# Comando por defecto para iniciar PHP-FPM
CMD ["php-fpm"]