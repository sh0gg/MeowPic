<?php
require 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encripta la contraseña

    // Verifica si el email ya existe
    $sql_check = 'SELECT * FROM usuarios WHERE email = :email';
    $stmt = $pdo->prepare($sql_check);
    $stmt->execute([':email' => $email]);

    if ($stmt->rowCount() > 0) {
        $error = 'El email ya está registrado.';
    } else {
        // Inserta el nuevo usuario en la base de datos
        $sql = 'INSERT INTO usuarios (nombre, email, password) VALUES (:nombre, :email, :password)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nombre' => $nombre,
            ':email' => $email,
            ':password' => $password
        ]);

        $success = 'Usuario registrado con éxito. Ahora puedes iniciar sesión.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
</head>
<body>
    <h1>Registrar Nuevo Usuario</h1>

    <?php if (isset($error)): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <?php if (isset($success)): ?>
        <p style="color:green;"><?php echo $success; ?></p>
    <?php endif; ?>

    <form method="POST">
        Nombre: <input type="text" name="nombre" required><br>
        Email: <input type="email" name="email" required><br>
        Contraseña: <input type="password" name="password" required><br>
        <button type="submit">Registrar</button>
    </form>

    <a href="login.php">Iniciar Sesión</a>
</body>
</html>
