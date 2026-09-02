<?php
/**
 * Database connection. $conn is used throughout the app and admin panel.
 */

define("DBHOST", getenv('DB_HOST') ?: 'localhost');
define("DBNAME", getenv('DB_NAME'));
define("DBUSER", getenv('DB_USER'));
define("DBPASS", getenv('DB_PASSWORD'));

try {
    $conn = new PDO('mysql:host=' . DBHOST . ';dbname=' . DBNAME, DBUSER, DBPASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {

    /**
     * Fail closed.
     *
     * Details are shown only when the config explicitly says this is a local
     * environment. If PRODUCTION_MODE is missing, empty or unreadable — which
     * is exactly what happens when .env/config.php was never created on a
     * server — we must assume production and say nothing useful to a visitor,
     * rather than printing the database user, host and name onto the page.
     */
    $isLocal = getenv('PRODUCTION_MODE') === 'false';

    error_log('DB connection failed: ' . $e->getMessage());

    http_response_code(503);
    header('Retry-After: 300');

    if ($isLocal) {
        die('Database connection failed (' . DBUSER . '@' . DBHOST . '/' . DBNAME . '): ' . $e->getMessage());
    }

    die('The site is temporarily unavailable. Please try again shortly.');
}
