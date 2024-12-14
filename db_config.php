<?php
$host = 'localhost';      // Servidor de la base de datos
$db = 'nombre_de_tu_bd';  // Nombre de la base de datos
$user = 'root';           // Usuario (ajusta según tu configuración)
$pass = '';               // Contraseña (ajusta según tu configuración)
$charset = 'utf8mb4';     // Conjunto de caracteres

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die('Error de conexión: ' . $e->getMessage());
}
?>
