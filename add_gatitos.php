<?php
require 'db_config.php';

$sql = 'INSERT INTO gatitos (nombre, sexo, fecha_nacimiento, raza, peso, descripcion, usuario_id)
        VALUES (:nombre, :sexo, :fecha_nacimiento, :raza, :peso, :descripcion, :usuario_id)';
$stmt = $pdo->prepare($sql);

$stmt->execute([
    'nombre' => 'Mishi',
    'sexo' => 'M',
    'fecha_nacimiento' => '2020-05-01',
    'raza' => 'Siames',
    'peso' => 4.5,
    'descripcion' => 'Gato juguetón.',
    'usuario_id' => 1
]);

echo 'Gatito registrado con éxito';
?>
