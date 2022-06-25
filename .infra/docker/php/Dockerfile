FROM php:5.6-apache
ENV TZ=Asia/Tokyo
RUN apt-get update  \
    && docker-php-ext-install pdo_mysql mysqli mbstring

RUN curl -sSL https://github.com/mailhog/mhsendmail/releases/download/v0.2.0/mhsendmail_linux_amd64 -o mhsendmail \
    && chmod +x mhsendmail \
    && mv mhsendmail /usr/local/bin/mhsendmail
