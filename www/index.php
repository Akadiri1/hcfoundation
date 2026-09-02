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
            setcookie("id", $_SESSION['user_id'], time() + 31536000, '/', null, null, true);
        }
    }

    if (getenv("ADMC_USERNAME")) {
        setcookie("admc", getenv("ADMC_USERNAME"), time() + 31536000, "/", null, false, false);
    }

    $websiteInfo = selectContent($conn, "settings_website_info", ['visibility' => 'show']);
    $mailConfig  = selectContent($conn, "read_mail_config", []);
    $socialLinks = selectContent($conn, "panel_social_media_platform", ['visibility' => "show"]);

    $site_name          = $websiteInfo[0]['input_name'] ?? getenv('APP_NAME');
    $site_email         = $websiteInfo[0]['input_email'] ?? '';
    $site_phone         = $websiteInfo[0]['input_phone_number'] ?? '';
    $site_address       = $websiteInfo[0]['input_address'] ?? '';
    $description        = $websiteInfo[0]['text_description'] ?? '';
    $logo_directory     = $websiteInfo[0]['image_1'] ?? '/assets/images/logo.png';
    $maintenance_status = $websiteInfo[0]['maintenance_status'] ?? 0;

    $mailUsername       = $mailConfig[0]['input_mail_username'] ?? '';
    $mailSender         = $mailConfig[0]['input_sender'] ?? '';
    $mailPassword       = $mailConfig[0]['input_password'] ?? '';
    $mailSmtpHost       = $mailConfig[0]['input_smtp_host'] ?? '';
    $mailSmtpPort       = $mailConfig[0]['input_smtp_port'] ?? '';
    $mailSmtpSecureType = $mailConfig[0]['input_smtp_secure_type'] ?? '';

    $metaTitle       = $site_name;
    $metaDescription = $description;
    $metaImage       = $logo_directory;
    $icon            = $logo_directory;
}

# ---------------------------------------------------------------------------
# Routing - order matters, first match wins and dies
# ---------------------------------------------------------------------------
if (!$designMode) {
    include APP_PATH . "/ajax/ajax_router/router.php";
    include APP_PATH . "/admc_ext/ext_route/router.php";
    include APP_PATH . "/routes/admin_router.php";
}

include APP_PATH . "/routes/ajax_router.php";
include APP_PATH . "/routes/router.php";
