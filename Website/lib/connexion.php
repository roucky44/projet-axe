<?php

$host = 'localhost';
$pdoname = 'main_db';
$username = 'root';
$port = 3306;
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$pdoname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie à la base de données.";
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}