FROM php:7.2.6-apache
# RUN apt-get update -y && apt-get upgrade -y && apt-get install -y
RUN chmod -R 775 /var/www/html \
    && docker-php-ext-install mysqli 
# RUN docker-php-ext-enable mysqli