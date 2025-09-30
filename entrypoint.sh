#!/usr/bin/env bash
set -e

mkdir -p ./geoip/ && \
    curl -fL -o ./geoip/GeoLite2-City.mmdb https://git.io/GeoLite2-City.mmdb

composer install --no-interaction --no-scripts
docker-php-entrypoint php-fpm