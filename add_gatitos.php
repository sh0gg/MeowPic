<?php
require 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $sexo = $_POST['sexo'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $raza = $_POST['raza'];
    $peso = $_POST['peso'];
    $descripcion = $_POST['descripcion'];
    $usuario_id = 1; // Sustituir por el ID del usuario autenticado

    // Subida de la foto
    $foto_ruta = 'imagenes/gatitos/' . basename($_FILES['foto']['name']);
    move_uploaded_file($_FILES['foto']['tmp_name'], $foto_ruta);

    // Insertar datos en la tabla gatitos
    $sql_gato = 'INSERT INTO gatitos (nombre, sexo, fecha_nacimiento, raza, peso, descripcion, usuario_id)
                 VALUES (:nombre, :sexo, :fecha_nacimiento, :raza, :peso, :descripcion, :usuario_id)';
    $stmt = $pdo->prepare($sql_gato);
    $stmt->execute([
        ':nombre' => $nombre,
        ':sexo' => $sexo,
        ':fecha_nacimiento' => $fecha_nacimiento,
        ':raza' => $raza,
        ':peso' => $peso,
        ':descripcion' => $descripcion,
        ':usuario_id' => $usuario_id
    ]);

    $gatito_id = $pdo->lastInsertId();

    // Insertar la foto en la tabla fotos
    $sql_foto = 'INSERT INTO fotos (ruta, descripcion, usuario_id, gatito_id)
                 VALUES (:ruta, :descripcion, :usuario_id, :gatito_id)';
    $stmt = $pdo->prepare($sql_foto);
    $stmt->execute([
        ':ruta' => $foto_ruta,
        ':descripcion' => $_POST['foto_descripcion'],
        ':usuario_id' => $usuario_id,
        ':gatito_id' => $gatito_id
    ]);

    echo 'Gatito y foto subidos correctamente.';
}
?>

<form method="POST" enctype="multipart/form-data">
    Nombre: <input type="text" name="nombre" required><br>
    Sexo: <select name="sexo">
        <option value="M">Macho</option>
        <option value="F">Hembra</option>
    </select><br>
    Fecha de nacimiento: <input type="date" name="fecha_nacimiento" required><br>
    Raza: <input type="text" name="raza"><br>
    Peso: <input type="number" step="0.01" name="peso"><br>
    Descripción: <textarea name="descripcion"></textarea><br>
    Foto: <input type="file" name="foto" required><br>
    Descripción de la foto: <textarea name="foto_descripcion"></textarea><br>
    <button type="submit">Subir</button>
</form>
