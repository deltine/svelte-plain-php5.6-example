php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php

COPY --from=composer:2.2.16 /usr/bin/composer /usr/bin/composer