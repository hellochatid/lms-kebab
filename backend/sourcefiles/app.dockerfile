FROM php:7.2-fpm
WORKDIR /var/www

# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive

# Install PostgreSQL Driver
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql \
    && docker-php-ext-enable pdo_pgsql

# Setting up app
COPY ./src /var/www
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
RUN chmod 777 -R /var/www/storage /var/www/bootstrap/cache
