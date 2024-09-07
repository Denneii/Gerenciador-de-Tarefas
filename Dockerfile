# Dockerfile para Laravel com PHP 8.2 e PostgreSQL

# Use a imagem oficial do PHP 8.2 com Apache
FROM php:8.2-cli

# Defina o diretório de trabalho
WORKDIR /var/www/html

# Instale as dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    libzip-dev \
    unzip \
    libpq-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_pgsql

# Instale o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copie os arquivos para o diretório de trabalho no contêiner
COPY . /var/www/html

# Instale as dependências do Laravel
RUN composer install

# Ajuste permissões de pasta para o Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expor a porta 8000 para o PHP Artisan Serve
EXPOSE 8000

# Comando para iniciar o servidor PHP embutido do Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
