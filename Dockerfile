FROM php:8.2-apache

# Enable Apache rewrite
RUN a2enmod rewrite

# Force Apache to listen on 8080 (Cloud Run requirement)
RUN sed -i 's/80/8080/g' /etc/apache2/ports.conf \
 && sed -i 's/:80/:8080/g' /etc/apache2/sites-available/000-default.conf

# Install PHP extensions
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql zip mbstring bcmath

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# App directory
WORKDIR /var/www/html

# Copy Laravel app
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Permissions (CRITICAL)
RUN chown -R www-data:www-data storage bootstrap/cache

# Set Apache public folder
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf

# Clear Laravel cache (VERY IMPORTANT)
RUN php artisan config:clear && php artisan cache:clear

# Expose Cloud Run port
EXPOSE 8080

# Start Apache (DO NOT CHANGE)
CMD ["apache2-foreground"]
