FROM php:8.2-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql

# انسخ ملفات Composer
COPY composer.json composer.lock /var/www/

WORKDIR /var/www/

# تثبيت مكتبات Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-dev --optimize-autoloader

# انسخ باقي التطبيق
COPY ./public/ /var/www/html/
COPY ./src/ /var/www/src/
