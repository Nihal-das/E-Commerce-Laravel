# ---------- Base Image ----------
FROM php:8.2-apache

ENV COMPOSER_MEMORY_LIMIT=-1
WORKDIR /var/www/html

# ---------- 1. Install PHP extensions & system deps safely ----------
RUN apt-get update && apt-get install -y --no-install-recommends \
    unzip git curl pkg-config libssl-dev default-mysql-client \
    libonig-dev libxml2-dev libzip-dev \
    libpng-dev libjpeg62-turbo-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-jpeg --with-freetype \
    && docker-php-ext-install pdo_mysql zip exif pcntl bcmath opcache gd tokenizer \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# ---------- 2. Install Node.js 20 + npm safely ----------
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@latest \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# ---------- 3. Enable Apache rewrite ----------
RUN a2enmod rewrite

# ---------- 4. Install Composer ----------
COPY composer.json composer.lock ./
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --no-dev --optimize-autoloader --no-interaction

# ---------- 5. Copy App ----------
COPY . .

# ---------- 6. Fix Permissions ----------
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# ---------- 7. Frontend Build ----------
RUN npm install && npm run build

# ---------- 8. Expose Port ----------
EXPOSE 80

# ---------- 9. Start Apache ----------
CMD ["apache2-foreground"]
