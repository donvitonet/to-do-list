FROM php:8.2.7-fpm


# Install PHP extensions
RUN docker-php-ext-install pdo_mysql

# Set working directory
WORKDIR /var/www