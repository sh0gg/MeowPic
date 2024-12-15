<?php
require '/cfg/db_config.php';

$gatito_id = 1;

$sql = 'SELECT * FROM fotos WHERE gatito_id = :gatito_id';
$stmt = $pdo->prepare($sql);
$stmt->execute(['gatito_id' => $gatito_id]);

$fotos = $stmt->fetchAll();
foreach ($fotos as $foto) {
    echo $foto['ruta'] . ' - ' . $foto['descripcion'] . '<br>';
}
?>
