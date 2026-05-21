<?php
session_start();

// --- VÉRIFICATION DE LA CONNEXION ---
if (!isset($_SESSION['user_id'])) {
    // Si l'utilisateur n'est pas connecté, le rediriger vers la page de connexion
    header('Location: controller/connexion.php'); 
    exit();
}

// Inclure le Modèle de commentaires
require_once('model/comment-model.php'); 
$commentModel = new CommentModel();

$erreur = null;

// --- LOGIQUE D'INSERTION ---
if (isset($_POST['submit_commentaire'])) {
    
    $commentaire_text = trim($_POST['commentaire']);
    $id_utilisateur = $_SESSION['user_id']; // ID récupéré de la session
    
    if (empty($commentaire_text)) {
        $erreur = "Le champ commentaire ne peut pas être vide.";
    } else {
        
        // on appelle le modèle pour insérer le commentaire
        $insertion_ok = $commentModel->addComment($commentaire_text, $id_utilisateur);

        if ($insertion_ok) {
            // On redirige vers le Livre d'Or pour voir le nouveau commentaire
            header('Location: livre-or.php'); 
            exit();
        } else {
            $erreur = "Une erreur est survenue lors de l'enregistrement du commentaire.";
        }
    }
}
// On inclut le Header (qui démarre la session, affiche la navigation et ouvre <main>)
include('includes/header.php'); 
?>
    <main>
        <h2>Poster votre commentaire</h2>

        <?php
        // Affichage des messages d'erreur ou de succès
        if (isset($erreur)) {
            echo "<p style='color: red;'>$erreur</p>";
        }
        ?>

        <form action="commentaire.php" method="POST">
            <div>
                <label for="commentaire">Votre message :</label>
                <textarea id="commentaire" name="commentaire" rows="10" required></textarea>
            </div>
            
            <button type="submit" name="submit_commentaire">Poster le commentaire</button>
        </form>

        <p><a href="livre-or.php">Retour au Livre d'Or</a></p>
    </main>
<?php

// On inclut le Foooter
include('includes/footer.php'); 
?>