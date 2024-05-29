# Use an official PHP image as the base image
FROM php:7.4-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libssl1.0.0 \
    libssl-dev \
    unzip \
    git \
    curl

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy existing application directory contents
COPY . .

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Optimize Laravel
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

# Expose port 8000 and start php-fpm server
EXPOSE 8000
CMD ["php-fpm"]
