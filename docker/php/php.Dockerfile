
FROM php:8.1.3-fpm

WORKDIR /var/www

RUN apt-get update && apt-get -f -y install unzip wget

RUN apt-get update && apt-get install -y \
   build-essential \
   libpng-dev \
   libjpeg62-turbo-dev \
   libfreetype6-dev \
   libzip-dev \
   locales \
   zip \
   vim \
   unzip \
   git \
   curl
   
RUN apt-get update && apt-get install -y \
   libmcrypt-dev \
   freetds-bin \
   freetds-dev \
   freetds-common \
   libxml2-dev \ 
   libxslt-dev \
   libaio1 \
   libmcrypt-dev \
   libreadline-dev

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install \
   pdo_mysql \
   gd \
   zip \
   calendar \
   exif \
   gettext \
   pcntl mysqli \
   shmop \
   soap bcmath \
   sockets \
   sysvmsg \
   sysvsem \
   sysvshm \
   xsl \
   opcache

RUN pecl install mongodb

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ADD . /var/www

RUN chown -R www-data:www-data /var/www
