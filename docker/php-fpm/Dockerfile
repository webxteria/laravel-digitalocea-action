FROM php:8.1-fpm-alpine

RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

RUN apk update && apk add freetype-dev libpng libpng-dev libjpeg-turbo-dev libwebp-dev zlib-dev libxpm-dev libzip-dev
RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/
RUN docker-php-ext-install gd pdo_mysql bcmath zip
RUN docker-php-ext-enable opcache 


COPY php.ini /usr/local/etc/php/conf.d/php.ini

