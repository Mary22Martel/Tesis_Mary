# Usa una imagen base de PHP con extensiones necesarias para Laravel
FROM php:8.1-fpm

# Instala dependencias del sistema
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    libzip-dev

# Instala extensiones de PHP
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define el directorio de trabajo
WORKDIR /var/www

# Copia el contenido del proyecto en el contenedor
COPY . .

# Instala dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Configura permisos para el almacenamiento y los logs de Laravel
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage

# Expone el puerto en el que correrá la aplicación
EXPOSE 8000

# Comando para iniciar el servidor de Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
