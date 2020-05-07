FROM php:7.2-fpm

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
        libxml2-dev \
        nano libssl-dev libcurl4-openssl-dev pkg-config \
    && docker-php-ext-install -j$(nproc) mysqli mbstring pdo pdo_mysql soap curl zip \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Cleanup dev dependencies
#RUN apk del -f .build-deps

ENV COMPOSER_ALLOW_SUPERUSER=1

WORKDIR /var/www/html

# prevent the reinstallation of vendors at every changes in the source code
COPY composer.* ./

RUN set -eux; \
	composer install --prefer-dist --no-dev --no-autoloader --no-scripts --no-progress --no-suggest; \
	composer clear-cache

COPY . .
RUN composer dump-autoload --classmap-authoritative; \
	composer run-script --no-dev post-install-cmd; sync

COPY docker/phpfpm/docker-entrypoint.sh /usr/local/bin/docker-entrypoint
RUN chmod +x /usr/local/bin/docker-entrypoint

COPY docker/phpfpm/xdebug.ini /usr/local/etc/php/conf.d/

ENTRYPOINT ["docker-entrypoint"]

CMD ["php-fpm"]
