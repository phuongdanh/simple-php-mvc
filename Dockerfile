FROM php:8.0-apache
#Install package
RUN apt-get update && apt-get install -y \
    git \
    zip \
    curl \
    sudo \
    unzip \
    libzip-dev \
    libicu-dev \
    libbz2-dev \
    libpng-dev \
    libjpeg-dev \
    libmcrypt-dev \
    libreadline-dev \
    libfreetype6-dev \
    g++
RUN docker-php-ext-install pdo pdo_mysql mysqli
RUN a2enmod rewrite
#Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --install-dir=. --filename=composer
RUN mv composer /usr/local/bin/

# Set working directory
WORKDIR /var/www/html

# Create vendor directory and set permissions
RUN mkdir -p /var/www/html/vendor && chown -R www-data:www-data /var/www/html

# Copy composer files first
COPY --chown=www-data:www-data composer.json composer.lock ./

# Install dependencies
RUN composer install --no-scripts --no-autoloader

# Copy the rest of the application
COPY --chown=www-data:www-data . .

# Generate autoload files
RUN composer dump-autoload --optimize

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# start laravel-serve
EXPOSE 80