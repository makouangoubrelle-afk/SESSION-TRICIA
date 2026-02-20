# 1. Utilise l'image PHP officielle avec Apache
FROM php:8.2-apache

# 2. Installation des dépendances système nécessaires
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    libzip-dev

# 3. Installation des extensions PHP indispensables pour Laravel et MySQL
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# 4. Activation du module Apache Rewrite pour gérer les URLs Laravel
RUN a2enmod rewrite

# 5. Configuration d'Apache pour pointer vers le dossier /public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 6. Installation de Composer (récupéré depuis l'image officielle)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 7. Copie des fichiers de ton projet dans le conteneur
COPY . /var/www/html

# 8. Installation des dépendances PHP (sans les outils de développement)
RUN composer install --no-interaction --optimize-autoloader --no-dev

# 9. Attribution des permissions (on ajoute le dossier cache de config)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 10. Exposition du port
EXPOSE 80

# 11. Commande de démarrage forcée
CMD ["apache2-foreground"]