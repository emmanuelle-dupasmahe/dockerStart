<?php

// On vérifie si l'utilisateur est connecté pour l'affichage du lien d'ajout
$est_connecte = isset($_SESSION['user_id']);

// On inclut le modèle de commentaires
require_once('model/comment-model.php'); 
$commentModel = new CommentModel();

// On récupère tous les commentaires via la méthode de jointure
$commentaires = $commentModel->getAllCommentsWithUser();

// On inclut le Header (qui démarre la session, affiche la navigation et ouvre <main>)
include('includes/header.php'); 
?>


    <main>
        <h2>The Livre d'Or</h2>

        <?php if ($est_connecte): ?>
            <p><a href="commentaire.php" class="button-action">Ajouter un commentaire</a></p>
        <?php else: ?>
            <p>Connectez-vous pour laisser un message ! <a href="connexion.php">Connexion</a></p>
        <?php endif; ?>

        <?php if (empty($commentaires)): ?>
            <p>Soyez le premier à laisser un message !</p>
        <?php else: ?>
            <section class="commentaires-list">
                <?php foreach ($commentaires as $com): ?>
                    <article class="commentaire-entry">
                        <p class="meta">
                            <span style="font-size: 200%;">🐊</span> Posté le <?= date('d/m/Y', strtotime($com['date'])) ?> par <?= htmlspecialchars($com['auteur_login']) ?>
                        </p>
                        <blockquote class="message-text">
                            <?= nl2br(htmlspecialchars($com['commentaire'])) ?>
                        </blockquote>
                        
                    </article>
                <?php endforeach; ?>
            </section>
        <?php endif; ?>
        
        <p><a href="index.php">Retour à l'accueil</a></p>
    </main>
<?php

// On inclut le Foooter
include('includes/footer.php'); 
?>