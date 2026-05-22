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

---

## 📝 Exercice 2 - BlogApp (`ex2-blogapp`)

### ❌ Problème initial
Lors du lancement de la stack avec `docker compose up`, Docker Compose refusait de démarrer et renvoyait une erreur indiquant qu'il ne trouvait pas le service défini dans les dépendances de l'application.
![avant correction](images/ex2-avant.png)


### 🔍 Explication technique
Dans la section `depends_on` du service `app`, il était indiqué que celui-ci dépendait d'un service nommé `database`. Cependant, plus bas dans le fichier `docker-compose.yml`, le service MySQL s'appelait en réalité `db`. En raison de cette incohérence de nommage, Docker Compose ne pouvait pas faire la liaison.

### ✅ Correction apportée
J'ai corrigé le nom du service attendu dans la section `depends_on` du service `app` pour qu'il corresponde exactement au nom déclaré pour le service de base de données (`db`).

**Avant correction :**
```yaml
    depends_on:
      - database
```

**Après correction :**
```yaml
    depends_on:
      - db
```

*La stack démarre désormais correctement sans erreur de dépendance !*
![après correction](images/ex2_apres.png)
![après correction](images/ex2_corrige.png)

---

## 🚀 Exercice 3 - ApiNode (`ex3-apinode`)

### ❌ Problème initial
Lors du lancement de la commande `docker compose up`, Docker Compose renvoyait une erreur de parsing (analyse) du fichier YAML et refusait de démarrer le projet.

### 🔍 Explication technique
Le format YAML est strictement basé sur l'indentation (les espaces en début de ligne). Dans le fichier `docker-compose.yml`, la directive `ports` comportait des espaces en trop et était mal alignée par rapport aux autres propriétés du service `api` (comme `image` ou `working_dir`). À cause de ce décalage, Docker Compose ne parvenait pas à lire correctement la structure hiérarchique du fichier.

### ✅ Correction apportée
J'ai supprimé les espaces excédentaires pour réaligner la section `ports` au même niveau que les autres configurations du service (soit un retrait de 4 espaces par rapport au bord gauche).

**Avant correction :**
```yaml
    working_dir: /app
      ports:
        - "3000:3000"
```
![avant correction](images/ex3_avant.png)


**Après correction :**
```yaml
    working_dir: /app
    ports:
      - "3000:3000"
```

*L'API Node.js démarre maintenant correctement, sans erreur de syntaxe !*
![apres correction](images/ex3_apres.png)
![apres correction](images/ex3_apres2.png)