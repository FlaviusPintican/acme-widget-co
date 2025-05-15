FROM php:8.4-fpm

# Update package list and install dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip

# Install PDO and other required PHP extensions
RUN docker-php-ext-install bcmath

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


# Update www-data's UID and GID
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

# Make sure global composer bin is in the PATH
ENV PATH="$PATH:/var/www/tools/composer/vendor/bin"

# Set working directory
WORKDIR /var/www/html

# Copy composer files and install dependencies
COPY composer.json composer.lock* ./
RUN composer install

# Copy the rest of the application
COPY . .

RUN chown -R www-data:www-data /var/www
USER www-data
