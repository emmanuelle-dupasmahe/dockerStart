# 🚀 Projet Apache PHP avec Docker

Ce projet consiste à créer un serveur Apache via Docker pour afficher les informations PHP du serveur.

## 🛠️ Création de l'environnement
1. **Fichier index.php** : Utilisation de la fonction `phpinfo()`.
2. **Dockerfile** : Basé sur `php:apache`, exposant le port 80.

### L'environnement index.php et Dockerfile
![l'environnement](images/dockfile.png)

### Création de l'image (Build)
**Commande :**
```bash
docker build -t mon-apache-php .
```
![Build de l'image](images/build_apache.png)

### Lancement du conteneur (Port 9000)
**Commande :**
```bash
docker run -d -p 9000:80 --name apache-info mon-apache-php
```
### images
![images](images/dockerimageapache.png)

### Résultat dans le navigateur
![Page PHPInfo](images/phpversion.png)

### Arrêt du service
**Commande :**
```bash
docker stop apache-info
```
apache-info

![Stop conteneur](images/apache_stop.png)

![docker ps après stop](images/apachestopdockerps.png)


### redémarrer après stop

**Commande :**
```bash
docker start apache-info
```
apache-info

Car si on utilise run le conteneur existe déjà :

![run après stop](images/run_apres_stop.png)

si on veut utiliser run il faut enlever le conteneur :

```bash
docker rm apache-info
```
et après donc faire run

```bash
docker run -d -p 9000:80 --name apache-info mon-apache-php
```
docker.dekstop statut containers après run ou start :

![run ou start](images/apres_run_ou_start.png)

## 🔄 Différence entre RUN et START

| Commande | Action | État précédent | Résultat |
| :--- | :--- | :--- | :--- |
| `docker run` | **Crée** et démarre | N'existe pas encore | Nouveau conteneur |
| `docker start` | **Rallume** | Existe mais stoppé | Reprise du conteneur |

> **Note :** Si on tente un `run` sur un nom déjà pris, Docker renverra une erreur de conflit.

---

## 🪵 Consultation des Logs
Même quand le conteneur tourne en arrière-plan (mode `-d`), je peux surveiller ce qui se passe à l'intérieur d'Apache pour vérifier les connexions ou déboguer des erreurs PHP.

**Commande :**
```bash
docker logs apache-info
```


![logs](images/logs_apache.png)
---

## 📁 Utilisation des Volumes (Mode Développement)

Jusqu'ici, à chaque modification de mon fichier `index.php`, je devais supprimer mon conteneur et refaire un `docker build`. Pour optimiser mon flux de travail, j'ai mis en place un **volume**.

Le volume permet de créer un lien direct entre un dossier de mon ordinateur et un dossier à l'intérieur du conteneur.

**Commande pour lier mon dossier de travail :**
```bash
docker run -d -p 9001:80 -v "/$(pwd):/var/www/html" --name apache-dev php:apache
```

## ✅ Résultat
### ✅ Résultat et validation
Le volume est maintenant correctement lié. 

Si je modifie mon fichier `index.php` (par exemple, en ajoutant un titre `<h1>Test Volume Réussi</h1>`), le changement apparaît sur **http://localhost:9001** dès que je rafraîchis la page, **sans avoir besoin de recréer l'image !**

> **Preuve du succès :**

![index](images/indexphp.png)

![volume](images/volume.png)


---

## 🏁 Conclusion du Job04
Ce travail m'a permis de maîtriser les fondamentaux de Docker :
* **Dockerisation** d'une application PHP simple.
* Gestion du **cycle de vie** des conteneurs (run, stop, start, rm).
* Configuration des **ports** et des **réseaux**.
* Utilisation des **volumes** pour le développement agile.
* Débogage via les **logs** et résolution de conflits spécifiques à l'environnement Windows.
