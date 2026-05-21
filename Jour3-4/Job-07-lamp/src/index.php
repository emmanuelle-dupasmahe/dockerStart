<?php
echo "<h1>Bienvenue sur la stack LAMP (Job 07)</h1>";

echo "<h2>Test de connexion à la base de données MySQL</h2>";

// Paramètres de connexion (définis dans docker-compose.yml)
$host = 'db'; // Le hostname est le nom du service de base de données
$dbname = 'lamp_demo';
$user = 'dev';
$pass = 'devpassword';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<p style='color: green;'>✅ Connexion réussie à la base de données '$dbname' avec l'utilisateur '$user' !</p>";
} catch (PDOException $e) {
    echo "<p style='color: red;'>❌ Échec de la connexion : " . $e->getMessage() . "</p>";
    echo "<p><em>Note formateur : Si l'erreur indique <b>'could not find driver'</b>, c'est normal ! L'image <code>php:8.2-apache</code> de base n'inclut pas l'extension <code>pdo_mysql</code>. Dans un vrai projet, on crée un <code>Dockerfile</code> pour faire un <code>docker-php-ext-install pdo pdo_mysql</code>.</em></p>";
}

echo "<h2>Informations PHP</h2>";
phpinfo();
