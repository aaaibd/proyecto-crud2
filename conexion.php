<?php
/**
 * Conexión a la base de datos PostgreSQL usando PDO.
 *
 * Los valores se pueden sobrescribir con variables de entorno
 * (DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASS). Si no existen,
 * se usan los valores por defecto que coinciden con
 * .devcontainer/docker-compose.yml
 */

$host = getenv('DB_HOST') ?: 'localhost';
$port = getenv('DB_PORT') ?: '5432';
$dbname = getenv('DB_NAME') ?: 'tienda';
$user = getenv('DB_USER') ?: 'postgres';
$pass = getenv('DB_PASS') ?: 'postgres';

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    die(
        '<div style="font-family: system-ui; max-width: 640px; margin: 60px auto; ' .
        'padding: 24px; border: 1px solid #f0d0c8; background: #fdf3f0; border-radius: 10px;">' .
        '<h2 style="margin-top:0;">No se pudo conectar a la base de datos</h2>' .
        '<p>Verifica que el contenedor de PostgreSQL esté corriendo en el Codespace.</p>' .
        '<p style="color:#888; font-size: 0.85rem;">Detalle técnico: ' . htmlspecialchars($e->getMessage()) . '</p>' .
        '</div>'
    );
}
