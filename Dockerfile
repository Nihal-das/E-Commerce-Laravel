FROM php:8.2-apache

# Composer memory limit
ENV COMPOSER_MEMORY_LIMIT=-1

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    git \
    curl \
    libonig-dev \
    libxml2-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    default-mysql-client \
    npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql zip exif pcntl bcmath opcache gd tokenizer

# Enable Apache rewrite module
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy composer files first for caching
COPY composer.json composer.lock ./

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP dependencies
RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --no-dev --optimize-autoloader --no-interaction -vvv

# Copy rest of the application
COPY . .

# Set permissions before artisan runs
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Build frontend assets
RUN npm install && npm run build

# Expose Laravel port
EXPOSE 10000

# Start Laravel server
CMD ["php", "artisan", "serve", "--host", "0.0.0.0", "--port", "10000"]