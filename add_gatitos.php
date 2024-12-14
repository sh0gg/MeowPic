<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $raza = $_POST['raza'];
    $descripcion = $_POST['descripcion'];
    $foto = 'imagenes/' . basename($_FILES['foto']['name']);
    move_uploaded_file($_FILES['foto']['tmp_name'], $foto);

    $sql = 'INSERT INTO gatitos (nombre, raza, descripcion, foto, usuario_id) VALUES (:nombre, :raza, :descripcion, :foto, :usuario_id)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':nombre' => $nombre, ':raza' => $raza, ':descripcion' => $descripcion, ':foto' => $foto, ':usuario_id' => $user_id]);

    echo "Gatito añadido con éxito.";
}
?>

<form method="POST" enctype="multipart/form-data">
    Nombre: <input type="text" name="nombre" required><br>
    Raza: <input type="text" name="raza"><br>
    Descripción: <textarea name="descripcion"></textarea><br>
    Foto: <input type="file" name="foto" required><br>
    <button type="submit">Subir</button>
</form>
