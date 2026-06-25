<?php
require 'conexion.php';

$busqueda = trim($_GET['q'] ?? '');

if ($busqueda !== '') {
    $stmt = $pdo->prepare("SELECT * FROM productos WHERE nombre ILIKE :q OR categoria ILIKE :q ORDER BY id DESC");
    $stmt->execute(['q' => '%' . $busqueda . '%']);
} else {
    $stmt = $pdo->query("SELECT * FROM productos ORDER BY id DESC");
}
$productos = $stmt->fetchAll();

$titulo_pagina = 'Productos';
$active = 'listar';
include 'header.php';
?>

<div class="page">
  <div class="page-head">
    <div>
      <h1>Libro de productos</h1>
      <p>Operación <strong>Leer (R)</strong>: listado completo desde la tabla <code>productos</code>.</p>
    </div>
    <a href="crear.php" class="btn btn-primary">+ Agregar producto</a>
  </div>

  <?php if (isset($_GET['ok'])): ?>
    <div class="alert alert-ok">
      <?php
        $mensajes = [
          'creado'      => 'Producto agregado correctamente.',
          'actualizado' => 'Producto actualizado correctamente.',
          'eliminado'   => 'Producto eliminado correctamente.',
        ];
        echo htmlspecialchars($mensajes[$_GET['ok']] ?? 'Operación realizada con éxito.');
      ?>
    </div>
  <?php endif; ?>

  <form method="get" action="listar.php" style="margin-bottom: 18px; display:flex; gap:8px;">
    <input type="text" name="q" placeholder="Buscar por nombre o categoría..."
           value="<?= htmlspecialchars($busqueda) ?>"
           style="flex:1; padding:10px 12px; border:1px solid var(--color-border); border-radius:8px; font-family:inherit;">
    <button type="submit" class="btn btn-ghost">Buscar</button>
    <?php if ($busqueda !== ''): ?><a href="listar.php" class="btn btn-ghost">Limpiar</a><?php endif; ?>
  </form>

  <div class="card">
    <?php if (count($productos) === 0): ?>
      <div class="empty-state">No hay productos que coincidan con tu búsqueda.</div>
    <?php else: ?>
      <table class="ledger">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Estado</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($productos as $p): ?>
            <?php
              $stock = (int) $p['stock'];
              if ($stock === 0)      { $pill = 'pill-out'; $texto = 'Sin stock'; }
              elseif ($stock < 10)   { $pill = 'pill-low'; $texto = 'Stock bajo'; }
              else                   { $pill = 'pill-ok';  $texto = 'Disponible'; }
            ?>
            <tr>
              <td>#<?= (int) $p['id'] ?></td>
              <td><strong><?= htmlspecialchars($p['nombre']) ?></strong><br>
                  <span style="color:var(--color-ink-muted); font-size:0.82rem;"><?= htmlspecialchars($p['descripcion'] ?? '') ?></span>
              </td>
              <td><?= htmlspecialchars($p['categoria'] ?? '—') ?></td>
              <td class="num">$<?= number_format((float) $p['precio'], 0, ',', '.') ?></td>
              <td class="num"><?= $stock ?></td>
              <td><span class="pill <?= $pill ?>"><span class="pill-dot"></span><?= $texto ?></span></td>
              <td class="actions">
                <a href="editar.php?id=<?= (int) $p['id'] ?>" class="btn btn-edit btn-sm">Editar</a>
                <a href="eliminar.php?id=<?= (int) $p['id'] ?>" class="btn btn-danger btn-sm"
                   onclick="return confirm('¿Eliminar el producto «<?= htmlspecialchars($p['nombre'], ENT_QUOTES) ?>»? Esta acción no se puede deshacer.');">Eliminar</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
  </div>
</div>

<?php include 'footer.php'; ?>
