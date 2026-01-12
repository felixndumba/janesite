# Use official PHP image
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
    && docker-php-ext-install pdo_mysql zip mbstring

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy project files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# ✅ Create required Laravel directories
RUN mkdir -p storage/framework/{cache,sessions,views} \
    && mkdir -p bootstrap/cache \
    && mkdir -p /tmp/views

# ✅ Set correct permissions
RUN chown -R www-data:www-data storage bootstrap/cache /tmp \
    && chmod -R 775 storage bootstrap/cache /tmp

# ✅ Cloud Run environment variables
ENV APP_ENV=production \
    APP_DEBUG=false \
    LOG_CHANNEL=stderr \
    VIEW_COMPILED_PATH=/tmp/views

# Expose Cloud Run port
EXPOSE 8080

# ✅ Start Laravel correctly for Cloud Run
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
