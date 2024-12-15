<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'db_config.php';

    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $sexo = $_POST['sexo'] ?: null; // Asignar null si no se proporciona
    $fecha_nacimiento = $_POST['fecha_nacimiento'] ?: null; // Asignar null si no se proporciona
    $raza = $_POST['raza'] ?: null; // Asignar null si no se proporciona
    $peso = $_POST['peso'] ?: null; // Asignar null si no se proporciona
    $descripcion = $_POST['descripcion'] ?: null; // Asignar null si no se proporciona
    $usuario_id = $_SESSION['user_id']; // Asegúrate de que la sesión esté iniciada

    // Subir la foto y guardar la ruta
    $foto = 'imagenes/gatitos/' . basename($_FILES['foto']['name']);
    move_uploaded_file($_FILES['foto']['tmp_name'], $foto);

    try {
        // Iniciar transacción
        $pdo->beginTransaction();

        // Insertar el nuevo gatito en la tabla `gatitos`
        $sql_gatito = 'INSERT INTO gatitos (nombre, sexo, fecha_nacimiento, raza, peso, descripcion, usuario_id) 
                       VALUES (:nombre, :sexo, :fecha_nacimiento, :raza, :peso, :descripcion, :usuario_id)';
        $stmt_gatito = $pdo->prepare($sql_gatito);
        $stmt_gatito->execute([
            ':nombre' => $nombre,
            ':sexo' => $sexo,
            ':fecha_nacimiento' => $fecha_nacimiento,
            ':raza' => $raza,
            ':peso' => $peso,
            ':descripcion' => $descripcion,
            ':usuario_id' => $usuario_id
        ]);

        // Obtener el ID del gatito recién insertado
        $gatito_id = $pdo->lastInsertId();

        // Insertar la foto en la tabla `fotos`
        $sql_foto = 'INSERT INTO fotos (ruta, descripcion, usuario_id, gatito_id) 
                     VALUES (:ruta, :descripcion, :usuario_id, :gatito_id)';
        $stmt_foto = $pdo->prepare($sql_foto);
        $stmt_foto->execute([
            ':ruta' => $foto,
            ':descripcion' => $descripcion, // Se usa la misma descripción para la foto
            ':usuario_id' => $usuario_id,
            ':gatito_id' => $gatito_id
        ]);

        // Confirmar la transacción
        $pdo->commit();
        echo "Gatito añadido con éxito.";
    } catch (Exception $e) {
        // Revertir la transacción en caso de error
        $pdo->rollBack();
        echo "Error al añadir el gatito: " . $e->getMessage();
    }
}
?>

<form method="POST" enctype="multipart/form-data">
    Nombre: <input type="text" name="nombre" required><br>
    Sexo: 
    <select name="sexo">
        <option value="">No especificado</option>
        <option value="M">Macho</option>
        <option value="H">Hembra</option>
    </select><br>
    Fecha de Nacimiento: <input type="date" name="fecha_nacimiento"><br>
    Raza: <input type="text" name="raza"><br>
    Peso (kg): <input type="number" name="peso" step="0.01" min="0"><br>
    Descripción: <textarea name="descripcion"></textarea><br>
    Foto: <input type="file" name="foto" required><br>
    <button type="submit">Subir</button>
</form>
