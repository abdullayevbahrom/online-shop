FROM php:8.1-apache

RUN rm /etc/localtime && ln -s /usr/share/zoneinfo/Asia/Tashkent /etc/localtime
RUN apt-get update && apt-get install -y \
    curl \
    libpq-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    cron \
    git \
    libzip-dev \
    zip \
    unzip \
    libwebp-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libicu-dev \
    && docker-php-ext-configure gd \
            --with-webp \
            --with-jpeg \
            --with-freetype \
    && docker-php-ext-configure intl \
	&& docker-php-ext-install \
	     zip \
	     bcmath \
	     gd \
	     mysqli \
	     pdo_mysql \
	     mbstring \
	     exif \
	     pcntl \
	     intl \
	     pdo_pgsql \
	     soap \
	&& curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apt-get clean && rm -rf /var/lib/apt/lists/*
RUN a2enmod rewrite
COPY ./apache2.conf  /etc/apache2/

WORKDIR /var/www/html
