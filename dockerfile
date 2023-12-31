# Utiliser l'image de base PHP avec Apache
FROM php:8.2-apache

# Installer Git, zip et les extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copier les fichiers de votre projet dans le conteneur
COPY . /var/www/html

# Changer le DocumentRoot d'Apache
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Copier les fichiers de configuration Apache, si nécessaire
COPY apache-config.conf /etc/apache2/conf-available/
RUN a2enconf apache-config
RUN cat /etc/apache2/sites-available/000-default.conf
# Ajuster les permissions des fichiers
RUN chown -R www-data:www-data /var/www/html

# Supprimer le dossier vendor s'il existe déjà
RUN rm -rf /var/www/html/vendor

# Définir le répertoire de travail
WORKDIR /var/www/html

# Installer les dépendances Composer
RUN composer install

# Exposer le port 80
EXPOSE 80
