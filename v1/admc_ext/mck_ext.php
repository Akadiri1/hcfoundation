<?php
/**
 * McKodev ADMC Admin Bridge
 * Authenticates an administrator via encrypted token from the ADMC extension.
 */
$referer = $_SERVER['HTTP_REFERER'] ?? '/admin-login';
$_SESSION['ext_redirect'] = $referer;

if (!isset($_GET['ext_link']) || !isset($_GET['admin'])) {
    header("Location: " . $referer);
    exit();
}

$adminId = base64url_decode($_GET['admin']);
$admin = selectContent($conn, "admin", ["hash_id" => $adminId]);

if (count($admin) < 1) {
    header("Location: " . $referer);
    exit();
}

$_SESSION['admin_id']       = $adminId;
$_SESSION['admin_username'] = $admin[0]['username'] ?? $admin[0]['input_username'] ?? 'admin';
$_SESSION['admin_level']    = $admin[0]['level'] ?? 'MASTER';
$_SESSION['admin_email']    = $admin[0]['email'] ?? $admin[0]['input_email'] ?? '';

header("Location: " . $_GET['ext_link']);
exit();
