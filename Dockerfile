FROM php:8.2-apache

RUN a2enmod rewrite

RUN sed -i 's/80/8080/g' /etc/apache2/ports.conf \
 && sed -i 's/:80/:8080/g' /etc/apache2/sites-available/000-default.conf

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql zip mbstring bcmath

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data storage bootstrap/cache

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf



EXPOSE 8080

CMD ["apache2-foreground"]
