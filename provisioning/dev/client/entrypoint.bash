#!/bin/bash

echo "Lancement de webpack"
cd /var/www/html/project/ezplatform
yarn install
exec "$@"
