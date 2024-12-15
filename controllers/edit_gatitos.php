<?php
require '/cfg/db_config.php';

$usuario_id = $_SESSION['user_id']; // Obtener el ID del usuario autenticado

// Verificar si el usuario tiene gatitos registrados
$sql_check = 'SELECT * FROM gatitos WHERE usuario_id = :usuario_id ORDER BY id';
$stmt = $pdo->prepare($sql_check);
$stmt->execute([':usuario_id' => $usuario_id]);
$gatitos = $stmt->fetchAll();

if (empty($gatitos)) {
    // El usuario no tiene gatitos registrados
    echo '<p>No puedes editar los datos de ningún gatito, pues no has subido ninguno aún... :C</p>';
    exit;
}

// Determinar el ID del gatito actual
$current_index = $_GET['index'] ?? 0; // Usar índice 0 (primer gatito) si no se proporciona
$current_index = max(0, min($current_index, count($gatitos) - 1)); // Asegurar que el índice esté dentro de límites
$gatito = $gatitos[$current_index];
?>

<form method="POST" action="edit_gatitos.php">
    <input type="hidden" name="gatito_id" value="<?php echo htmlspecialchars($gatito['id']); ?>">
    Nombre: <input type="text" name="nombre" value="<?php echo htmlspecialchars($gatito['nombre']); ?>" required><br>
    Sexo: 
    <select name="sexo">
        <option value="M" <?php echo $gatito['sexo'] == 'M' ? 'selected' : ''; ?>>Macho</option>
        <option value="F" <?php echo $gatito['sexo'] == 'F' ? 'selected' : ''; ?>>Hembra</option>
    </select><br>
    Fecha de nacimiento: <input type="date" name="fecha_nacimiento" value="<?php echo htmlspecialchars($gatito['fecha_nacimiento']); ?>" required><br>
    Raza: <input type="text" name="raza" value="<?php echo htmlspecialchars($gatito['raza']); ?>"><br>
    Peso: <input type="number" step="0.01" name="peso" value="<?php echo htmlspecialchars($gatito['peso']); ?>"><br>
    Descripción: <textarea name="descripcion"><?php echo htmlspecialchars($gatito['descripcion']); ?></textarea><br>
    <button type="submit">Actualizar</button>
</form>

<div>
    <!-- Navegación entre gatitos -->
    <?php if ($current_index > 0): ?>
        <a href="edit_gatitos.php?index=<?php echo $current_index - 1; ?>">&#9664; Anterior</a>
    <?php endif; ?>
    
    <?php if ($current_index < count($gatitos) - 1): ?>
        <a href="edit_gatitos.php?index=<?php echo $current_index + 1; ?>">Siguiente &#9654;</a>
    <?php endif; ?>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gatito_id = $_POST['gatito_id'];

    // Verificar que el usuario sea el dueño del gatito
    $sql_verify = 'SELECT usuario_id FROM gatitos WHERE id = :gatito_id';
    $stmt = $pdo->prepare($sql_verify);
    $stmt->execute([':gatito_id' => $gatito_id]);
    $result = $stmt->fetch();

    if (!$result || $result['usuario_id'] != $usuario_id) {
        die('No tienes permisos para editar este gatito.');
    }

    // Actualizar datos del gatito
    $sql_update = 'UPDATE gatitos SET 
                    nombre = :nombre, 
                    sexo = :sexo, 
                    fecha_nacimiento = :fecha_nacimiento, 
                    raza = :raza, 
                    peso = :peso, 
                    descripcion = :descripcion 
                   WHERE id = :gatito_id';
    $stmt = $pdo->prepare($sql_update);
    $stmt->execute([
        ':nombre' => $_POST['nombre'],
        ':sexo' => $_POST['sexo'],
        ':fecha_nacimiento' => $_POST['fecha_nacimiento'],
        ':raza' => $_POST['raza'],
        ':peso' => $_POST['peso'],
        ':descripcion' => $_POST['descripcion'],
        ':gatito_id' => $gatito_id
    ]);

    echo '<p>Datos del gatito actualizados correctamente.</p>';
}
?>
