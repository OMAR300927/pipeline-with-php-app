FROM php:8.2-apache

# تثبيت امتدادات MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# نسخ ملفات Composer
COPY composer.json composer.lock /var/www/html/

# تثبيت المكتبات
RUN apt-get update && apt-get install -y unzip git \
    && docker-php-ext-install mysqli pdo pdo_mysql \
    && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-dev --optimize-autoloader \
    && rm -rf /var/lib/apt/lists/*

COPY . /var/www/html/
