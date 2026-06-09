<?php
require_once 'config.php';
header('Content-Type: application/json');
try {
    $pdo = new PDO(
        'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME,
        DB_USER,
        DB_PASSWORD
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo json_encode([
        'status' => 'connected',
        'database' => DB_NAME,
        'user' => DB_USER,
        'passwordSet' => !empty(DB_PASSWORD),
        'passwordLength' => strlen(DB_PASSWORD) // pour debug uniquement
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
