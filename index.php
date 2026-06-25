<?php
$titulo_pagina = 'Inicio';
$active = 'inicio';
include 'header.php';
?>

<div class="page">

  <div class="page-head">
    <div>
      <h1>Sistema de Gestión de Productos</h1>
      <p>Proyecto académico · Ingeniería Civil en Informática · Universidad de Los Lagos</p>
    </div>
    <a href="listar.php" class="btn btn-primary">Entrar a la aplicación →</a>
  </div>

  <!-- Integrantes -->
  <section class="card" style="padding: 24px 28px; margin-bottom: 24px;">
    <h2 style="font-size: 1.1rem; margin-bottom: 10px;">Integrantes del grupo</h2>
    <ul style="margin: 0; padding-left: 18px; color: var(--color-ink);">
      <li>Nicolás</li>
    </ul>
  </section>

  <!-- Descripción de la aplicación -->
  <section class="card" style="padding: 24px 28px; margin-bottom: 24px;">
    <h2 style="font-size: 1.1rem; margin-bottom: 10px;">Descripción de la aplicación</h2>
    <p style="color: var(--color-ink);">
      Esta aplicación web permite administrar el inventario de productos de un pequeño comercio.
      Resuelve un problema común: mantener un registro centralizado y siempre actualizado de qué
      productos existen, en qué categoría se clasifican, a qué precio se venden y cuántas unidades
      quedan disponibles en bodega.
    </p>
    <p style="color: var(--color-ink);">
      El sistema está construido en <strong>PHP 8</strong> (sin frameworks, usando PDO para el acceso
      a datos) y almacena la información en una base de datos <strong>PostgreSQL</strong>. Toda la
      aplicación se ejecuta dentro de un contenedor de desarrollo (<em>devcontainer</em>) configurado
      para <strong>GitHub Codespaces</strong>, lo que permite levantar tanto el servidor PHP como la
      base de datos con un solo clic, sin instalar nada de forma local.
    </p>
    <p style="color: var(--color-ink); margin-bottom: 0;">
      La interfaz se organiza en un menú simple con tres secciones: <em>Inicio</em> (esta página de
      presentación del proyecto), <em>Productos</em> (listado completo con buscador) y
      <em>Agregar producto</em> (formulario de ingreso). Desde el listado, cada fila permite editar
      o eliminar el producto correspondiente, completando así las cuatro operaciones CRUD sobre la
      tabla <code>productos</code>.
    </p>
  </section>

  <!-- Operaciones CRUD -->
  <section class="card" style="padding: 24px 28px; margin-bottom: 24px;">
    <h2 style="font-size: 1.1rem; margin-bottom: 14px;">Operaciones CRUD</h2>

    <div style="display: grid; gap: 14px;">
      <div style="display:flex; gap:14px; align-items:flex-start;">
        <span class="pill pill-ok" style="flex-shrink:0;">Crear</span>
        <p style="margin:0; color: var(--color-ink);">
          <strong>Archivo:</strong> <code>crear.php</code>. Muestra un formulario (nombre, descripción,
          categoría, precio y stock), valida los datos en el servidor y ejecuta un
          <code>INSERT</code> preparado con PDO para agregar el nuevo registro a la tabla
          <code>productos</code>.
        </p>
      </div>
      <div style="display:flex; gap:14px; align-items:flex-start;">
        <span class="pill pill-ok" style="flex-shrink:0;">Leer</span>
        <p style="margin:0; color: var(--color-ink);">
          <strong>Archivo:</strong> <code>listar.php</code>. Ejecuta un <code>SELECT</code> sobre la
          tabla <code>productos</code> y despliega los resultados en una tabla, con un buscador por
          nombre o categoría y un indicador visual del nivel de stock de cada producto.
        </p>
      </div>
      <div style="display:flex; gap:14px; align-items:flex-start;">
        <span class="pill pill-low" style="flex-shrink:0;">Modificar</span>
        <p style="margin:0; color: var(--color-ink);">
          <strong>Archivo:</strong> <code>editar.php</code>. Recibe el <code>id</code> del producto,
          carga sus datos actuales en un formulario pre-rellenado y, al guardar, ejecuta un
          <code>UPDATE</code> preparado con PDO sobre ese registro.
        </p>
      </div>
      <div style="display:flex; gap:14px; align-items:flex-start;">
        <span class="pill pill-out" style="flex-shrink:0;">Eliminar</span>
        <p style="margin:0; color: var(--color-ink);">
          <strong>Archivo:</strong> <code>eliminar.php</code>. Solicita confirmación al usuario
          (cuadro de diálogo en JavaScript) y luego ejecuta un <code>DELETE</code> preparado con PDO
          para quitar el producto de la tabla <code>productos</code>.
        </p>
      </div>
    </div>
  </section>

  <!-- Mockup -->
  <section class="card" style="padding: 24px 28px;">
    <h2 style="font-size: 1.1rem; margin-bottom: 6px;">Mockup de la interfaz principal</h2>
    <p style="color: var(--color-ink-muted); margin-top:0; margin-bottom: 16px; font-size: 0.88rem;">
      Vista previa de la pantalla de listado de productos (operación Leer), punto de entrada principal
      de la aplicación.
    </p>
    <img src="assets/mockup.png" alt="Mockup de la pantalla de listado de productos"
         style="width:100%; border-radius: 8px; border: 1px solid var(--color-border); display:block;">
  </section>

</div>

<?php include 'footer.php'; ?>
