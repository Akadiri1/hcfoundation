<?php
/**
 * ---------------------------------------------------------------------------
 * DATABASE-DRIVEN CONTENT LOADER
 * ---------------------------------------------------------------------------
 * When DESIGN_MODE=false, this file is loaded by www/index.php.
 * It queries all CMS and settings tables and maps them into the exact
 * variable structures expected by the views.
 *
 * Every mapped item keeps its row 'id' so the views can emit the ADMC
 * live-edit attributes (data-admc-id). $site_id is the settings row id.
 *
 * Page copy (headings, intros, buttons, section images) comes from the
 * settings_* and panel_* tables listed in views/includes/page_content.php,
 * loaded into $sections and $panels at the end of this file.
 * ---------------------------------------------------------------------------
 */

require_once APP_PATH . "/views/includes/partials/admc.php";

$rowImage = function (array $row): string {
    return admc_src($row);
};

# --- 1. Settings & Identity -------------------------------------------------
$websiteInfo = selectContent($conn, "settings_website_info", ['visibility' => 'show']);
$siteRow     = $websiteInfo[0] ?? [];
$site_id     = $siteRow['id'] ?? null;

$site_name       = $siteRow['input_name'] ?? getenv('APP_NAME');
$site_short      = $siteRow['input_short_name'] ?? 'HC Foundation';
$site_tagline    = $siteRow['input_tagline'] ?? 'Restoring Hope. Transforming Lives.';
$site_promise    = $siteRow['text_promise'] ?? 'HC Foundation exists to stand with communities where support is scarce — turning compassion into practical, lasting change.';
$description     = $siteRow['text_description'] ?? 'A humanitarian-focused organization committed to improving lives through service, compassion, and action.';

$site_email      = $siteRow['input_email'] ?? 'contact@hcfoundations.com';
$site_phone      = $siteRow['input_phone_number'] ?? '+1 770-727-6969';
$site_address    = $siteRow['input_address'] ?? 'Lagos, Nigeria';

$logo_directory  = $siteRow['input_logo'] ?? '/assets/images/logo.png';
$metaTitle       = $site_name;
$metaDescription = $description;
$metaImage       = $logo_directory;
$icon            = $logo_directory;
$siteKeywords    = ["HC Foundation", "Hathany Cosmos Foundation", "humanitarian", "community outreach", "nonprofit"];

$maintenance_status = (getenv('COMING_SOON') === 'true' || getenv('MAINTENANCE_MODE') === 'true')
    ? 1
    : (int)($siteRow['maintenance_status'] ?? 0);

# --- 2. About, Vision, Mission ----------------------------------------------
$about_who        = $siteRow['text_about_who'] ?? 'HC Foundation is a humanitarian-focused organization committed to improving lives through service, compassion, and action. We work with communities to identify needs and deliver support that is both meaningful and sustainable.';
$about_approach   = $siteRow['text_about_approach'] ?? 'Our approach is people-centered, transparent, and driven by a deep sense of responsibility to those we serve.';
$vision           = $siteRow['text_vision'] ?? 'To build communities where hope is restored, dignity is upheld, and opportunities are accessible to all.';
$mission          = $siteRow['text_mission'] ?? 'To serve and empower individuals and communities through impactful humanitarian initiatives, education support, health awareness, and community development.';
$volunteer_intro  = $siteRow['text_volunteer_intro'] ?? 'Volunteers are a vital part of our mission. By giving your time, skills, and passion, you help extend our reach and deepen our impact.';
$team_intro       = $siteRow['text_team_intro'] ?? 'HC Foundation is led by dedicated individuals committed to service, leadership, and impact.';

# --- 3. Mail Config ---------------------------------------------------------
$mailConfig         = selectContent($conn, "read_mail_config", []);
$mailRow            = $mailConfig[0] ?? [];
$mailUsername       = $mailRow['input_mail_username'] ?? '';
$mailSender         = $mailRow['input_sender'] ?? '';
$mailPassword       = $mailRow['input_password'] ?? '';
$mailSmtpHost       = $mailRow['input_smtp_host'] ?? '';
$mailSmtpPort       = $mailRow['input_smtp_port'] ?? '';
$mailSmtpSecureType = $mailRow['input_smtp_secure_type'] ?? '';

# --- 4. Social Links --------------------------------------------------------
$rawSocial = selectContent($conn, "panel_social_media_platform", ['visibility' => 'show']);
$socialLinks = [];
foreach ($rawSocial as $row) {
    $socialLinks[] = [
        'id'   => $row['id'],
        'name' => $row['input_name'],
        'url'  => $row['input_url'],
        'icon' => $row['input_icon'] ?? 'facebook',
    ];
}

# --- 5. Photography & Imagery Helpers ---------------------------------------
// Placeholder photo URLs. Page images now come from the page content tables
// (section 16); this helper stays for any view that still needs a stock shot.
$img = function (string $id, int $w = 1200, int $h = 900): string {
    return "https://images.unsplash.com/{$id}?auto=format&fit=crop&w={$w}&h={$h}&q=80";
};

