<?php
session_start();
require 'db_config.php';

// Comprobar si hay usuarios registrados
$sql_check_users = 'SELECT COUNT(*) FROM usuarios';
$stmt = $pdo->query($sql_check_users);
$users_exist = $stmt->fetchColumn() > 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = 'SELECT * FROM usuarios WHERE email = :email';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: index.php');
        exit;
    } else {
        $error = 'Credenciales inválidas.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
</head>
<body>
    <h1>Iniciar Sesión</h1>

    <?php if (!$users_exist): ?>
        <p>No hay usuarios registrados. Por favor, <a href="register.php">registra un usuario</a> para continuar.</p>
    <?php else: ?>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="POST">
            Email: <input type="email" name="email" required><br>
            Contraseña: <input type="password" name="password" required><br>
            <button type="submit">Iniciar Sesión</button>
        </form>
    <?php endif; ?>

    <p><a href="register.php">¿No tienes cuenta? Regístrate aquí</a></p>
</body>
</html>
