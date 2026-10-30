<?php
$page_title = 'Terms of Use';
$page_meta  = "The terms that apply when you use the HC Foundation website.";
include APP_PATH . "/views/includes/header.php";

$hero_section    = 'settings_terms_of_use';
$hero_crumb      = admc_section('settings_footer')['input_terms_link'];
$hero_crumb_admc = admc_edit('settings_footer', admc_section('settings_footer')['id']);
include APP_PATH . "/views/includes/partials/page-hero.php";

$legal     = admc_section('settings_terms_of_use');
$legalEdit = admc_edit('settings_terms_of_use', $legal['id']);
include APP_PATH . "/views/includes/partials/legal-body.php";

include APP_PATH . "/views/includes/footer.php";
