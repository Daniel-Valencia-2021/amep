# Usa una imagen base de PHP con Apache
FROM php:8.1-apache

# Instalar extensiones de PHP necesarias para Laravel
RUN docker-php-ext-install pdo pdo_mysql

# Copiar los archivos de la aplicación
COPY . /var/www/html

# Configurar el directorio de trabajo
WORKDIR /var/www/html

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instalar las dependencias de Composer
RUN composer install --no-dev --optimize-autoloader

# Instalar NPM y compilar assets
RUN apt-get update && apt-get install -y nodejs npm
RUN npm install && npm run build

# Configurar permisos correctos
RUN chown -R www-data:www-data /var/www/html

# Exponer el puerto 80
EXPOSE 80

# Comando para iniciar Apache
CMD ["apache2-foreground"]