# --- 6. Initiatives ---------------------------------------------------------
$rawInitiatives = selectContent($conn, "panel_initiatives", ['visibility' => 'show']);
$initiatives = [];
foreach ($rawInitiatives as $row) {
    $initiatives[] = [
        'id'          => $row['id'],
        'slug'        => $row['input_slug'],
        'title'       => $row['input_title'],
        'summary'     => $row['text_summary'] ?? '',
        'programme'   => $row['input_programme'],
        'description' => $row['text_description'] ?? '',
        'body'        => $row['text_body'] ?? '',
        'icon'        => $row['input_icon'] ?? 'hands',
        'image'       => $rowImage($row),
        'accent'      => $row['input_accent'] ?? 'teal',
        'content'     => $row['text_content'] ?? null,
        'approach'    => $row['input_approach'] ?? null,
        'status'      => $row['input_status'] ?? null,
        'reach'       => $row['input_reach'] ?? null,
    ];
}

# --- 7. Impact Stats --------------------------------------------------------
$rawImpact = selectContent($conn, "panel_impact_stats", ['visibility' => 'show']);
$impact_stats = [];
foreach ($rawImpact as $row) {
    $impact_stats[] = [
        'id'     => $row['id'],
        'value'  => (int)$row['input_value'],
        'suffix' => $row['input_suffix'] ?? '',
        'label'  => $row['input_label'],
        'note'   => $row['input_note'] ?? '',
    ];
}

# --- 8. Core Values ---------------------------------------------------------
$rawValues = selectContent($conn, "panel_core_values", ['visibility' => 'show']);
$core_values = [];
foreach ($rawValues as $row) {
    $core_values[] = [
        'id'    => $row['id'],
        'title' => $row['input_title'],
        'body'  => $row['text_body'] ?? '',
        'icon'  => $row['input_icon'] ?? 'heart',
    ];
}

# --- 9. Volunteer Benefits & Roles ------------------------------------------
$rawBenefits = selectContent($conn, "panel_volunteer_benefits", ['visibility' => 'show']);
$volunteer_benefits = [];
foreach ($rawBenefits as $row) {
    $volunteer_benefits[] = [
        'id'    => $row['id'],
        'title' => $row['input_title'],
        'body'  => $row['text_body'] ?? '',
    ];
}

$rawRoles = selectContent($conn, "panel_volunteer_roles", ['visibility' => 'show']);
$volunteer_roles = [];
foreach ($rawRoles as $row) {
    $volunteer_roles[] = [
        'id'    => $row['id'],
        'title' => $row['input_title'],
        'body'  => $row['text_body'] ?? '',
        'icon'  => $row['input_icon'] ?? 'hands',
    ];
}

# --- 10. Team Groups --------------------------------------------------------
// Group headings come from panel_team_groups (see the page content block at
// the end of this file); members join a group by panel_team.input_group.
$rawTeam = selectContent($conn, "panel_team", ['visibility' => 'show']);
$team_grouped = [];

foreach ($rawTeam as $row) {
    $grp = $row['input_group'] ?? 'Operations Team';
    $team_grouped[$grp][] = [
        'id'       => $row['id'],
        'name'     => $row['input_name'],
        'role'     => $row['input_role'],
        'image'    => $rowImage($row),
        'linkedin' => $row['input_linkedin'] ?? '',
        'x'        => $row['input_x'] ?? '',
        'email'    => $row['input_email'] ?? '',
    ];
}

# --- 11. Donate Configuration -----------------------------------------------
$donate = [
    'channel'          => $siteRow['input_donate_channel'] ?? 'whatsapp',
    'whatsapp_number'  => $siteRow['input_donate_whatsapp'] ?? '2348000000000',
    'whatsapp_message' => $siteRow['text_donate_message'] ?? 'Hello HC Foundation, I would like to make a donation.',
    'flutterwave_url'  => $siteRow['input_donate_flutterwave'] ?? '',
];

$donate['url'] = $donate['channel'] === 'flutterwave'
    ? $donate['flutterwave_url']
    : 'https://wa.me/' . $donate['whatsapp_number'] . '?text=' . rawurlencode($donate['whatsapp_message']);

$donate['label'] = $donate['channel'] === 'flutterwave' ? 'Donate with Flutterwave' : 'Donate via WhatsApp';
$donate['icon']  = $donate['channel'] === 'flutterwave' ? 'gift' : 'whatsapp';
$donate['note']  = $donate['channel'] === 'flutterwave'
    ? 'You will be taken to our secure Flutterwave page.'
    : 'Opens a WhatsApp chat so we can share account details with you directly.';

