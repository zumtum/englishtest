#!/bin/sh
set -e

if [ "${1#-}" != "$1" ]; then
	set -- php-fpm "$@"
fi

if [ "$1" = 'php-fpm' ] || [ "$1" = 'php' ]; then
	if [ "$APP_ENV" != 'production' ]; then
		composer install --prefer-dist --no-progress --no-suggest --no-interaction
		composer run-script post-root-package-install
		composer run-script post-create-project-cmd
	fi
fi

exec docker-php-entrypoint "$@"
