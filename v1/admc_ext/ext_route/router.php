<?php
/**
 * ADMC Extension Router
 * Routes /mck_ext requests to establish the admin session bridge.
 */
$rawPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';
$uri = explode('/', $rawPath);
$action = $uri[1] ?? '';

if ($action === "mck_ext") {
    include APP_PATH . "/admc_ext/mck_ext.php";
    die();
}
