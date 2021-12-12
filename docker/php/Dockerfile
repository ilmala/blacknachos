FROM php:7.4-fpm

WORKDIR /var/www/vhosts/blacknachos

RUN apt-get clean && apt-get update && apt-get upgrade -y && apt-get install -y  \
    git \
    libcurl4-openssl-dev \
    libonig-dev \
    libpng-dev \
    libicu-dev \
    libxml2-dev \
    libzip-dev \
    unzip \
    wget \
    zip

RUN docker-php-ext-configure intl

RUN docker-php-ext-install \
    bcmath \
    exif \
    gd \
    mbstring \
    mysqli \
    opcache \
    pdo_mysql \
    pcntl \
    xml \
    zip \
    intl

COPY --from=composer:2.1.3 /usr/bin/composer /usr/bin/composer