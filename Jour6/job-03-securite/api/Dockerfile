FROM node:20-alpine
WORKDIR /app

# Créer un utilisateur non-root
RUN addgroup -S appgroup && adduser -S appuser -G appgroup

# Attribuer les droits du dossier de travail au nouvel utilisateur
RUN chown -R appuser:appgroup /app

# Basculer sur l'utilisateur
USER appuser

# Installer les dépendances (avec l'option actualisée)
COPY --chown=appuser:appgroup package*.json ./
RUN npm ci --omit=dev

# Copier le code
COPY --chown=appuser:appgroup src/ ./src/

EXPOSE 3000

# Healthcheck
HEALTHCHECK --interval=30s --timeout=3s \
  CMD wget -qO- http://localhost:3000/health || exit 1

CMD ["node", "src/server.js"]