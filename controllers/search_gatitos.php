<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET)) {
    // Verificar si algún campo del formulario fue llenado
    $filters_applied = array_filter($_GET, function ($value) {
        return !empty($value); // Filtrar campos no vacíos
    });

    if (!empty($filters_applied)) {
        // Construir la consulta dinámica con filtros opcionales
        $sql = 'SELECT *, TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) AS edad_calculada FROM gatitos WHERE 1=1';
        $params = [];

        if (!empty($_GET['nombre'])) {
            $sql .= ' AND nombre LIKE :nombre';
            $params[':nombre'] = '%' . $_GET['nombre'] . '%';
        }

        if (!empty($_GET['sexo'])) {
            $sql .= ' AND sexo = :sexo';
            $params[':sexo'] = $_GET['sexo'];
        }

        if (!empty($_GET['fecha_nacimiento'])) {
            $sql .= ' AND fecha_nacimiento = :fecha_nacimiento';
            $params[':fecha_nacimiento'] = $_GET['fecha_nacimiento'];
        }

        if (!empty($_GET['raza'])) {
            $sql .= ' AND raza LIKE :raza';
            $params[':raza'] = '%' . $_GET['raza'] . '%';
        }

        if (!empty($_GET['peso_min'])) {
            $sql .= ' AND peso >= :peso_min';
            $params[':peso_min'] = $_GET['peso_min'];
        }

        if (!empty($_GET['peso_max'])) {
            $sql .= ' AND peso <= :peso_max';
            $params[':peso_max'] = $_GET['peso_max'];
        }

        if (!empty($_GET['edad_min'])) {
            $sql .= ' AND TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) >= :edad_min';
            $params[':edad_min'] = $_GET['edad_min'];
        }

        if (!empty($_GET['edad_max'])) {
            $sql .= ' AND TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) <= :edad_max';
            $params[':edad_max'] = $_GET['edad_max'];
        }

        if (!empty($_GET['descripcion'])) {
            $sql .= ' AND descripcion LIKE :descripcion';
            $params[':descripcion'] = '%' . $_GET['descripcion'] . '%';
        }

        // Preparar y ejecutar la consulta
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        $resultados = $stmt->fetchAll();
    }
}
?>

<form method="GET">
    <label>Nombre:</label> <input type="text" name="nombre"><br>
    <label>Sexo:</label>
    <select name="sexo">
        <option value="">Todos</option>
        <option value="M">Macho</option>
        <option value="F">Hembra</option>
    </select><br>
    <label>Fecha de nacimiento:</label> <input type="date" name="fecha_nacimiento"><br>
    <label>Raza:</label> <input type="text" name="raza"><br>
    <label>Peso mínimo:</label> <input type="number" step="0.01" name="peso_min"><br>
    <label>Peso máximo:</label> <input type="number" step="0.01" name="peso_max"><br>
    <label>Edad mínima:</label> <input type="number" name="edad_min" min="0"><br>
    <label>Edad máxima:</label> <input type="number" name="edad_max" min="0"><br>
    <label>Descripción:</label> <input type="text" name="descripcion"><br>
    <button type="submit">Buscar</button>
</form>

<?php if (isset($filters_applied) && !empty($filters_applied)): ?>
    <h2>Resultados de la búsqueda:</h2>
    <?php if (!empty($resultados)): ?>
        <ul>
            <?php foreach ($resultados as $gato): ?>
                <li>
                    <?php echo htmlspecialchars($gato['nombre']); ?> - 
                    Sexo: <?php echo htmlspecialchars($gato['sexo']); ?> - 
                    Fecha de Nacimiento: <?php echo htmlspecialchars($gato['fecha_nacimiento']); ?> - 
                    Edad: <?php echo htmlspecialchars($gato['edad_calculada']); ?> años - 
                    Raza: <?php echo htmlspecialchars($gato['raza']); ?> - 
                    Peso: <?php echo htmlspecialchars($gato['peso']); ?> kg - 
                    Descripción: <?php echo htmlspecialchars($gato['descripcion']); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No se encontraron resultados.</p>
    <?php endif; ?>
<?php endif; ?>
