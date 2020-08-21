FROM php:7.3-fpm-alpine

RUN apk --update add \
    libzip-dev \
    alpine-sdk \
    openssl-dev \
    php7-pear \
    php7-dev \
    && rm -rf /var/cache/apk/*

RUN docker-php-ext-install mysqli pdo pdo_mysql bcmath pcntl zip

RUN pecl install xdebug-2.9.0 \
    && docker-php-ext-enable xdebug \
    && pecl clear-cache \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_autostart=on" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_port=9001" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_handler=dbgp" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_connect_back=0" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.idekey=PHPSTORM" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini


COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN composer global require friendsofphp/php-cs-fixer \
    && export PATH="$PATH:$HOME/.composer/vendor/bin"

ENV XDEBUG_CONFIG="remote_host=172.28.50.54"
EXPOSE 7171
WORKDIR /var/www/server
CMD php index.php