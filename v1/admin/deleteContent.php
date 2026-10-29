<?php
/**
 * ADMC Content Deletion Handler
 * Deletes records from panel_* and CMS tables.
 */
if (!isset($_SESSION['admin_id'])) {
    header("Location: /admin-login");
    die;
}

if (!empty($_GET['id']) && !empty($_GET['data'])) {
    $table = preg_replace('/[^a-zA-Z0-9_]/', '', $_GET['data']);
    deleteContent($conn, $table, ['id' => (int)$_GET['id']]);
}

$ref = $_SERVER['HTTP_REFERER'] ?? '/admin';
header("Location: $ref");
die;
