<?php
// on inclut le modèle de commentaires
require_once('model/comment-model.php'); 
$commentModel = new CommentModel();

// on récupère les commentaires
$commentaires = $commentModel->getAllCommentsWithUser();

// On inclut le Header (qui démarre la session, affiche la navigation et ouvre <main>)
include('includes/header.php'); 
?>

<div class="hero">
    <h1>Bienvenue sur  The Livre d'Or ! 📒</h1>
    <p>Bonjour, <?= htmlspecialchars($login_utilisateur) ?></p>
</div>

<h2>Les Derniers Messages</h2>


<?php if (empty($commentaires)): ?>
    <p>Aucun commentaire pour le moment. Soyez le premier !</p>
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

<?php
// on inclut le Footer (qui ferme </main>, </body>, </html>)
include('includes/footer.php');
?>