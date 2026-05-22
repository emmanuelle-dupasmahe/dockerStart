# 🛠️ Corrections des Exercices Docker

Ce document recense les problèmes rencontrés dans les différents exercices d'application du dossier `Exercices` et détaille les corrections apportées pour les rendre fonctionnels.

---

## 🌐 Exercice 1 - WebStatic (`ex1-webstatic`)

### ❌ Problème initial
Lors du lancement de la stack avec la commande `docker compose up`, le conteneur démarrait sans remonter d'erreur dans le terminal. Cependant, le site restait totalement injoignable via le navigateur à l'adresse `http://localhost:8080`.

### 🔍 Explication technique
L'image utilisée pour ce service est `nginx:alpine`. Par défaut, un serveur Nginx écoute les requêtes HTTP sur le port **80** à l'intérieur du conteneur. 
Le fichier `docker-compose.yml` d'origine tentait de relier le port 8080 de la machine hôte au port `8081` du conteneur, port sur lequel Nginx n'écoutait pas, d'où l'impossibilité d'afficher la page.

### ✅ Correction apportée
Dans le fichier `docker-compose.yml`, j'ai corrigé la section `ports` pour faire pointer le port local `8080` vers le port `80` du conteneur.

**Avant correction :**
```yaml
    ports:
      - "8080:8081"
```

**Après correction :**
```yaml
    ports:
      - "8080:80"
```

*Le site est désormais correctement accessible sur http://localhost:8080.*

![après correction](images/exo1corrige.png)