FROM php:7.3-apache
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install pdo_mysql

RUN apt-get update && \
apt-get install -y \
zlib1g-dev libzip-dev unzip git

RUN docker-php-ext-install zip
