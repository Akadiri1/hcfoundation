<?php
/**
 * Admin routes.
 *
 * The admin panel is table-driven: /add/<table>, /create/<table> and
 * /manage/<table> resolve against the generic builder views, so a new
 * content type needs a table and nothing else.
 *
 * Admin sessions are opened by the ADMC extension (/mck_ext), which sets
 * $_SESSION['admin_id'] before redirecting back here, or via /admin-login.
 */

$uri = explode("/", $_SERVER['REQUEST_URI']);

$id       = $_GET['id']       ?? NULL;
$data     = $_GET['data']     ?? NULL;
$location = $_GET['location'] ?? NULL;
$success  = $_GET['success']  ?? NULL;
$err      = $_GET['err']      ?? NULL;
$wn       = $_GET['wn']       ?? NULL;
$rd       = $_GET['rd']       ?? NULL;

$action = strtok($uri[1], '?');

# ---------------------------------------------------------------------------
# Generic table CRUD - /add/<table>, /create/<table>, /manage/<table>
# ---------------------------------------------------------------------------
if (count($uri) > 2 && $uri[2] !== "") {

    $placeholder = strtok($uri[2], '?');

    switch ($action) {

        case "add":
            include APP_PATH . "/admin/admin_add_all.php";
            die;

        case "create":
            include APP_PATH . "/admin/admin_add_select.php";
            die;

        case "manage":
            include APP_PATH . "/admin/manage_all.php";
            die;
    }
}

# ---------------------------------------------------------------------------
# ADMC Actions & Named Screens
# ---------------------------------------------------------------------------
switch ($action) {

    case 'admin':
    case 'dashboard':
    case 'admin-dashboard':
        include APP_PATH . "/admin/dashboard.php";
        die;

    case 'admin-login':
        include APP_PATH . "/admin/admin_login.php";
        die;

    case 'mck_ext':
        include APP_PATH . "/admc_ext/mck_ext.php";
        die;

    case 'admin-logout':
        unset($_SESSION['admin_id'], $_SESSION['admin_username'], $_SESSION['admin_level']);
        header("Location: /admin-login");
        die;

    case 'updateContent.php':
    case 'updateContent':
        include APP_PATH . "/admin/updateContent.php";
        die;

    case 'deleteContent.php':
    case 'deleteContent':
        include APP_PATH . "/admin/deleteContent.php";
        die;

    case 'admin-edit-content':
        include APP_PATH . "/admin/edit_content.php";
        die;

    case 'change-image':
        include APP_PATH . "/admin/change_image.php";
        die;

    case 'admin-add-blog':
        include APP_PATH . "/admin/create_blog.php";
        die;

    case 'admin-add-post':
    case 'admin-add-topic':
        include APP_PATH . "/admin/create_post.php";
        die;

    case 'admin-view-blog':
        include APP_PATH . "/admin/manage_blog.php";
        die;

    case 'admin-view-post':
        include APP_PATH . "/admin/manage_post.php";
        die;

    case 'admin-view-category':
        include APP_PATH . "/admin/manage_category.php";
        die;

    case 'admin-view-slider':
    case 'admin-edit-slider':
        include APP_PATH . "/admin/manage_slider.php";
        die;

    case 'admin-view-admin':
        include APP_PATH . "/admin/manage_admin.php";
        die;

    case 'admin-view-users':
        include APP_PATH . "/admin/manage_users.php";
        die;
}
