#!/bin/bash

# Script untuk menjalankan npm commands dengan permission yang benar
# Usage: ./docker-npm.sh <npm-command>
# Example: ./docker-npm.sh install
# Example: ./docker-npm.sh run dev
# Example: ./docker-npm.sh run build

if [ "$#" -eq 0 ]; then
    echo "Usage: ./docker-npm.sh <npm-command>"
    echo "Example: ./docker-npm.sh install"
    echo "Example: ./docker-npm.sh run dev"
    echo "Example: ./docker-npm.sh run build"
    exit 1
fi

# Menjalankan command di dalam container sebagai www-data user
docker compose exec -u www-data app npm "$@"
