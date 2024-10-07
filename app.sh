#!/bin/sh

#mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

docker-php-ext-install mysqli pdo pdo_mysql #&& a2enmod rewrite

apache2-foreground
