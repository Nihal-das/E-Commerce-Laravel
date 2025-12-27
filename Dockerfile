FROM php:8.2-apache

ENV COMPOSER_MEMORY_LIMIT=-1
WORKDIR /var/www/html

# Step 1: Install PHP build deps
RUN apt-get update && apt-get install -y --no-install-recommends \
    build-essential \
    pkg-config \
    libssl-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    unzip git curl default-mysql-client \
    && docker-php-ext-configure gd --with-jpeg --with-freetype \
    && docker-php-ext-install pdo_mysql zip exif pcntl bcmath opcache gd tokenizer \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Step 2: Install Node.js 20 + npm
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@latest \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Step 3: Enable Apache rewrite
RUN a2enmod rewrite

# Step 4: Composer
COPY composer.json composer.lock ./
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --no-dev --optimize-autoloader --no-interaction

# Step 5: Copy app
COPY . .

# Step 6: Laravel permissions
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Step 7: Frontend
RUN npm install && npm run build

EXPOSE 80
CMD ["apache2-foreground"]
