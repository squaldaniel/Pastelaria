# Use uma imagem base do PHP
FROM php:8.1.0-fpm

# Instale as extensões necessárias do PHP
RUN docker-php-ext-install pdo pdo_mysql

# Defina o diretório de trabalho no contêiner
WORKDIR /var/www/html

# Copie o código da sua aplicação para o contêiner
COPY . .

# Instale as dependências usando o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install

# Exponha a porta do servidor web
EXPOSE 80

# Inicie o servidor web do PHP
CMD ["php", "-S", "localhost:80", "-t", "public"]
