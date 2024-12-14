<?php
require 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gatito_id = $_POST['gatito_id'];
    $usuario_id = 1; // Sustituir por el ID del usuario autenticado

    // Verificar que el usuario sea el dueño del gatito
    $sql_verify = 'SELECT usuario_id FROM gatitos WHERE id = :gatito_id';
    $stmt = $pdo->prepare($sql_verify);
    $stmt->execute([':gatito_id' => $gatito_id]);
    $result = $stmt->fetch();

    if ($result['usuario_id'] != $usuario_id) {
        die('No tienes permisos para editar este gatito.');
    }

    // Actualizar datos del gatito
    $sql_update = 'UPDATE gatitos SET nombre = :nombre, sexo = :sexo, fecha_nacimiento = :fecha_nacimiento, 
                   raza = :raza, peso = :peso, descripcion = :descripcion WHERE id = :gatito_id';
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

    echo 'Datos del gatito actualizados correctamente.';
} else {
    $gatito_id = $_GET['gatito_id'];
    $sql = 'SELECT * FROM gatitos WHERE id = :gatito_id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':gatito_id' => $gatito_id]);
    $gatito = $stmt->fetch();
}
?>

<form method="POST">
    <input type="hidden" name="gatito_id" value="<?php echo $gatito['id']; ?>">
    Nombre: <input type="text" name="nombre" value="<?php echo $gatito['nombre']; ?>" required><br>
    Sexo: <select name="sexo">
        <option value="M" <?php echo $gatito['sexo'] == 'M' ? 'selected' : ''; ?>>Macho</option>
        <option value="F" <?php echo $gatito['sexo'] == 'F' ? 'selected' : ''; ?>>Hembra</option>
    </select><br>
    Fecha de nacimiento: <input type="date" name="fecha_nacimiento" value="<?php echo $gatito['fecha_nacimiento']; ?>" required><br>
    Raza: <input type="text" name="raza" value="<?php echo $gatito['raza']; ?>"><br>
    Peso: <input type="number" step="0.01" name="peso" value="<?php echo $gatito['peso']; ?>"><br>
    Descripción: <textarea name="descripcion"><?php echo $gatito['descripcion']; ?></textarea><br>
    <button type="submit">Actualizar</button>
</form>
