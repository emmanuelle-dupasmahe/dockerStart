<?php
// Le Modèle pour interagir avec la table 'commentaires'

class CommentModel
{
    private $bdd;

    public function __construct()
    {
        // --- CONNEXION À LA BASE DE DONNÉES ---

        $host = getenv('DB_HOST') ?: 'localhost';
        $dbname = getenv('DB_NAME') ?: 'livreor';
        $username = getenv('DB_USER') ?: 'root';
        $password = getenv('DB_PASSWORD') ?: '';
        try {

            $this->bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            die('Erreur de connexion à la base de données : ' . $e->getMessage());
        }
    }

    /**
     * Insère un nouveau commentaire dans la base de données.
     */
    public function addComment($commentaire_text, $id_utilisateur)
    {
        // La date est gérée directement dans la requête SQL ou par PHP (ici par PHP)
        $date = date("Y-m-d H:i:s");

        $requete = $this->bdd->prepare(
            "INSERT INTO commentaires (commentaire, id_utilisateur, date) 
             VALUES (?, ?, ?)"
        );
        // Exécution de la requête avec les données
        return $requete->execute([$commentaire_text, $id_utilisateur, $date]);
    }

    /**
     * Récupère tous les commentaires avec le login de l'utilisateur,
     * triés du plus récent au plus ancien.
     */
    public function getAllCommentsWithUser()
    {
        $requete = $this->bdd->prepare("
            SELECT 
                c.commentaire, 
                c.date, 
                u.login AS auteur_login
            FROM 
                commentaires c
            JOIN 
                utilisateurs u ON c.id_utilisateur = u.id
            ORDER BY 
                c.date DESC
        ");
        $requete->execute();
        // On retourne tous les résultats sous forme de tableau associatif
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getCommentsByUserId($user_id)
    {
        $requete = $this->bdd->prepare("
        SELECT 
            commentaire, 
            date 
        FROM 
            commentaires
        WHERE 
            id_utilisateur = ?
        ORDER BY 
            date DESC
    ");
        $requete->execute([$user_id]);
        // On retourne tous les résultats sous forme de tableau associatif
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
}
