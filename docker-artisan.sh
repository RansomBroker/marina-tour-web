#!/bin/bash

# Script untuk menjalankan artisan commands dengan permission yang benar
# Usage: ./docker-artisan.sh <artisan-command>

if [ "$#" -eq 0 ]; then
    echo "Usage: ./docker-artisan.sh <artisan-command>"
    echo "Example: ./docker-artisan.sh migrate"
    echo "Example: ./docker-artisan.sh key:generate"
    echo "Example: ./docker-artisan.sh tinker"
    exit 1
fi

# Menjalankan command di dalam container sebagai www-data user
docker compose exec -u www-data app php artisan "$@"
