<?php
session_start();
require 'db_config.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id']; // ID del usuario autenticado

// Obtener gatos del usuario
$sql = 'SELECT * FROM gatitos WHERE usuario_id = :user_id';
$stmt = $pdo->prepare($sql);
$stmt->execute([':user_id' => $user_id]);
$gatos = $stmt->fetchAll();

// Función para mostrar un gato aleatorio
if (isset($_POST['random_gato'])) {
    $sql_random = 'SELECT * FROM gatitos ORDER BY RAND() LIMIT 1';
    $stmt_random = $pdo->query($sql_random);
    $gato_random = $stmt_random->fetch();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MeowPic - Principal</title>
</head>
<body>
    <h1>Bienvenido a MeowPic</h1>

    <!-- Botón para añadir gatos -->
    <form action="add_gatitos.php" method="GET" style="display:inline;">
        <button type="submit">Añadir Gato</button>
    </form>

    <!-- Botón para mostrar un gato aleatorio -->
    <form method="POST" style="display:inline;">
        <button type="submit" name="random_gato">Gato Aleatorio</button>
    </form>

    <!-- Tabla con los datos de los gatos -->
    <h2>Mis Gatitos</h2>
    <?php if (!empty($gatos)): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Sexo</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Raza</th>
                    <th>Peso</th>
                    <th>Descripción</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($gatos as $gato): ?>
                    <tr>
                        <td><img src="<?php echo htmlspecialchars($gato['foto']); ?>" alt="Foto de gato" width="100"></td>
                        <td><?php echo htmlspecialchars($gato['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($gato['sexo']); ?></td>
                        <td><?php echo htmlspecialchars($gato['fecha_nacimiento']); ?></td>
                        <td><?php echo htmlspecialchars($gato['raza']); ?></td>
                        <td><?php echo htmlspecialchars($gato['peso']); ?></td>
                        <td><?php echo htmlspecialchars($gato['descripcion']); ?></td>
                        <td>
                            <form action="edit_gatitos.php" method="GET" style="display:inline;">
                                <input type="hidden" name="gatito_id" value="<?php echo $gato['id']; ?>">
                                <button type="submit">Editar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No has registrado gatitos aún.</p>
    <?php endif; ?>

    <!-- Gato aleatorio (si existe) -->
    <?php if (isset($gato_random)): ?>
        <h2>Gato Aleatorio</h2>
        <p>
            <strong>Nombre:</strong> <?php echo htmlspecialchars($gato_random['nombre']); ?><br>
            <strong>Sexo:</strong> <?php echo htmlspecialchars($gato_random['sexo']); ?><br>
            <strong>Raza:</strong> <?php echo htmlspecialchars($gato_random['raza']); ?><br>
            <img src="<?php echo htmlspecialchars($gato_random['foto']); ?>" alt="Foto de gato aleatorio" width="150">
        </p>
    <?php endif; ?>
</body>
</html>
