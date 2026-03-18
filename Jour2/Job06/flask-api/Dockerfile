# Image Python légère (slim = sans outils inutiles, contrairement à alpine qui pose des pb)
FROM python:3.11-slim

# Métadonnées de l'image
LABEL maintainer="ton.email@example.com"

# PYTHONDONTWRITEBYTECODE : évite la création de fichiers .pyc (bytecode inutile en conteneur)
ENV PYTHONDONTWRITEBYTECODE=1
# PYTHONUNBUFFERED : affiche les logs Python en temps réel (pas de tampon)
ENV PYTHONUNBUFFERED=1

# Dossier de travail dans le conteneur
WORKDIR /app

# On copie SEULEMENT requirements.txt en premier → Docker met en cache cette couche
# Si le code change mais pas les dépendances, pip ne se relance pas (build plus rapide)
COPY requirements.txt .
RUN pip install --no-cache-dir -r requirements.txt

# On copie ensuite tout le code source
COPY . .

# Indique que l'application écoute sur le port 5000 (documentation)
EXPOSE 5000

# Commande de démarrage avec le serveur de développement Flask
CMD ["python", "run.py"]