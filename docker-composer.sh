#!/bin/bash

# Script untuk menjalankan composer commands dengan permission yang benar
# Usage: ./docker-composer.sh <composer-command>

if [ "$#" -eq 0 ]; then
    echo "Usage: ./docker-composer.sh <composer-command>"
    echo "Example: ./docker-composer.sh install"
    echo "Example: ./docker-composer.sh update"
    echo "Example: ./docker-composer.sh require <package>"
    exit 1
fi

# Menjalankan command di dalam container sebagai www-data user
docker compose exec -u www-data app composer "$@"
