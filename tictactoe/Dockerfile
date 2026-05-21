# Image de base : PHP 8.2 + Apache préconfigurés
FROM php:8.2-apache
# Copier la page du jeu dans le dossier servi par Apache
COPY index.html /var/www/html/
# Copier save.php et results.json au même endroit
# (ce sera le futur point de montage du volume)
COPY save.php /var/www/html/
COPY results.json /var/www/html/
# Apache tourne sous l'utilisateur www-data, qui doit
# pouvoir écrire dans results.json
RUN chown www-data:www-data /var/www/html/results.json
# Le conteneur écoute sur le port 80 en interne
EXPOSE 80