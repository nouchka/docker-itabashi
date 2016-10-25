FROM php:7-apache
RUN apt-get update \
    && apt-get -y install imagemagick

RUN usermod -u 1000 www-data
RUN groupmod -g 1000 www-data
RUN usermod -s /bin/bash www-data
