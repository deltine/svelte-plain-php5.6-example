# ローカル

php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php

COPY --from=composer:2.2.16 /usr/bin/composer /usr/bin/composer
composer create-project laravel/laravel . --prefer-dist "5.4"

composer create-project --prefer-dist laravel/laravel . 5.4


# サーバー

php7.4 -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php7.4 -d register_argc_argv=1 "/home/users/0/deltine/work/composer.phar" create-project laravel/laravel test.aaaa.com --prefer-dist


