# syntax=docker/dockerfile:1
FROM php:8.1-cli-bullseye

ENV DEBIAN_FRONTEND=noninteractive
ARG LANG=C.UTF-8
ENV LANG=${LANG}
ENV LC_ALL=${LANG}
ARG TZ=Asia/Tokyo
ENV TZ=${TZ}

RUN ln -snf /usr/share/zoneinfo/${TZ} /etc/localtime \
    && echo ${TZ} > /etc/timezone \
    && cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini

COPY --from=composer /usr/bin/composer /usr/local/bin/composer
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/install-php-extensions

RUN install-php-extensions opcache pdo pdo_mysql pcov
