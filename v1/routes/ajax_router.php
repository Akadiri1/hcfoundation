<?php
/**
 * Page-level AJAX endpoints.
 *
 * The generic CRUD endpoints (/add, /read, /put, /delete, /upload2server, ...)
 * are handled earlier by v1/ajax/ajax_router/router.php. This file is for
 * endpoints specific to HC Foundation's pages.
 * Supports query strings on all endpoints.
 */

$uri = explode("/", $_SERVER['REQUEST_URI']);
$action = strtok($uri[1] ?? '', '?');

switch ($action) {

    case 'contact-us-mail-backend':
        include APP_PATH . "/views/contact-us-mail-backend.php";
        die;
}
