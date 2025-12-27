# Start with PHP 8.2 + Apache
FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y libzip-dev unzip git curl npm \
    && docker-php-ext-install pdo_mysql zip

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader

# Install Node and build Vue assets
RUN npm install
RUN npm run build

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port for Render
EXPOSE 10000

# Start Laravel
CMD ["php", "artisan", "serve", "--host", "0.0.0.0", "--port", "10000"]
