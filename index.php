<?php
session_start();
require 'cfg/db_config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Obtener un gatito aleatorio si no hay una acción activa
$gato_random = null;
if (!isset($_GET['action'])) {
    $sql_random = '
        SELECT 
            gatitos.nombre, 
            gatitos.raza,  
            gatitos.descripcion, 
            gatitos.fecha_nacimiento,
            fotos.ruta AS foto,
            fotos.descripcion AS descripcion_foto,
            fotos.fecha_subida,
            usuarios.nombre AS dueno
        FROM 
            gatitos
        INNER JOIN 
            fotos
        ON 
            gatitos.id = fotos.gatito_id
        INNER JOIN 
            usuarios
        ON
            gatitos.usuario_id = usuarios.id
        ORDER BY RAND()
        LIMIT 1
    ';
    $stmt_random = $pdo->query($sql_random);
    $gato_random = $stmt_random->fetch();

    // Calcular la edad
    if ($gato_random) {
        $fecha_nacimiento = new DateTime($gato_random['fecha_nacimiento']);
        $fecha_actual = new DateTime();
        $diferencia = $fecha_actual->diff($fecha_nacimiento); 

        // Determinar si mostrar en años o meses
        if ($diferencia->y < 1) {
            $gato_random['edad'] = $diferencia->m . ' mes' . ($diferencia->m === 1 ? '' : 'es'); // Singular o plural para meses
        } else {
            $gato_random['edad'] = $diferencia->y . ' año' . ($diferencia->y === 1 ? '' : 's'); // Singular o plural para años
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MeowPic - Inicio</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="icon" type="image/png" href="imagenes/favicon.png">
</head>

<body>
    <header>
        <a href="index.php">
            <img src="imagenes/meowpicLogo.png" alt="MeowPic Logo" style="height: 60px;">
        </a>
        <nav>
            <a href="index.php?action=add" class="button">Añadir Gatito</a>
            <a href="index.php?action=search" class="button">Buscar Gatito</a>
            <a href="index.php?action=edit" class="button">Editar Mis Gatitos</a>
            <a href="logout.php" class="button">Cerrar Sesión</a>
        </nav>
    </header>
    <main>
        <section>
            <h2>Explora la galería de gatitos</h2>
            <p>¡Sube y comparte fotos de tus adorables gatitos con la comunidad!</p>
            <h2>Gatito Aleatorio</h2>
        </section>
        <?php if ($gato_random): ?>
            <section>
                <div class="gatito-info">
                    <p>
                        <strong>Nombre:</strong> <?php echo htmlspecialchars($gato_random['nombre']); ?><br>
                        <strong>Raza:</strong> <?php echo htmlspecialchars($gato_random['raza']); ?><br>
                        <strong>Edad:</strong> <?php echo htmlspecialchars($gato_random['edad']); ?><br>
                        <strong>Descripción:</strong> <?php echo htmlspecialchars($gato_random['descripcion']); ?><br>
                        <strong>Fecha de Subida:</strong> <?php echo htmlspecialchars($gato_random['fecha_subida']); ?><br>
                        <strong>Nombre del dueño:</strong> <?php echo htmlspecialchars($gato_random['dueno']); ?><br>
                    </p>
                    <img src="<?php echo htmlspecialchars($gato_random['foto']); ?>"
                        alt="Imagen de <?php echo htmlspecialchars($gato_random['nombre']); ?>" width="150">
                </div>
            </section>
        <?php endif; ?>
        <section>
            <?php
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'add':
                        include 'controllers/add_gatitos.php';
                        break;
                    case 'search':
                        include 'controllers/search_gatitos.php';
                        break;
                    case 'edit':
                        include 'controllers/edit_gatitos.php';
                        break;
                }
            }
            ?>
        </section>
    </main>
</body>

</html>