FROM php:8.2-apache-bookworm

ENV COMPOSER_MEMORY_LIMIT=-1
WORKDIR /var/www/html

# -----------------------------
# System deps + PHP extensions
# -----------------------------
RUN apt-get update && apt-get install -y \
    unzip git curl \
    libonig-dev libxml2-dev libzip-dev \
    libpng-dev libjpeg-dev libfreetype6-dev \
    default-mysql-client \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        pdo_mysql \
        zip \
        exif \
        pcntl \
        bcmath \
        opcache \
        gd \
    && rm -rf /var/lib/apt/lists/*

# -----------------------------
# Apache → Laravel public/
# -----------------------------
RUN a2enmod rewrite \
 && echo "ServerName localhost" >> /etc/apache2/apache2.conf \
 && sed -i 's|/var/www/html|/var/www/html/public|g' \
    /etc/apache2/sites-available/000-default.conf \
    /etc/apache2/apache2.conf

# -----------------------------
# Copy app (NO .env handling)
# -----------------------------
COPY . .

# ❌ remove old cached config
RUN rm -f bootstrap/cache/*.php || true

# -----------------------------
# Composer (NO artisan here)
# -----------------------------
RUN curl -sS https://getcomposer.org/installer | php \
    -- --install-dir=/usr/local/bin --filename=composer

RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction \
    --no-scripts

# -----------------------------
# Permissions
# -----------------------------
RUN chown -R www-data:www-data storage bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache

# -----------------------------
# Symlink storage → public/storage
# -----------------------------
RUN php artisan storage:link || true \
 && chown -R www-data:www-data public/storage \
 && chmod -R 775 public/storage

# -----------------------------
# Frontend build
# -----------------------------
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
 && apt-get install -y nodejs \
 && npm install \
 && npm run build \
 && rm -rf /var/lib/apt/lists/*

EXPOSE 80
CMD ["apache2-foreground"]
