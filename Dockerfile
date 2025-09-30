FROM php:8.4-fpm as builder

RUN apt-get update && apt-get install -y \
        git \
        curl \
        libzip-dev \
        zlib1g-dev

RUN groupadd --gid 1000 dev
RUN useradd --uid 1000 --gid 1000 --create-home dev
RUN usermod -aG www-data dev

WORKDIR /var/www

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY entrypoint.sh /
RUN chmod +x /entrypoint.sh

ENTRYPOINT [ "bash", "/entrypoint.sh" ]