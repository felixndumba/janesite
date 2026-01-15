# ===============================
# Laravel Production Dockerfile
# ===============================

FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libonig-dev \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring zip gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy Laravel files
COPY . .

# Install PHP dependencies
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction

# Create required Laravel directories
RUN mkdir -p \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    bootstrap/cache \
    /tmp/views

# Set permissions
RUN chown -R www-data:www-data storage bootstrap/cache /tmp \
    && chmod -R 775 storage bootstrap/cache /tmp

# Laravel environment (Render-compatible)
ENV APP_ENV=production \
    APP_DEBUG=false \
    LOG_CHANNEL=stderr \
    VIEW_COMPILED_PATH=/tmp/views

# Expose Render port
EXPOSE 8080

# Start Laravel
CMD php artisan serve --host=0.0.0.0 --port=8080
