<?php
session_start();
require '/cfg/db_config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: /functions/login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Obtener un gatito aleatorio
$sql_random = '
    SELECT 
        gatitos.nombre, 
        gatitos.raza, 
        gatitos.edad, 
        gatitos.descripcion, 
        fotos.ruta AS foto,
        fotos.descripcion AS descripcion_foto,
        fotos.fecha_subida
    FROM 
        gatitos
    INNER JOIN 
        fotos 
    ON 
        gatitos.id = fotos.gatito_id
    ORDER BY RAND()
    LIMIT 1
';
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
    <div class="gatito-info">
        <p>
            <strong>Nombre:</strong> <?php echo htmlspecialchars($gato_random['nombre']); ?><br>
            <strong>Raza:</strong> <?php echo htmlspecialchars($gato_random['raza']); ?><br>
            <strong>Edad:</strong> <?php echo htmlspecialchars($gato_random['edad']); ?> años<br>
            <strong>Descripción:</strong> <?php echo htmlspecialchars($gato_random['descripcion']); ?><br>
            <strong>Descripción de la Foto:</strong> <?php echo htmlspecialchars($gato_random['descripcion_foto']); ?><br>
            <strong>Fecha de Subida:</strong> <?php echo htmlspecialchars($gato_random['fecha_subida']); ?><br>
        </p>
        <img src="<?php echo htmlspecialchars($gato_random['foto']); ?>" alt="Imagen de <?php echo htmlspecialchars($gato_random['nombre']); ?>" width="150">
    </div>
    <?php else: ?>
        <p>No hay gatitos registrados aún.</p>
    <?php endif; ?>

    <?php
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'add':
                include '/controllers/add_gatitos.php';
                break;
            case 'search':
                include '/controllers/search_gatitos.php';
                break;
            case 'edit':
                include '/controllers/edit_gatitos.php';
                break;
        }
    }
    ?>
</body>
</html>
