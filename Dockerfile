FROM php:8.1-apache

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN a2enmod rewrite
RUN docker-php-ext-install pdo pdo_mysql
RUN apt-get update \
    && apt-get install -y libzip-dev \
    && apt-get install -y zlib1g-dev \
    && docker-php-ext-install zip \
    && docker-php-ext-install mysqli \
    apt-get install -y --no-install-recommends \
        curl \
        libmemcached-dev \
        libz-dev \
        libpq-dev \
        libjpeg-dev \
        libpng-dev \
        libfreetype6-dev \
        libssl-dev \
        libwebp-dev \
        libxpm-dev \
        libmcrypt-dev \
        libonig-dev; \
    rm -rf /var/lib/apt/lists/*
# Defina o diretório de trabalho no contêiner
WORKDIR /var/www/html/public/

# Copie o código da aplicação para o contêiner
COPY ./www .

# Instale as dependências usando o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install

EXPOSE 80

# Configure o Apache para usar o public como DocumentRoot
RUN sed -i 's/DocumentRoot \/var\/www\/html/DocumentRoot \/var\/www\/html\/public/' /etc/apache2/sites-available/000-default.conf
RUN sed -i 's/DocumentRoot \/var\/www\/html/DocumentRoot \/var\/www\/html\/public/' /etc/apache2/sites-enabled/000-default.conf