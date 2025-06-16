FROM php:8.2-fpm

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
    curl

# Instala extensiones PHP necesarias para Laravel
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establece el directorio de trabajo
WORKDIR /var/www/html

# ❌ No copies el código aquí — lo estás montando como volumen en docker-compose.yml

# ❌ No manejes permisos dentro del Dockerfile — mejor hazlo desde tu host con `chown` si es necesario

# No exponemos puertos — Nginx es quien recibe las peticiones
CMD ["php-fpm"]
