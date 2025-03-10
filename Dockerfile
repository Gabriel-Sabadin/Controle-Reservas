# Usando a imagem oficial PHP com Apache
FROM php:8.1-apache

# Instalar dependências para o Laravel (como extensões do PHP)
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    git \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql

# Habilitar mod_rewrite do Apache (importante para o Laravel)
RUN a2enmod rewrite

# Configurar o diretório de trabalho dentro do contêiner
WORKDIR /var/www/html

# Copiar o código da aplicação para o contêiner
COPY . /var/www/html

# Instalar as dependências do Laravel (via Composer)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader

# Configurar as permissões para o Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expor a porta 80 para o Apache
EXPOSE 80

# Iniciar o Apache em primeiro plano
CMD ["apache2-foreground"]
