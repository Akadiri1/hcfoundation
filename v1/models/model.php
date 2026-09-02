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
    // Never leak connection details to visitors in production.
    if (getenv('PRODUCTION_MODE') === 'true') {
        http_response_code(503);
        die("The site is temporarily unavailable. Please try again shortly.");
    }
    die("Database connection failed (" . DBUSER . "@" . DBHOST . "/" . DBNAME . "): " . $e->getMessage());
}
