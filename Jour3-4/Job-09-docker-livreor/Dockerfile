# Image de base : PHP 8.2 avec Apache
FROM php:8.2-apache

# Activation du module rewrite pour Apache (utile si tu as un .htaccess)
RUN a2enmod rewrite

# Installation de l'extension PDO MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Dossier de travail par défaut
WORKDIR /var/www/html