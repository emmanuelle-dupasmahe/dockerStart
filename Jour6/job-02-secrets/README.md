Il fallait faire attention au saut de lignes dans les fichiers crées avec echo db_password.txt db_user.txt et mysql_root.txt et après il fallait ajouter dans docker-compose.yml le healthcheck :  # Ajout du healthcheck pour vérifier que MySQL écoute bien
    healthcheck:
      test: ["CMD", "mysqladmin", "ping", "-h", "localhost"]
      interval: 10s
      timeout: 5s
      retries: 5

      Après on voit que les droits sont les suivants drwxr-xr-x 2 root root 4096 Jun  9 12:27 .
drwxr-xr-x 1 root root 4096 Jun  9 12:27 ..
-rwxrwxrwx 1 root root   14 Jun  9 11:53 db_password
-rwxrwxrwx 1 root root    9 Jun  9 11:53 db_user   

donc pour le db_password on peut lire ecrire et executer donc on obtient le passwordword : //run/secrets/db_password'
hack
//run/secrets/db_password: 1: monpassword123: not found