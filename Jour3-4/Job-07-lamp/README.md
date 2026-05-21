# 🐳 Stack LAMP avec Docker Compose (Job 07)

Ce projet déploie une pile LAMP (Linux, Apache, MySQL, PHP) complète en utilisant Docker Compose.

## 🚀 Démarrer le projet

Pour lancer l'ensemble des services en arrière-plan, exécutez la commande suivante à la racine du projet :
```bash
docker compose up -d
```

Vérifiez que tous les conteneurs tournent correctement avec :
```bash
docker compose ps
```

## 🌐 Accès aux services

- **Serveur Web PHP** : [http://localhost:8081](http://localhost:8081) (Affiche le `phpinfo` et un test de connexion PDO)
- **Serveur MySQL** : Tourne sur le port interne 3306 (Le hostname interne est `db`)
- **Interface phpMyAdmin** : http://localhost:8082

## 🔐 Identifiants de la Base de Données

Pour vous connecter via phpMyAdmin :
- **Serveur** : `db` (déjà préconfiguré)
- **Utilisateur root** : `root` / Mot de passe : `rootpassword`
- **Utilisateur développeur** : `dev` / Mot de passe : `devpassword`
- **Base de données créée** : `lamp_demo`

![connexionbdd](images/connexionbdd.png)


## 🛠️ Commandes utiles (Étapes guidées)

**Vérifier la création de la base de données depuis l'intérieur du conteneur db :**
```bash
docker compose exec db mysql -u root -prootpassword -e "SHOW DATABASES;"

![Show database](images/persistanceshowbase.png)
```


## 💾 Persistance des données

**La table est-elle toujours là si je redémarre l'environnement ?**

**OUI.** La persistance des données est assurée par la déclaration du volume nommé `db_data` dans le fichier `docker-compose.yml` :
```yaml
    volumes:
      - db_data:/var/lib/mysql
```
Lorsque vous faites `docker compose down`, le conteneur est supprimé, mais **le volume `db_data` est conservé** sur votre machine locale. En relançant `docker compose up -d`, le nouveau conteneur MySQL récupérera automatiquement les anciennes données stockées dans ce volume, y compris la table que vous auriez créée depuis phpMyAdmin.

![Persistance des données](images/persistance.png)