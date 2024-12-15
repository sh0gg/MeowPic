<?php
require 'cfg/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = 'INSERT INTO usuarios (nombre, email, password) VALUES (:nombre, :email, :password)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':nombre' => $nombre, ':email' => $email, ':password' => $password]);

    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles/style.css">
    <title>Registrar Usuario</title>
</head>
<body>
    <h1>Registrar Usuario</h1>
    <form method="POST">
        Nombre: <input type="text" name="nombre" required><br>
        Email: <input type="email" name="email" required><br>
        Contraseña: <input type="password" name="password" required><br>
        <button type="submit">Registrar</button>
    </form>
</body>
</html>
