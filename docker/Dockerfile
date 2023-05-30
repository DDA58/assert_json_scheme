FROM php:8.0-cli

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN apt-get -y update \
    && apt-get -y install \
      git \
      libzip-dev \
      zip \
      unzip \
    && docker-php-ext-install zip \
    && pecl install xdebug


WORKDIR application

CMD ["echo", "1"]