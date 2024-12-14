<?php
session_start();
require 'db_config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Obtener un gatito aleatorio
$sql_random = 'SELECT * FROM gatitos ORDER BY RAND() LIMIT 1';
$stmt_random = $pdo->query($sql_random);
$gato_random = $stmt_random->fetch();
?>

<!DOCTYPE html>
<html>
<head>
    <title>MeowPic</title>
</head>
<body>
    <h1>MeowPic</h1>
    <nav>
        <a href="index.php?action=add">Añadir Gatito</a> |
        <a href="index.php?action=search">Buscar Gatito</a> |
        <a href="index.php?action=edit">Editar Mis Gatitos</a> |
        <a href="logout.php">Cerrar Sesión</a>
    </nav>

    <h2>Gatito Aleatorio</h2>
    <?php if ($gato_random): ?>
        <p>
            <strong>Nombre:</strong> <?php echo htmlspecialchars($gato_random['nombre']); ?><br>
            <strong>Raza:</strong> <?php echo htmlspecialchars($gato_random['raza']); ?><br>
            <img src="<?php echo htmlspecialchars($gato_random['foto']); ?>" alt="Gatito" width="150">
        </p>
    <?php else: ?>
        <p>No hay gatitos registrados aún.</p>
    <?php endif; ?>

    <?php
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'add':
                include 'add_gatitos.php';
                break;
            case 'search':
                include 'search_gatitos.php';
                break;
            case 'edit':
                include 'edit_gatitos.php';
                break;
        }
    }
    ?>
</body>
</html>
