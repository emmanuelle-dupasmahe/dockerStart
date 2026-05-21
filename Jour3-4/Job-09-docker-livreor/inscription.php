<?php
    // On inclut le modèle
require_once('model/user-model.php'); 
$userModel = new UserModel();

// Variable pour stocker les messages d'erreur 
$erreur = null;

// On vérifie si le formulaire a été soumis
if (isset($_POST['submit_inscription'])) {
    
    // Récupération et nettoyage des données du formulaire
    $login = trim($_POST['login']);
    $password = $_POST['password'];
    $conf_password = $_POST['conf_password'];

    // --- LOGIQUE DE VÉRIFICATION ET VALIDATION ---
    
    if (empty($login) || empty($password) || empty($conf_password)) {
        $erreur = "Veuillez remplir tous les champs.";
    } elseif ($password !== $conf_password) {
        $erreur = "Les mots de passe ne correspondent pas.";
    } elseif (strlen($password) < 6) { 
        $erreur = "Le mot de passe doit contenir au moins 6 caractères.";
    } else {
        
        // On vérifie l'existence du login via le modèle
        $user_exists = $userModel->getUserByLogin($login);

        if ($user_exists) {
            $erreur = "Ce login est déjà utilisé. Veuillez en choisir un autre.";
        } else {
            // Hachage du mot de passe pour la sécurité
            $password_hashed = password_hash($password, PASSWORD_DEFAULT);
            
            // On l'insère dans la base de données via le Modèle
            $inscription_ok = $userModel->registerUser($login, $password_hashed);

            if ($inscription_ok) {
                // Redirection vers la page de connexion
                header('Location: connexion.php');
                exit();
            } else {
                $erreur = "Une erreur est survenue lors de l'inscription.";
            }
        }
    }
}
// On inclut le Header (qui démarre la session, affiche la navigation et ouvre <main>)
include('includes/header.php'); 
?>
    <main>
    <h2>Formulaire d'Inscription</h2>

        <?php
        // Affichage des messages d'erreur si le contrôleur en a renvoyé
        if (isset($erreur)) {
            echo "<p style='color: red;'>$erreur</p>";
        }
        ?>

        <form action="inscription.php" method="POST">
            <div>
                <label for="login">Login :</label>
                <input type="text" id="login" name="login" required>
            </div>
            
            <div>
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <div>
                <label for="conf_password">Confirmer Mot de passe :</label>
                <input type="password" id="conf_password" name="conf_password" required>
            </div>
            
            <button type="submit" name="submit_inscription">S'inscrire</button>
        </form>

        <p>Déjà un compte ? <a href="connexion.php">Connectez-vous ici</a></p>
    </main>

<?php
// On inclut le Foooter
include('includes/footer.php'); 
?>