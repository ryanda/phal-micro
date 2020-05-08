FROM mileschou/phalcon:7.4-fpm-alpine

LABEL maintainer="ryanda <github.com/ryanda>"

WORKDIR /usr/src/app

RUN apk add --no-cache gcc musl-dev linux-headers
RUN docker-php-ext-install pdo pdo_mysql mysqli && \
    docker-php-ext-enable pdo pdo_mysql mysqli && \
    curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/bin --filename=composer
