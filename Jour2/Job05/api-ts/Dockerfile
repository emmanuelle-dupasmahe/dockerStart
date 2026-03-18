# --- ÉTAPE 1 : BUILDER ---

FROM node:20-alpine AS builder

WORKDIR /app

COPY package*.json ./
COPY tsconfig.json ./


RUN npm install

# Copie du code source (dossier src)
COPY src ./src


RUN npm run build


# --- ÉTAPE 2 : PRODUCTION ---

FROM node:20-alpine AS prod

ENV NODE_ENV=production
WORKDIR /app


COPY --from=builder /app/package*.json ./


RUN npm install --only=production


COPY --from=builder /app/dist ./dist

EXPOSE 3000

CMD ["node", "dist/index.js"]