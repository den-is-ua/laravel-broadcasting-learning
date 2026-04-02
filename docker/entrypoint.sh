#!/bin/sh
set -e

if [ ! -f database/database.sqlite ]; then
    touch database/database.sqlite
fi

if [ ! -d vendor ]; then
    composer install --no-interaction --prefer-dist
fi

exec docker-php-entrypoint "$@"
