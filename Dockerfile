FROM php:8.2-apache-bookworm

ENV COMPOSER_MEMORY_LIMIT=-1
WORKDIR /var/www/html

# System deps + PHP extensions (BOOKWORM = stable)
RUN apt-get update && apt-get install -y \
    unzip git curl \
    libonig-dev libxml2-dev libzip-dev \
    libpng-dev libjpeg-dev libfreetype6-dev \
    default-mysql-client \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql zip exif pcntl bcmath opcache gd \
    && rm -rf /var/lib/apt/lists/*

# Node.js 20 (safe)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@latest \
    && rm -rf /var/lib/apt/lists/*

# Apache
RUN a2enmod rewrite

# Composer
COPY composer.json composer.lock ./
RUN curl -sS https://getcomposer.org/installer | php \
    -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader --no-interaction

# App
COPY . .

# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Frontend
RUN npm install && npm run build

EXPOSE 80
CMD ["apache2-foreground"]
