# Gunakan image PHP + Apache
FROM php:8.2-apache

# Install ekstensi MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy semua file project ke /var/www/html
COPY . /var/www/html/

# Enable mod_rewrite (dipakai .htaccess)
RUN a2enmod rewrite

# Beri permission
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
