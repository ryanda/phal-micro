FROM mileschou/phalcon:7.4-fpm-alpine

LABEL maintainer="ryanda <github.com/ryanda>"

WORKDIR /usr/src/app

RUN apk add --no-cache gcc musl-dev linux-headers pcre-dev ${PHPIZE_DEPS} && \
    docker-php-ext-install pdo_mysql mysqli && \
    pecl channel-update pecl.php.net && pecl install msgpack redis && \
    apk del pcre-dev ${PHPIZE_DEPS} && \
    docker-php-ext-enable msgpack redis && \
    curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/bin --filename=composer
