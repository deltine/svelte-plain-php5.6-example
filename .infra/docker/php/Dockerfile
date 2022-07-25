FROM php:5.6-apache
ENV TZ=Asia/Tokyo

COPY --from=composer:2.2.16 /usr/bin/composer /usr/bin/composer

RUN apt-get update  \
    && docker-php-ext-install pdo_mysql mysqli mbstring \
    && apt-get install -y git unzip \
    && curl -sSL https://github.com/mailhog/mhsendmail/releases/download/v0.2.0/mhsendmail_linux_amd64 -o mhsendmail \
    && chmod +x mhsendmail \
    && mv mhsendmail /usr/local/bin/mhsendmail \
    # home
    && mkdir -p /project/frontend/home/public \
    && rm -rf /var/www/html/example-home.jp \
    && ln -s /project/frontend/home/public /var/www/html/example-home.jp \
    # app
    && mkdir -p /project/frontend/app/public \
    && rm -rf /var/www/html/example-app.jp \
    && ln -s /project/frontend/app/public /var/www/html/example-app.jp \
    # php
    && mkdir -p /project/backend/php/public \
    && rm -rf /var/www/html/example-php.jp \
    && ln -s /project/backend/php/public /var/www/html/example-php.jp \
    # laravel
    && mkdir -p /project/backend/laravel/public \
    && rm -rf /var/www/html/example-laravel.jp \
    && ln -s /project/backend/laravel/public /var/www/html/example-laravel.jp \
    && chmod -R 777 /project/backend/laravel \
    # restart
    && a2enmod rewrite \
    && service apache2 restart
