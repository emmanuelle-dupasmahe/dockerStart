# Image Python légère (slim = sans outils inutiles, contrairement à alpine qui pose des pb)
FROM python:3.11-slim

LABEL maintainer="ton.email@example.com"

ENV PYTHONDONTWRITEBYTECODE=1
ENV PYTHONUNBUFFERED=1

# Dossier de travail dans le conteneur
WORKDIR /app


COPY requirements.txt .
RUN pip install --no-cache-dir -r requirements.txt

# On copie ensuite tout le code source
COPY . .


EXPOSE 5000

# Commande de démarrage avec le serveur de développement Flask
CMD ["python", "run.py"]