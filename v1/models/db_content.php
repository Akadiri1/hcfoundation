<?php
/**
 * ---------------------------------------------------------------------------
 * DATABASE-DRIVEN CONTENT LOADER
 * ---------------------------------------------------------------------------
 * When DESIGN_MODE=false, this file is loaded by www/index.php.
 * It queries all CMS and settings tables and maps them into the exact
 * variable structures expected by the views.
 * ---------------------------------------------------------------------------
 */

# --- 1. Settings & Identity -------------------------------------------------
$websiteInfo = selectContent($conn, "settings_website_info", ['visibility' => 'show']);
$siteRow     = $websiteInfo[0] ?? [];

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
        'name' => $row['input_name'],
        'url'  => $row['input_url'],
        'icon' => $row['input_icon'] ?? 'facebook',
    ];
}

# --- 5. Photography & Imagery Helpers ---------------------------------------
$img = function (string $id, int $w = 1200, int $h = 900): string {
    return "https://images.unsplash.com/{$id}?auto=format&fit=crop&w={$w}&h={$h}&q=80";
};

$hero_images = [
    $img('photo-1488521787991-ed7bbaae773c', 900, 1200),
    $img('photo-1509099836639-18ba1795216d', 800, 600),
    $img('photo-1517486808906-6ca8b3f04846', 800, 600),
];

$hero_avatars = [
    $img('photo-1488521787991-ed7bbaae773c', 120, 120),
    $img('photo-1509099836639-18ba1795216d', 120, 120),
    $img('photo-1517486808906-6ca8b3f04846', 120, 120),
];

# --- 6. Initiatives ---------------------------------------------------------
$rawInitiatives = selectContent($conn, "panel_initiatives", ['visibility' => 'show']);
$initiatives = [];
foreach ($rawInitiatives as $row) {
    $imgSrc = !empty($row['image_1']) ? '/' . ltrim($row['image_1'], '/') : ($row['input_image'] ?? '');
    $initiatives[] = [
        'slug'        => $row['input_slug'],
        'title'       => $row['input_title'],
        'summary'     => $row['text_summary'] ?? '',
        'programme'   => $row['input_programme'],
        'description' => $row['text_description'] ?? '',
        'body'        => $row['text_body'] ?? '',
        'icon'        => $row['input_icon'] ?? 'hands',
        'image'       => $imgSrc,
        'accent'      => $row['input_accent'] ?? 'teal',
    ];
}

# --- 7. Impact Stats --------------------------------------------------------
$rawImpact = selectContent($conn, "panel_impact_stats", ['visibility' => 'show']);
$impact_stats = [];
foreach ($rawImpact as $row) {
    $impact_stats[] = [
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
        'title' => $row['input_title'],
        'body'  => $row['text_body'] ?? '',
    ];
}

$rawRoles = selectContent($conn, "panel_volunteer_roles", ['visibility' => 'show']);
$volunteer_roles = [];
foreach ($rawRoles as $row) {
    $volunteer_roles[] = [
        'title' => $row['input_title'],
        'body'  => $row['text_body'] ?? '',
        'icon'  => $row['input_icon'] ?? 'hands',
    ];
}

# --- 10. Team Groups --------------------------------------------------------
$rawTeam = selectContent($conn, "panel_team", ['visibility' => 'show']);
$team_grouped = [
    'Board & Leadership' => [
        'title'   => 'Board & Leadership',
        'body'    => 'Providing vision, governance, and strategic direction.',
        'members' => [],
    ],
    'Operations Team' => [
        'title'   => 'Operations Team',
        'body'    => 'Coordinating programs and daily activities.',
        'members' => [],
    ],
    'Volunteers' => [
        'title'   => 'Volunteers',
        'body'    => 'The heart of our outreach and initiatives.',
        'members' => [],
    ],
];

foreach ($rawTeam as $row) {
    $grp = $row['input_group'] ?? 'Operations Team';
    if (!isset($team_grouped[$grp])) {
        $team_grouped[$grp] = [
            'title'   => $grp,
            'body'    => '',
            'members' => [],
        ];
    }
    $imgSrc = !empty($row['image_1']) ? '/' . ltrim($row['image_1'], '/') : ($row['input_image'] ?? '');
    $team_grouped[$grp]['members'][] = [
        'name'  => $row['input_name'],
        'role'  => $row['input_role'],
        'image' => $imgSrc,
    ];
}
$team_groups = array_values($team_grouped);

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
    $imgSrc = !empty($row['image_1']) ? '/' . ltrim($row['image_1'], '/') : ($row['input_image'] ?? '');
    $gallery_items[] = [
        'category' => $cat,
        'caption'  => $row['input_caption'],
        'image'    => $imgSrc,
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
    $imgSrc = !empty($row['image_1']) ? '/' . ltrim($row['image_1'], '/') : ($row['input_image'] ?? '');
    $blog_posts[] = [
        'slug'     => $row['input_slug'],
        'title'    => $row['input_title'],
        'excerpt'  => $row['text_excerpt'] ?? '',
        'category' => $cat,
        'date'     => $row['input_date'] ?? '',
        'read'     => $row['input_read_time'] ?: '5 min read',
        'image'    => $imgSrc,
        'author'   => $row['input_author'] ?: 'HC Foundation',
    ];
}

# --- 14. FAQ (Contact Page) -------------------------------------------------
$rawFaqs = selectContent($conn, "panel_faqs", ['visibility' => 'show']);
$faqs = [];
foreach ($rawFaqs as $row) {
    $faqs[] = [
        'q' => $row['input_question'],
        'a' => $row['text_answer'] ?? '',
    ];
}

# --- 15. Partners -----------------------------------------------------------
$rawPartners = selectContent($conn, "panel_partners", ['visibility' => 'show']);
$partners = [];
foreach ($rawPartners as $row) {
    $partners[] = $row['input_name'];
}
