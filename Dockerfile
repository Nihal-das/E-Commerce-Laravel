FROM php:8.2-apache-bookworm

ENV COMPOSER_MEMORY_LIMIT=-1
WORKDIR /var/www/html

# -----------------------------------
# System dependencies + PHP extensions
# -----------------------------------
RUN apt-get update && apt-get install -y \
    unzip git curl \
    libonig-dev libxml2-dev libzip-dev \
    libpng-dev libjpeg-dev libfreetype6-dev \
    default-mysql-client \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql zip exif pcntl bcmath opcache gd \
    && rm -rf /var/lib/apt/lists/*

# -----------------------------------
# Node.js 20
# -----------------------------------
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@latest \
    && rm -rf /var/lib/apt/lists/*

# -----------------------------------
# Apache config for Laravel
# -----------------------------------
RUN a2enmod rewrite \
    && sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf \
    && sed -i 's|/var/www/|/var/www/html/public|g' /etc/apache2/apache2.conf

# -----------------------------------
# Copy FULL app first (artisan must exist)
# -----------------------------------
COPY . .

# -----------------------------------
# Laravel ENV
# -----------------------------------
RUN cp .env.example .env || true

# -----------------------------------
# Composer
# -----------------------------------
RUN curl -sS https://getcomposer.org/installer | php \
    -- --install-dir=/usr/local/bin --filename=composer

# Disable scripts during install
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Safe to run artisan now
RUN php artisan key:generate --force \
    && php artisan package:discover --ansi

# -----------------------------------
# Permissions
# -----------------------------------
RUN mkdir -p storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# -----------------------------------
# Frontend build
# -----------------------------------
RUN npm install && npm run build

EXPOSE 80
CMD ["apache2-foreground"]
