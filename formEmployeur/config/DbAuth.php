<?php
// Configuration de la base de données
define('DB_HOST', 'localhost');
define('DB_NAME', 'u864174266_cerfa');
define('DB_USER', 'u864174266_cerfalgx');
define('DB_PASS', 'AQFX53Ysr2w!QDENQoMTa');



try {
    $mysqlClient = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (Exception $exception) {
    die('Erreur : ' . $exception->getMessage());
}
?>

