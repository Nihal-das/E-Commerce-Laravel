# Use PHP 8.2 + Apache
FROM php:8.2-apache

# Prevent Composer memory errors
ENV COMPOSER_MEMORY_LIMIT=-1

# Install PHP dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    git \
    curl \
    libonig-dev \
    libxml2-dev \
    default-mysql-client \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath opcache

# Enable Apache rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy Laravel files only first (to use Docker cache for composer)
COPY composer.json composer.lock ./

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader

# Now copy the rest of the project
COPY . .

# Install Node and build Vue frontend
RUN apt-get install -y npm
RUN npm install
RUN npm run build

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port
EXPOSE 10000

# Start Laravel
CMD ["php", "artisan", "serve", "--host", "0.0.0.0", "--port", "10000"]
