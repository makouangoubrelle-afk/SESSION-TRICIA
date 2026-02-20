#!/usr/bin/env bash
# Arrêter le script en cas d'erreur
set -o errexit

# Installation des dépendances PHP
composer install --no-dev --optimize-autoloader

# Nettoyage et optimisation de Laravel pour la production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Exécuter les migrations de la base de données
# Le flag --force est obligatoire en production
php artisan migrate --force