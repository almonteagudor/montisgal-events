FROM php:8.2-fpm

ARG USER_NAME=user
ARG UID=1001
ARG GID=1001

ENV XDEBUG_CLIENT_HOST host.docker.internal
ENV XDEBUG_CLIENT_PORT 9003

COPY --from=composer:2.5.8 /usr/bin/composer /usr/bin/composer
COPY ./php.ini /usr/local/etc/php/php.ini
COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

RUN curl -sL https://deb.nodesource.com/setup_18.x | bash - \
                   && apt update && apt install -y  git nodejs zip libzip-dev libicu-dev libpq-dev \
                   && pecl install xdebug-3.2.1 \
                   && docker-php-ext-install intl pdo pdo_mysql pdo_pgsql zip \
                   && docker-php-ext-enable opcache xdebug

RUN groupadd -g $GID -o $USER_NAME && useradd -m -u $UID -g $GID -o -s /bin/bash $USER_NAME && chown $USER_NAME:$USER_NAME /var/www/html

USER $USER_NAME