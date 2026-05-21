<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$est_connecte = isset($_SESSION['user_id']);
$login_utilisateur = $est_connecte ? $_SESSION['user_login'] : 'Visiteur';

$base_path = (strpos($_SERVER['PHP_SELF'], 'controller') !== false) ? '/' : '';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>The Livre d'Or</title>
    <link rel="stylesheet" href="<?= $base_path ?>css/style.css"> 
</head>
<body>

    <header>
        <nav>
            <ul>
                <li><a href="<?= $base_path ?>index.php">Accueil</a></li>
                <li><a href="<?= $base_path ?>livre-or.php">The Livre d'Or</a></li>
                
                <?php if ($est_connecte): ?>
                    <li><a href="<?= $base_path ?>profil.php">Mon Profil</a></li>
                    <li><a href="<?= $base_path ?>deconnexion.php">Se Déconnecter</a></li>
                <?php else: ?>
                    <li><a href="<?= $base_path ?>inscription.php">Inscription</a></li>
                    <li><a href="<?= $base_path ?>connexion.php">Connexion</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>