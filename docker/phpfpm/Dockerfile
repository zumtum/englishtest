#FROM composer AS composer

FROM php:7.2-fpm

WORKDIR /var/www/html

#COPY --from=composer /usr/bin/composer /usr/local/bin/composer

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
# && curl -sS https://getcomposer.org/installer \
#  | php -- --install-dir=/usr/local/bin --filename=composer

COPY entrypoint.sh /var/
RUN chmod 777 /var/entrypoint.sh
ENTRYPOINT ["/var/entrypoint.sh"]
CMD ["docker-php-entrypoint", "php-fpm"]

#COPY composer.* ./
#RUN /usr/local/bin/composer global require hirak/prestissimo --no-plugins --no-scripts
#
#RUN /usr/local/bin/composer install --no-scripts --no-autoloader

#COPY . ./
#
#RUN /usr/local/bin/composer install --optimize-autoloader && bin/console assets:install
