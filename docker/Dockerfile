FROM php:8.4-cli

# Install required packages and extensions
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libxml2-dev \
    && docker-php-ext-install mbstring tokenizer xml dom ctype json

# Optional: Install Xdebug
# RUN pecl install xdebug && docker-php-ext-enable xdebug

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files and install dependencies
COPY composer.json composer.lock* ./
RUN composer install

# Copy the rest of the application
COPY . .
