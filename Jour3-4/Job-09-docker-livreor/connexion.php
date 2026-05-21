<?php
// S'assurer que la session est démarrée avant d'utiliser $_SESSION
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// On inclut le Modèle
require_once('model/user-model.php'); 
$userModel = new UserModel();

$erreur = null;

// On vérifie si le formulaire a été soumis
if (isset($_POST['submit_connexion'])) {
    
    // On récupère les données
    $login = trim($_POST['login']);
    $password_saisi = $_POST['password']; // Mot de passe non haché, tel que saisi

    // --- LOGIQUE D'AUTHENTIFICATION ---
    
    if (empty($login) || empty($password_saisi)) {
        $erreur = "Veuillez remplir tous les champs.";
    } else {
        
        // On récupère l'utilisateur par le login via le Modèle
        $utilisateur = $userModel->getUserByLogin($login);

        // On récupère si l'utilisateur existe ET si le mot de passe est correct
        if ($utilisateur && password_verify($password_saisi, $utilisateur['password'])) {
            
            // Authentification réussie : Création de la session
            $_SESSION['user_id'] = $utilisateur['id'];
            $_SESSION['user_login'] = $utilisateur['login'];
            
            // On redirige vers la page d'accueil ou le livre d'or
            header('Location: livre-or.php'); // Ou index.php
            exit();

        } else {
            // Échec de la connexion
            $erreur = "Login ou mot de passe incorrect.";
        }
    }                                                                                               
}
// On inclut le Header (qui démarre la session, affiche la navigation et ouvre <main>)
include('includes/header.php'); 
?>
    <main>
        <h2>Connexion</h2>

        <?php
        // Affichage des messages d'erreur si le contrôleur en a renvoyé
        if (isset($erreur)) {
            echo "<p style='color: red;'>$erreur</p>";
        }
        ?>

        <form action="connexion.php" method="POST">
            <div>
                <label for="login">Login :</label>
                <input type="text" id="login" name="login" required>
            </div>
            
            <div>
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit" name="submit_connexion">Se connecter</button>
        </form>

        <p>Pas encore de compte ? <a href="inscription.php">Inscrivez-vous ici</a></p>
    </main>

<?php
// On inclut le Foooter
include('includes/footer.php'); 
?>