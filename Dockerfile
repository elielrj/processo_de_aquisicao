FROM php:7.4.30-apache

WORKDIR /var/www/html

COPY . /var/www/html

RUN docker-php-ext-install mysqli pdo pdo_mysql && a2enmod rewrite

#EXPOSE 80:80

#CMD ["apache2-foreground"]

