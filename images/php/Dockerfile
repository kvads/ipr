FROM php:8.0.2-fpm

RUN apt-get update && apt-get install -y \
        git \
        curl \
        zip \
        vim \
        unzip \
        && docker-php-ext-install iconv mysqli pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


ADD php.ini /usr/local/etc/php/conf.d/40-custom.ini

# The main purpose of a CMD is to provide defaults for an executing container. These defaults can include an executable,
# or they can omit the executable, in which case you must specify an ENTRYPOINT instruction as well.
CMD ["php-fpm"]