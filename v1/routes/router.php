<?php
/**
 * Public site routes.
 *
 * Two-segment URLs (/read-blog/<slug>) are matched first, then single-segment
 * pages. Anything unmatched falls through to the 404 view.
 * Fully supports query strings on all endpoints.
 */

$userHTTP    = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https://" : "http://";
$current_uri = $userHTTP . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

$uri = explode("/", $_SERVER['REQUEST_URI']);

$query_string = (!empty($_GET) && strpos($_SERVER['REQUEST_URI'], "?") !== false)
    ? explode("?", $_SERVER['REQUEST_URI'])[1]
    : "";

// Gated for Coming Soon / Maintenance mode: the site does not show at all
if (!empty($maintenance_status) && !isset($_SESSION['admin_id'])) {
    include APP_PATH . "/views/maintenance.php";
    die;
}

# ---------------------------------------------------------------------------
# Detail pages - /segment/<slug>
# ---------------------------------------------------------------------------
if (count($uri) > 2 && $uri[2] !== "") {

    $slug = strtok($uri[2], "?");
    $section = strtok($uri[1], "?");

    switch ($section) {

        case 'read-blog':
            include APP_PATH . "/views/blog-details.php";
            die;

        case 'view-initiative':
            include APP_PATH . "/views/initiative-details.php";
            die;

        case 'gallery':
            include APP_PATH . "/views/gallery.php";
            die;

        default:
            include APP_PATH . "/views/404.php";
            die;
    }
}

# ---------------------------------------------------------------------------
# Top-level pages
# ---------------------------------------------------------------------------
$page = strtok($uri[1] ?? '', "?");

switch ($page) {

    case '':
    case 'home':
        include APP_PATH . "/views/home.php";
        die;

    case 'about-us':
        include APP_PATH . "/views/about-us.php";
        die;

    case 'initiatives':
        include APP_PATH . "/views/initiatives.php";
        die;

    case 'volunteer':
        include APP_PATH . "/views/volunteer.php";
        die;

    case 'team':
        include APP_PATH . "/views/team.php";
        die;

    case 'gallery':
        include APP_PATH . "/views/gallery.php";
        die;

    case 'blog':
        include APP_PATH . "/views/blog.php";
        die;

    case 'contact-us':
        include APP_PATH . "/views/contact-us.php";
        die;

    case 'privacy-policy':
        include APP_PATH . "/views/privacy-policy.php";
        die;

    case 'terms-of-use':
        include APP_PATH . "/views/terms-of-use.php";
        die;

    case 'read-blog':
        $slug = $slug ?? $_GET['slug'] ?? $_GET['id'] ?? null;
        include APP_PATH . "/views/blog-details.php";
        die;

    case 'view-initiative':
        $slug = $slug ?? $_GET['slug'] ?? $_GET['id'] ?? null;
        include APP_PATH . "/views/initiative-details.php";
        die;

    default:
        include APP_PATH . "/views/404.php";
        die;
}
