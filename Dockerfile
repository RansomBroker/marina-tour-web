FROM php:8.3-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libicu-dev \
    libgmp-dev \
    zip \
    unzip \
    sudo

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions including MySQLi and zip, intl, gmp
RUN docker-php-ext-install pdo_mysql mysqli mbstring exif pcntl bcmath gd zip intl gmp

# Copy custom PHP configuration for large file uploads
COPY php/uploads.ini /usr/local/etc/php/conf.d/uploads.ini

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Node.js & npm (LTS)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Create user with same UID/GID as host user
ARG USER_ID=1000
ARG GROUP_ID=1000

# Modify www-data user to match host user
RUN groupmod -o -g ${GROUP_ID} www-data && \
    usermod -o -u ${USER_ID} -g ${GROUP_ID} www-data

# Set working directory
WORKDIR /var/www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
