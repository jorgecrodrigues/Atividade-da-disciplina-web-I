<?php
/**
 * Created by PhpStorm.
 * User: Jorge Rodrigues
 * Date: 16/10/18
 * Time: 19:01
 */

/*$host = '127.0.0.1';
$db   = 'web';
$user = 'laravel';
$pass = 'nHsZ3ceCjN6W6Dff';
$charset = 'utf8mb4';*/

$host = 'localhost';
$db = 'jorge';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}


