<?php
$page_title = 'Privacy Policy';
$page_meta  = "How HC Foundation collects, uses and protects your personal information.";
include APP_PATH . "/views/includes/header.php";

$hero_section    = 'settings_privacy_policy';
$hero_crumb      = admc_section('settings_footer')['input_privacy_link'];
$hero_crumb_admc = admc_edit('settings_footer', admc_section('settings_footer')['id']);
include APP_PATH . "/views/includes/partials/page-hero.php";

$legal     = admc_section('settings_privacy_policy');
$legalEdit = admc_edit('settings_privacy_policy', $legal['id']);
include APP_PATH . "/views/includes/partials/legal-body.php";

include APP_PATH . "/views/includes/footer.php";
