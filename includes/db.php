<?php
/**
 * Connexion PDO à MySQL pour FAITH DECOR.
 *
 * En local, les valeurs par défaut conviennent à une installation MySQL classique.
 * En production, définissez DB_HOST, DB_PORT, DB_NAME, DB_USER et DB_PASSWORD
 * dans la configuration du serveur (et ne placez pas le mot de passe dans Git).
 */

declare(strict_types=1);

$dbHost = getenv('DB_HOST') ?: '127.0.0.1';
$dbPort = getenv('DB_PORT') ?: '3306';
$dbName = getenv('DB_NAME') ?: 'faith_decor';
$dbUser = getenv('DB_USER') ?: 'admin';
$dbPassword = getenv('DB_PASSWORD') ?: 'admin';

$dsn = sprintf(
    'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
    $dbHost,
    $dbPort,
    $dbName
);

try {
    $pdo = new PDO($dsn, $dbUser, $dbPassword, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (PDOException $exception) {
    http_response_code(500);
    exit('Impossible de se connecter à la base de données. Vérifiez includes/db.php et importez db/schema.sql.');
}
