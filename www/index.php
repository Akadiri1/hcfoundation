<?php
/**
 * Hathany Cosmos Foundation - application entry point.
 *
 * Every request is rewritten here by the root .htaccess. This file boots the
 * framework, loads site-wide content, then hands the request to the routers.
 *
 * DESIGN_MODE (set in .env/config.php) renders the site from a static content
 * file instead of the database, so the front end can be built and reviewed
 * before the CMS tables exist. The variable names are identical either way,
 * so switching over is a change here and nowhere else.
 */

ob_start();
session_start();

$_SESSION['active'] = true;

# ---------------------------------------------------------------------------
# Paths + framework bootstrap
# ---------------------------------------------------------------------------
define("D_PATH", dirname(dirname(__FILE__)));
define("MAIN_PATH", dirname(dirname(__FILE__)));

require_once D_PATH . "/core/autoload.php";
const APP_PATH = D_PATH . "/v1";

include D_PATH . "/.env/config.php";

$designMode = getenv('DESIGN_MODE') === 'true';

# ---------------------------------------------------------------------------
# Request context
# ---------------------------------------------------------------------------
$userHTTP    = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https://" : "http://";
$domain      = $_SERVER['HTTP_HOST'];
$current_uri = $userHTTP . $domain . $_SERVER['REQUEST_URI'];

// Hosts permitted to POST to the form backends. Add the live domain on deploy.
$allowedHeaders = ["localhost", "hcfoundation.local", "hcfoundation.test"];

# ---------------------------------------------------------------------------
# Content
# ---------------------------------------------------------------------------
if ($designMode) {

    include APP_PATH . "/views/includes/static_content.php";

} else {

    require APP_PATH . "/models/model.php";
    require APP_PATH . "/controllers/controller.php";
    require APP_PATH . "/auth/auth_controller/controller.php";

    // Anonymous visitor id, used by view counters and similar features.
    if (!isset($_SESSION['user_id'])) {
        if (isset($_COOKIE['id'])) {
            $_SESSION['user_id'] = $_COOKIE['id'];
        } else {
            $_SESSION['user_id'] = md5(session_id());
            setcookie("id", $_SESSION['user_id'], time() + 31536000, '/', '', false, true);
        }
    }

    if (getenv("ADMC_USERNAME")) {
        setcookie("admc", getenv("ADMC_USERNAME"), time() + 31536000, "/", '', false, false);
    }

    include APP_PATH . "/models/db_content.php";
}

# ---------------------------------------------------------------------------
# Routing - order matters, first match wins and dies
# ---------------------------------------------------------------------------
// Gated for Coming Soon / Maintenance mode: the site does not show at all
if (!empty($maintenance_status) && !isset($_SESSION['admin_id'])) {
    include APP_PATH . "/views/maintenance.php";
    die;
}

if (!$designMode) {
    include APP_PATH . "/ajax/ajax_router/router.php";
    include APP_PATH . "/admc_ext/ext_route/router.php";
    include APP_PATH . "/auth/auth_router/router.php";
    include APP_PATH . "/routes/admin_router.php";
}

include APP_PATH . "/routes/ajax_router.php";
include APP_PATH . "/routes/router.php";
