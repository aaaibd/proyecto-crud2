<?php
require 'conexion.php';

$id = (int) ($_GET['id'] ?? $_POST['id'] ?? 0);

$stmt = $pdo->prepare("SELECT * FROM productos WHERE id = :id");
$stmt->execute(['id' => $id]);
$producto = $stmt->fetch();

$titulo_pagina = 'Editar producto';
$active = 'listar';

if (!$producto) {
    include 'header.php';
    echo '<div class="page"><div class="card empty-state">No se encontró un producto con ese ID.
          <br><br><a href="listar.php" class="btn btn-ghost">Volver al listado</a></div></div>';
    include 'footer.php';
    exit;
}

$errores = [];
$valores = $producto;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $valores['nombre']      = trim($_POST['nombre'] ?? '');
    $valores['descripcion'] = trim($_POST['descripcion'] ?? '');
    $valores['categoria']   = trim($_POST['categoria'] ?? '');
    $valores['precio']      = trim($_POST['precio'] ?? '');
    $valores['stock']       = trim($_POST['stock'] ?? '');

    if ($valores['nombre'] === '') {
        $errores[] = 'El nombre del producto es obligatorio.';
    }
    if ($valores['precio'] === '' || !is_numeric($valores['precio']) || (float) $valores['precio'] < 0) {
        $errores[] = 'El precio debe ser un número mayor o igual a 0.';
    }
    if ($valores['stock'] === '' || !ctype_digit((string) $valores['stock'])) {
        $errores[] = 'El stock debe ser un número entero mayor o igual a 0.';
    }

    if (count($errores) === 0) {
        $stmt = $pdo->prepare(
            "UPDATE productos
             SET nombre = :nombre, descripcion = :descripcion, categoria = :categoria,
                 precio = :precio, stock = :stock
             WHERE id = :id"
        );
        $stmt->execute([
            'nombre'      => $valores['nombre'],
            'descripcion' => $valores['descripcion'],
            'categoria'   => $valores['categoria'],
            'precio'      => $valores['precio'],
            'stock'       => $valores['stock'],
            'id'          => $id,
        ]);

        header('Location: listar.php?ok=actualizado');
        exit;
    }
}

include 'header.php';
?>

<div class="page">
  <div class="page-head">
    <div>
      <h1>Editar producto #<?= $id ?></h1>
      <p>Operación <strong>Modificar (U)</strong>: actualiza el registro existente en la tabla <code>productos</code>.</p>
    </div>
  </div>

  <?php if (count($errores) > 0): ?>
    <div class="alert" style="background: var(--color-danger-soft); color: var(--color-danger);">
      <?php foreach ($errores as $e) echo '<div>• ' . htmlspecialchars($e) . '</div>'; ?>
    </div>
  <?php endif; ?>

  <form method="post" action="editar.php" class="card">
    <input type="hidden" name="id" value="<?= $id ?>">
    <div class="form-grid">
      <div class="field full">
        <label for="nombre">Nombre del producto *</label>
        <input type="text" id="nombre" name="nombre" maxlength="100" required
               value="<?= htmlspecialchars($valores['nombre']) ?>">
      </div>
      <div class="field full">
        <label for="descripcion">Descripción</label>
        <textarea id="descripcion" name="descripcion" rows="2"><?= htmlspecialchars($valores['descripcion'] ?? '') ?></textarea>
      </div>
      <div class="field">
        <label for="categoria">Categoría</label>
        <input type="text" id="categoria" name="categoria" maxlength="50"
               value="<?= htmlspecialchars($valores['categoria'] ?? '') ?>">
      </div>
      <div class="field">
        <label for="precio">Precio (CLP) *</label>
        <input type="number" id="precio" name="precio" min="0" step="1" required
               value="<?= htmlspecialchars($valores['precio']) ?>">
      </div>
      <div class="field">
        <label for="stock">Stock *</label>
        <input type="number" id="stock" name="stock" min="0" step="1" required
               value="<?= htmlspecialchars($valores['stock']) ?>">
      </div>
    </div>
    <div class="form-actions">
      <a href="listar.php" class="btn btn-ghost">Cancelar</a>
      <button type="submit" class="btn btn-primary">Guardar cambios</button>
    </div>
  </form>
</div>

<?php include 'footer.php'; ?>
