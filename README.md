# Sistema de Gestión de Productos — CRUD PHP + PostgreSQL

Proyecto académico · Ingeniería Civil en Informática · Universidad de Los Lagos

**Integrantes:** Nicolás Paredes

## Cómo ejecutar en GitHub Codespaces

### 1. Abrir el Codespace
Botón verde **Code** → pestaña **Codespaces** → **Create codespace on main**.

Espera ~3 minutos. El Codespace instala PHP, PostgreSQL, crea la base de datos y carga los datos de ejemplo **automáticamente**.

### 2. Iniciar el servidor PHP
En la terminal del Codespace:

```bash
php -S 0.0.0.0:8080 -t /workspaces/$(ls /workspaces | head -1)
```

### 3. Abrir la app
Pestaña **Ports** → puerto **8080** → ícono de globo 🌐

La URL pública tendrá el formato: `[https://XXXX-8080.app.github.dev](https://effective-space-parakeet-pxjxp6xx75jf7499-8080.app.github.dev/)`

## Estructura
```
├── .devcontainer/       ← configuración del Codespace (no tocar)
├── db/schema.sql        ← crea la tabla productos
├── assets/              ← CSS y mockup
├── index.php            ← portada del proyecto
├── listar.php           ← READ
├── crear.php            ← CREATE
├── editar.php           ← UPDATE
├── eliminar.php         ← DELETE
└── conexion.php         ← conexión PDO a PostgreSQL
```
