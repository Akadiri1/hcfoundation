<?php
/**
 * ADMC Content Update Handler
 * Toggles visibility, user levels, and status across tables.
 */
if (!isset($_SESSION['admin_id'])) {
    header("Location: /admin-login");
    die;
}

if (!empty($_GET['id']) && !empty($_GET['data'])) {
    $table = preg_replace('/[^a-zA-Z0-9_]/', '', $_GET['data']);
    $params = $_GET;
    unset($params['id'], $params['data']);

    if (!empty($params)) {
        updateContent($conn, $table, $params, ['id' => (int)$_GET['id']]);
    }
}

$ref = $_SERVER['HTTP_REFERER'] ?? '/admin';
header("Location: $ref");
die;
