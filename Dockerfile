# 1. Builder Stage
FROM php:8.3.20-fpm AS builder

RUN apt-get update \
  && apt-get install -y --no-install-recommends \
       curl \
       git \
       unzip \
       libzip-dev \
       libicu-dev \
       libonig-dev \
       libxml2-dev \
       libjpeg-dev \
       libpng-dev \
       libfreetype6-dev \
       libmagickwand-dev \
       libcurl4-openssl-dev \
       pkg-config \
       autoconf \
       build-essential \
  && docker-php-ext-configure intl \
  && docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install -j$(nproc) \
       pdo_mysql \
       mbstring \
       xml \
       zip \
       curl \
       bcmath \
       intl \
       gd \
  && pecl install redis \
  && docker-php-ext-enable redis \
  && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# 2. Runtime Stage
FROM php:8.3.20-fpm

RUN apt-get update \
  && apt-get install -y --no-install-recommends \
       libzip4 \
       libjpeg62-turbo \
       libpng16-16 \
       libfreetype6 \
  && rm -rf /var/lib/apt/lists/*

# Copy PHP extensions and configurations from builder
COPY --from=builder /usr/local/lib/php/extensions/ /usr/local/lib/php/extensions/
COPY --from=builder /usr/local/etc/php/conf.d/ /usr/local/etc/php/conf.d/
COPY --from=builder /usr/local/bin/composer /usr/local/bin/composer

# Set working directory and copy application
WORKDIR /var/www/html
COPY . .

# Set permissions for Laravel directories
RUN chown -R www-data:www-data storage bootstrap/cache \
  && chmod -R 775 storage bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]
