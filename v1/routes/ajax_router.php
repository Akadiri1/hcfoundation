<?php
/**
 * Page-level AJAX endpoints.
 *
 * The generic CRUD endpoints (/add, /read, /put, /delete, /upload2server, ...)
 * are handled earlier by v1/ajax/ajax_router/router.php. This file is for
 * endpoints specific to HC Foundation's pages.
 */

$uri = explode("/", $_SERVER['REQUEST_URI']);

$query_string = (!empty($_GET) && strpos($_SERVER['REQUEST_URI'], "?") !== false)
    ? explode("?", $_SERVER['REQUEST_URI'])[1]
    : "";

switch ($uri[1]) {

    case 'contact-us-mail-backend':
        include APP_PATH . "/views/contact-us-mail-backend.php";
        die;
}
