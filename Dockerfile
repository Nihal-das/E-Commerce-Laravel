# PHP 8.2 + Apache
FROM php:8.2-apache

ENV COMPOSER_MEMORY_LIMIT=-1

# Install PHP deps
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    git \
    curl \
    libonig-dev \
    libxml2-dev \
    default-mysql-client \
    && docker-php-ext-install pdo_mysql zip exif pcntl bcmath opcache

# Avoid double mbstring install
RUN docker-php-ext-enable mbstring

# Enable Apache rewrite
RUN a2enmod rewrite

WORKDIR /var/www/html

# Copy composer files only for caching
COPY composer.json composer.lock ./

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Run Composer in verbose mode
RUN composer install --no-dev --optimize-autoloader -vvv

# Copy rest of project
COPY . .

# Install Node + Vue build
RUN apt-get install -y npm
RUN npm install
RUN npm run build

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 10000
CMD ["php", "artisan", "serve", "--host", "0.0.0.0", "--port", "10000"]
