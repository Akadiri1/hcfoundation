<?php
/**
 * Authentication Router
 * Routes all auth endpoints (/login, /signup, /verify, /forgotPassword, etc.)
 * Works with or without query strings (e.g. /login?rd=/admin or /verify?token=xyz).
 */
$rawPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';
$uri = explode('/', $rawPath);
$action = $uri[1] ?? '';

$token = $_GET['token'] ?? null;

switch ($action) {

    case "verify":
        include APP_PATH . "/auth/verify_registration.php";
        die;

    case "forgotPassword":
        include APP_PATH . "/auth/forgot_password.php";
        die;

    case "forgotPassword2":
        include APP_PATH . "/auth/forgot_password2.php";
        die;

    case "confirmRecovery":
        include APP_PATH . "/auth/confirm_recovery.php";
        die;

    case "login":
        include APP_PATH . "/auth/login.php";
        die;

    case "signup":
        include APP_PATH . "/auth/signup.php";
        die;

    case "secure":
        include APP_PATH . "/auth/secure.php";
        die;

    case "confirm":
        include APP_PATH . "/auth/confirm.php";
        die;

    case "changePassword":
        include APP_PATH . "/auth/change_password.php";
        die;
}
