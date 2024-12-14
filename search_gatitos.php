<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['query'])) {
    $query = '%' . $_GET['query'] . '%';
    $sql = 'SELECT * FROM gatitos WHERE nombre LIKE :query OR raza LIKE :query';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':query' => $query]);
    $resultados = $stmt->fetchAll();
}
?>

<form method="GET">
    Buscar: <input type="text" name="query" required>
    <button type="submit">Buscar</button>
</form>

<?php if (isset($resultados)): ?>
    <ul>
        <?php foreach ($resultados as $gato): ?>
            <li><?php echo htmlspecialchars($gato['nombre']); ?> - <?php echo htmlspecialchars($gato['raza']); ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
