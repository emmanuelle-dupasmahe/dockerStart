<?php

/**
 * Lit un secret depuis un fichier (convention _FILE) ou variable d'env
 */
function readSecret(string $name): ?string
{
    $secretFile = getenv($name . '_FILE');
    if ($secretFile && file_exists($secretFile)) {
        return trim(file_get_contents($secretFile));
    }
    $value = getenv($name);
    return $value !== false ? $value : null;
}
define('DB_HOST', getenv('DB_HOST') ?: 'mysql');
define('DB_NAME', getenv('DB_NAME') ?: 'myapp');
define('DB_USER', readSecret('DB_USER') ?: 'root');
define('DB_PASSWORD', readSecret('DB_PASSWORD') ?: '');
