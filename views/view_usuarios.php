<?php
require '/cfg/db_config.php';

$sql = 'SELECT * FROM usuarios';
$stmt = $pdo->query($sql);

while ($row = $stmt->fetch()) {
    echo $row['nombre'] . ' - ' . $row['email'] . '<br>';
}
?>
