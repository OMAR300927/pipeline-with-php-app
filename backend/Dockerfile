FROM php:8.2-apache

# تثبيت الامتدادات المطلوبة
RUN docker-php-ext-install mysqli pdo pdo_mysql

# نسخ مجلد vendor (المكتبات المثبتة مسبقًا) إذا موجود
COPY ./vendor/ /var/www/vendor/

# نسخ ملفات التطبيق
COPY ./public/ /var/www/html/
COPY ./src/ /var/www/src/
