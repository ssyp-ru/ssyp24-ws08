FROM php:8.1-fpm-alpine

ARG UID
WORKDIR "/var/www/html"

RUN apk update && apk add --no-cache autoconf g++ make \
    && pecl install xdebug-3.1.6 \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable xdebug

RUN apk add --no-cache \
git openssh coreutils sudo mc bash ncurses busybox-extras less mysql-client \
libxml2 libxslt libxml2-dev libxslt-dev imap-dev icu-dev freetype-dev \
libjpeg-turbo-dev libpng-dev libzip-dev autoconf gcc libc-dev make \
nodejs npm yarn


RUN docker-php-ext-install pdo_mysql xsl calendar imap intl zip gd

ENV PHP_INI_DIR /usr/local/etc/php
#RUN pecl install xdebug-2.8.1 \
#    && docker-php-ext-enable xdebug

# Composer
RUN EXPECTED_CHECKSUM="$(php -r 'copy("https://composer.github.io/installer.sig", "php://stdout");')" && \
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
ACTUAL_CHECKSUM="$(php -r "echo hash_file('sha384', 'composer-setup.php');")" && \
if [ "$EXPECTED_CHECKSUM" != "$ACTUAL_CHECKSUM" ]; then >&2 echo 'ERROR: Invalid installer checksum'; rm composer-setup.php; exit 1; fi && \
php composer-setup.php --install-dir=/usr/bin/ --filename=composer --quiet && \
rm composer-setup.php

# Add user with superuser privileges
#ENV USER appuser
#RUN adduser --disabled-password -u $UID $USER \
#        && echo "$USER ALL=(ALL) NOPASSWD: ALL" > /etc/sudoers.d/$USER \
#        && chmod 0440 /etc/sudoers.d/$USER
#USER appuser
