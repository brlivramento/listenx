#!/bin/sh
set -eu

# Permite comandos manuais, por exemplo:
# docker compose run --rm app php artisan route:list
if [ "$#" -gt 0 ] && [ "$1" != "apache2-foreground" ]; then
  exec "$@"
fi

if [ ! -f .env ] && [ -f .env.example ]; then
  echo "Criando .env a partir de .env.example..."
  cp .env.example .env
  chown --reference=.env.example .env
fi

mkdir -p \
  bootstrap/cache \
  storage/framework/cache \
  storage/framework/sessions \
  storage/framework/views \
  vendor

chown -R www-data:www-data bootstrap/cache storage vendor
chmod -R ug+rwX bootstrap/cache storage vendor

if [ ! -f vendor/autoload.php ]; then
  echo "Instalando dependências do Composer..."
  composer install --no-interaction --prefer-dist --optimize-autoloader
fi

exec "$@"