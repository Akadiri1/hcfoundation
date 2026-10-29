<?php
/**
 * ADMC Extension Router
 * Routes /mck_ext requests to establish the admin session bridge.
 */
$uri = explode("/", $_SERVER['REQUEST_URI']);
$action = strtok($uri[1] ?? '', '?');

if ($action === "mck_ext") {
    include APP_PATH . "/admc_ext/mck_ext.php";
    die();
}
