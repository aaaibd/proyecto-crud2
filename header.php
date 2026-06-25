<?php
// $active define qué item del menú se marca como activo en cada página
$active = $active ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= isset($titulo_pagina) ? htmlspecialchars($titulo_pagina) . ' · ' : '' ?>Inventario</title>
<link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="topbar">
  <div class="topbar-inner">
    <div class="brand">
      <span class="brand-mark">📒 Inventario</span>
      <span class="brand-tag">Gestión de productos</span>
    </div>
    <nav class="nav">
      <a href="index.php" class="<?= $active === 'inicio' ? 'active' : '' ?>">Inicio</a>
      <a href="listar.php" class="<?= $active === 'listar' ? 'active' : '' ?>">Productos</a>
      <a href="crear.php" class="<?= $active === 'crear' ? 'active' : '' ?>">Agregar producto</a>
    </nav>
  </div>
</div>