# --- 12. Gallery ------------------------------------------------------------
$rawGallery = selectContent($conn, "panel_gallery", ['visibility' => 'show']);
$gallery_categories = [];
$gallery_items = [];
foreach ($rawGallery as $row) {
    $cat = $row['input_category'];
    if (!in_array($cat, $gallery_categories, true)) {
        $gallery_categories[] = $cat;
    }
    $gallery_items[] = [
        'id'       => $row['id'],
        'category' => $cat,
        'caption'  => $row['input_caption'],
        'image'    => $rowImage($row),
    ];
}

# --- 13. Blog ---------------------------------------------------------------
$rawBlog = selectContent($conn, "panel_blog", ['visibility' => 'show']);
$blog_categories = [];
$blog_posts = [];
foreach ($rawBlog as $row) {
    $cat = $row['input_category'] ?: 'Impact Stories';
    if (!in_array($cat, $blog_categories, true)) {
        $blog_categories[] = $cat;
    }
    $blog_posts[] = [
        'id'       => $row['id'],
        'slug'     => $row['input_slug'],
        'title'    => $row['input_title'],
        'excerpt'  => $row['text_excerpt'] ?? '',
        'category' => $cat,
        'date'     => $row['input_date'] ?? '',
        'read'     => $row['input_read_time'] ?: '5 min read',
        'image'    => $rowImage($row),
        'author'   => $row['input_author'] ?: 'HC Foundation',
        'content'  => $row['text_content'] ?? null,
    ];
}

# --- 14. FAQ (Contact Page) -------------------------------------------------
$rawFaqs = selectContent($conn, "panel_faqs", ['visibility' => 'show']);
$faqs = [];
foreach ($rawFaqs as $row) {
    $faqs[] = [
        'id' => $row['id'],
        'q'  => $row['input_question'],
        'a'  => $row['text_answer'] ?? '',
    ];
}

# --- 15. Partners -----------------------------------------------------------
$rawPartners = selectContent($conn, "panel_partners", ['visibility' => 'show']);
$partners = [];
foreach ($rawPartners as $row) {
    $partners[] = [
        'id'   => $row['id'],
        'name' => $row['input_name'],
    ];
}

# --- 16. Page content (ADMC live edit) --------------------------------------
// settings_* tables: one row each, merged over the defaults so a missing or
// half-filled row still renders. panel_* tables: their rows, or the defaults
// when the table has not been created yet (migration not run). The tables
// are checked first because selectContent() dies on a missing table.
$pageContent  = require APP_PATH . "/views/includes/page_content.php";
$existingTables = $conn->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);

$sections = [];
foreach ($pageContent['settings'] as $table => $defaults) {
    $row = in_array($table, $existingTables, true)
        ? (selectContent($conn, $table, [])[0] ?? [])
        : [];
    $section = ['id' => $row['id'] ?? null];
    foreach ($defaults as $column => $default) {
        $section[$column] = (isset($row[$column]) && $row[$column] !== null) ? $row[$column] : $default;
    }
    $sections[$table] = $section;
}

$panels = [];
foreach ($pageContent['panels'] as $table => $defaults) {
    if (in_array($table, $existingTables, true)) {
        $panels[$table] = selectContent($conn, $table, ['visibility' => 'show']);
    } else {
        $panels[$table] = array_map(function ($row) { return ['id' => null] + $row; }, $defaults);
    }
}

// Team groups, in panel order, with the members whose input_group matches.
$team_groups = [];
foreach ($panels['panel_team_groups'] as $groupRow) {
    $title = $groupRow['input_title'];
    $team_groups[] = [
        'id'      => $groupRow['id'],
        'title'   => $title,
        'body'    => $groupRow['text_body'] ?? '',
        'members' => $team_grouped[$title] ?? [],
    ];
    unset($team_grouped[$title]);
}
// Members whose group has no panel_team_groups row still appear.
foreach ($team_grouped as $title => $members) {
    $team_groups[] = ['id' => null, 'title' => $title, 'body' => '', 'members' => $members];
}

// Initiative and blog bodies fall back to the default copy until filled in.
foreach ($initiatives as $i => $item) {
    foreach (['content' => 'text_content', 'approach' => 'input_approach', 'status' => 'input_status', 'reach' => 'input_reach'] as $key => $column) {
        if ($item[$key] === null || $item[$key] === '') {
            $initiatives[$i][$key] = $pageContent['row_defaults']['panel_initiatives'][$column];
        }
    }
}
foreach ($blog_posts as $i => $post) {
    if ($post['content'] === null || $post['content'] === '') {
        $blog_posts[$i]['content'] = $pageContent['row_defaults']['panel_blog']['text_content'];
    }
}

// The home hero collage and its avatar strip both read panel_home_hero_images.
$hero_images = [];
foreach ($panels['panel_home_hero_images'] as $row) {
    $hero_images[] = ['id' => $row['id'], 'src' => admc_src($row), 'alt' => $row['input_alt'] ?? ''];
}
