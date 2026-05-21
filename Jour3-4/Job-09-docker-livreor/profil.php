<?php
session_start();
// Le contrôleur pour la page de profil
require_once('model/user-model.php');
require_once('model/comment-model.php');

$userModel = new UserModel();
$commentModel = new CommentModel();

$erreur = null;
$success = null;

// --- GESTION DE L'ACCÈS ---
if (!isset($_SESSION['user_id'])) {
    // Si l'utilisateur n'est pas connecté, le rediriger
    header('Location: controller/connexion.php'); 
    exit();
}

// On récupère l'ID de l'utilisateur connecté
$user_id = $_SESSION['user_id'];
// On récupère les données de l'utilisateur et ses commentaires
$utilisateur = $userModel->getUserById($user_id);

$commentaires_utilisateur = $commentModel->getCommentsByUserId($user_id);

// --- LOGIQUE DE MODIFICATION ---
if (isset($_POST['submit_profil'])) {
    
    // MODIFICATION DU LOGIN
    if (!empty($_POST['new_login'])) {
        $new_login = trim($_POST['new_login']);
        
        if ($new_login !== $utilisateur['login']) {
            // On vérifie si le nouveau login n'est pas déjà pris
            $login_exists = $userModel->getUserByLogin($new_login);
            
            if ($login_exists) {
                $erreur = "Ce nouveau login est déjà utilisé.";
            } else {
                // Mise à jour du login
                if ($userModel->updateLogin($user_id, $new_login)) {
                    $_SESSION['user_login'] = $new_login; // Mise à jour de la session !
                    $utilisateur['login'] = $new_login;    // Mise à jour de l'objet utilisateur
                    $success = "Votre login a été mis à jour avec succès.";
                } else {
                    $erreur = "Erreur lors de la mise à jour du login.";
                }
            }
        }
    }
    
    // MODIFICATION DU MOT DE PASSE
    $password = $_POST['new_password'];
    $conf_password = $_POST['conf_password'];
    
    if (!empty($password) && !empty($conf_password)) {
        if ($password !== $conf_password) {
            $erreur = ($erreur ? $erreur . "<br>" : "") . "Les mots de passe ne correspondent pas.";
        } elseif (strlen($password) < 6) {
             $erreur = ($erreur ? $erreur . "<br>" : "") . "Le mot de passe doit contenir au moins 6 caractères.";
        } else {
            // Mise à jour du mot de passe
            $password_hashed = password_hash($password, PASSWORD_DEFAULT);
            if ($userModel->updatePassword($user_id, $password_hashed)) {
                $success = ($success ? $success . "<br>" : "") . "Votre mot de passe a été mis à jour avec succès.";
            } else {
                 $erreur = ($erreur ? $erreur . "<br>" : "") . "Erreur lors de la mise à jour du mot de passe.";
            }
        }
    } 
    // Gère le cas où un seul champ de mot de passe est rempli
    elseif ((!empty($password) && empty($conf_password)) || (empty($password) && !empty($conf_password))) {
        $erreur = ($erreur ? $erreur . "<br>" : "") . "Veuillez remplir les deux champs de mot de passe si vous souhaitez le modifier.";
    }

    // Si tout est vide, on ne fait rien
}
// On inclut le Header (qui démarre la session, affiche la navigation et ouvre <main>)
include('includes/header.php'); 
?>

    <main>
        <h2>🙂 Mon Profil</h2>
        <p>Connecté en tant que : <strong><?= htmlspecialchars($utilisateur['login']) ?></strong></p>

        <?php
        // Affichage des messages de succès et d'erreur
        if (isset($success)) {
            echo "<p style='color: green;'>$success</p>";
        }
        if (isset($erreur)) {
            echo "<p style='color: red;'>$erreur</p>";
        }
        ?>

        <form action="profil.php" method="POST">
            <h3>Modifier votre Login <span class="note-profil">(Si vous voulez le changer)</span></h3>
            <div>
                <label for="new_login">Nouveau Login :</label>
                <input type="text" id="new_login" name="new_login" 
                       value="<?= htmlspecialchars($utilisateur['login']) ?>" required>
            </div>
            
            <h3>Modifier votre Mot de Passe
            <span class="note-profil">(Laissez vide si vous ne voulez pas le changer)</span>
            </h3>
            <div>
                <label for="new_password">Nouveau Mot de passe :</label>
                <input type="password" id="new_password" name="new_password">
            </div>
            
            <div>
                <label for="conf_password">Confirmer Mot de passe :</label>
                <input type="password" id="conf_password" name="conf_password">
            </div>
            
            <button type="submit" name="submit_profil">Mettre à jour le Profil</button>
        </form>

        <section id="mes-commentaires">
            <h3>Mes Derniers Commentaires (<?= count($commentaires_utilisateur) ?>)</h3>

            <?php if (empty($commentaires_utilisateur)): ?>
                <p>Vous n'avez pas encore posté de commentaire.</p>
                <br>
            <?php else: ?>
                <?php foreach ($commentaires_utilisateur as $commentaire): ?>
                    <article class="commentaire-profil">
                        <p class="meta">
                            Posté le <?= date('d/m/Y à H:i', strtotime($commentaire['date'])) ?>
                        </p>
                        <p class="contenu">
                            <?= nl2br(htmlspecialchars($commentaire['commentaire'])) ?>
                        </p>
                        <br>
                    </article>
                     <?php endforeach; ?>
            <?php endif; ?>
        </section>


        <p><a href="index.php">Retour à l'accueil</a></p>
    </main>
<?php

// On inclut le Foooter
include('includes/footer.php'); 
?>