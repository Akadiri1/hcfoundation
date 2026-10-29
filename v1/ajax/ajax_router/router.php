<?php
/**
 * Generic AJAX Router
 * Matches single-segment CRUD endpoints (/add, /read, /put, /delete, etc.)
 * Works with or without query strings (e.g. /read?table=... or /put?id=...).
 */
$rawPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';
$uri = explode('/', $rawPath);
$action = $uri[1] ?? '';
$subsegment = $uri[2] ?? '';

// Only match single-segment AJAX calls (/add, /read, etc.)
// Multi-segment calls (/add/initiatives, /manage/blog) belong to the ADMC admin router.
if (empty($subsegment)) {

    switch ($action) {

        case "add":
            include APP_PATH . "/ajax/add.php";
            die;

        case "read":
            include APP_PATH . "/ajax/read.php";
            die;

        case "put":
            include APP_PATH . "/ajax/put.php";
            die;

        case "delete":
            include APP_PATH . "/ajax/delete.php";
            die;

        case "upload2server":
            include APP_PATH . "/ajax/upload2server.php";
            die;

        case "delete2server":
            include APP_PATH . "/ajax/delete2server.php";
            die;

        case "change2server":
            include APP_PATH . "/ajax/change2server.php";
            die;

        case "multiple2server":
            include APP_PATH . "/ajax/multiple2server.php";
            die;

        case "serialize":
            include APP_PATH . "/ajax/serialize.php";
            die;

        case "unserialize":
            include APP_PATH . "/ajax/unserialize.php";
            die;
    }
}
