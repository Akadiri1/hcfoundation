<?php
/**
 * ---------------------------------------------------------------------------
 * DESIGN-MODE CONTENT
 * ---------------------------------------------------------------------------
 * Every variable the pages read is defined here, using the same names the
 * database will populate later. When the CMS tables go in, this file is
 * replaced by the queries in www/index.php and the views do not change.
 *
 * Placeholder copy is marked PENDING. Photography is placeholder imagery and
 * must be swapped for the Foundation's own before launch.
 * ---------------------------------------------------------------------------
 */

# --- Identity ---------------------------------------------------------------
$site_name       = "Hathany Cosmos Foundation";
$site_short      = "HC Foundation";
$site_tagline    = "Restoring Hope. Transforming Lives.";
// PENDING: the brief reads "HC Foundation exists to xxxxxxxxxxxxxx".
$site_promise    = "HC Foundation exists to stand with communities where support is scarce — turning compassion into practical, lasting change.";
$description     = "A humanitarian-focused organization committed to improving lives through service, compassion, and action.";

$site_email      = "hello@hathanycosmos.org";      // PENDING
$site_phone      = "+234 800 000 0000";            // PENDING
$site_address    = "Lagos, Nigeria";               // PENDING

$logo_directory  = "/assets/images/logo.png";
$metaTitle       = $site_name;
$metaDescription = $description;
$metaImage       = $logo_directory;
$icon            = $logo_directory;
$siteKeywords    = ["HC Foundation", "Hathany Cosmos Foundation", "humanitarian", "community outreach", "Nigeria", "nonprofit"];
$maintenance_status = 0;

# --- Social -----------------------------------------------------------------
$socialLinks = [
    ['name' => 'Facebook',  'url' => '#', 'icon' => 'facebook'],
    ['name' => 'Instagram', 'url' => '#', 'icon' => 'instagram'],
    ['name' => 'YouTube',   'url' => '#', 'icon' => 'youtube'],
    ['name' => 'Twitter (X)', 'url' => '#', 'icon' => 'x'],
];

# --- Photography ------------------------------------------------------------
// Placeholder imagery. Replace with the Foundation's own photography.
$img = function (string $id, int $w = 1200, int $h = 900): string {
    return "https://images.unsplash.com/{$id}?auto=format&fit=crop&w={$w}&h={$h}&q=80";
};

$hero_images = [
    $img('photo-1488521787991-ed7bbaae773c', 900, 1200),
    $img('photo-1509099836639-18ba1795216d', 800, 600),
    $img('photo-1517486808906-6ca8b3f04846', 800, 600),
];

# --- Initiatives ------------------------------------------------------------
// The brief names these twice: a short form under "What We Do" on the home
// page, and a programme form on the Initiatives page, each with its own copy.
// Both are kept so each page shows exactly what the brief specifies.
//
//   title / summary     -> home page "What We Do"
//   programme / description -> initiatives page "Our Work"
$initiatives = [
    [
        'slug'        => 'community-outreach',
        'title'       => 'Community Outreach',
        'summary'     => 'Supporting vulnerable individuals and families through targeted relief and engagement.',
        'programme'   => 'Community Relief Programs',
        'description' => 'Providing essential support to individuals and families during times of need.',
        'body'        => 'We meet people where they are. Our outreach teams work directly with families in situations of hardship, providing relief that responds to the need in front of us rather than the need we assumed.',
        'icon'        => 'hands',
        'image'       => $img('photo-1593113630400-ea4288922497'),
        'accent'      => 'teal',
    ],
    [
        'slug'        => 'education-support',
        'title'       => 'Education Support',
        'summary'     => 'Providing learning support, mentorship, and opportunities for young people to thrive.',
        'programme'   => 'Educational Support Initiatives',
        'description' => 'Encouraging learning, personal growth, and access to educational opportunities.',
        'body'        => 'Education changes the arc of a life. We invest in learning support, mentorship and access, so that circumstance does not decide how far a young person can go.',
        'icon'        => 'book',
        'image'       => $img('photo-1503676260728-1c00da094a0b'),
        'accent'      => 'ember',
    ],
    [
        'slug'        => 'health-social-care',
        'title'       => 'Health & Social Care',
        'summary'     => 'Promoting wellbeing through awareness, access, and community-based interventions.',
        'programme'   => 'Health & Awareness Programs',
        'description' => 'Promoting healthier communities through education and support services.',
        'body'        => 'Good health should not depend on proximity to a clinic. We work on awareness, access and community-based care that reaches people early rather than late.',
        'icon'        => 'heart',
        'image'       => $img('photo-1576091160550-2173dba999ef'),
        'accent'      => 'teal',
    ],
    [
        'slug'        => 'community-development',
        'title'       => 'Community Development',
        'summary'     => 'Building capacity and empowering communities for sustainable growth.',
        'programme'   => 'Youth & Community Development',
        'description' => 'Equipping individuals with skills, confidence, and resources to improve their future.',
        'body'        => 'Lasting change is built locally. We equip communities with the skills, confidence and resources to carry their own progress forward long after a programme ends.',
        'icon'        => 'growth',
        'image'       => $img('photo-1531482615713-2afd69097998'),
        'accent'      => 'ember',
    ],
];

# --- Impact -----------------------------------------------------------------
// PENDING: the brief gives no figures. These are illustrative only.
$impact_stats = [
    ['value' => 12000, 'suffix' => '+', 'label' => 'Lives touched',        'note' => 'across outreach and relief programmes'],
    ['value' => 45,    'suffix' => '',  'label' => 'Communities served',   'note' => 'in urban and rural settings'],
    ['value' => 300,   'suffix' => '+', 'label' => 'Active volunteers',    'note' => 'giving time, skill and presence'],
    ['value' => 8,     'suffix' => '',  'label' => 'Years of service',     'note' => 'consistent, accountable delivery'],
];

# --- About ------------------------------------------------------------------
$about_who = "HC Foundation is a humanitarian-focused organization committed to improving lives through service, compassion, and action. We work with communities to identify needs and deliver support that is both meaningful and sustainable.";
$about_approach = "Our approach is people-centered, transparent, and driven by a deep sense of responsibility to those we serve.";

$vision  = "To build communities where hope is restored, dignity is upheld, and opportunities are accessible to all.";
$mission = "To serve and empower individuals and communities through impactful humanitarian initiatives, education support, health awareness, and community development.";

$core_values = [
    ['title' => 'Compassion',       'body' => 'We begin with the person, not the programme.',            'icon' => 'heart'],
    ['title' => 'Integrity',        'body' => 'We do what we said we would do, and we say what we did.', 'icon' => 'shield'],
    ['title' => 'Accountability',   'body' => 'Every contribution is traceable to an outcome.',          'icon' => 'check'],
    ['title' => 'Service',          'body' => 'We show up consistently, not occasionally.',              'icon' => 'hands'],
    ['title' => 'Community Impact', 'body' => 'We measure success in lives changed, not activity.',      'icon' => 'growth'],
];

# --- Volunteer --------------------------------------------------------------
$volunteer_intro = "Volunteers are a vital part of our mission. By giving your time, skills, and passion, you help extend our reach and deepen our impact.";

$volunteer_benefits = [
    ['title' => 'Make a tangible difference',        'body' => 'Work that ends in a result you can point to.'],
    ['title' => 'Serve alongside like-minded people','body' => 'Join a team that shares your conviction.'],
    ['title' => 'Gain valuable experience',          'body' => 'Build real skills in the field, not in theory.'],
    ['title' => 'Be part of meaningful community change', 'body' => 'Contribute to outcomes that outlast the day.'],
];

$volunteer_roles = [
    ['title' => 'Community Outreach',     'body' => 'Join field teams delivering relief and engaging directly with families.',        'icon' => 'hands'],
    ['title' => 'Event & Program Support', 'body' => 'Help plan and run the programmes that carry our work into communities.',        'icon' => 'calendar'],
    ['title' => 'Media & Communications',  'body' => 'Tell the story — photography, writing, social media and design.',               'icon' => 'camera'],
    ['title' => 'Administrative Assistance','body' => 'Keep the engine running through coordination, records and logistics.',         'icon' => 'clipboard'],
];

# --- Team -------------------------------------------------------------------
$team_intro = "HC Foundation is led by dedicated individuals committed to service, leadership, and impact.";

// PENDING: no names, roles or photographs supplied. Structure shown.
$team_groups = [
    [
        'title'   => 'Board & Leadership',
        'body'    => 'Providing vision, governance, and strategic direction.',
        'members' => [
            ['name' => 'Name Pending', 'role' => 'Chair, Board of Trustees', 'image' => $img('photo-1560250097-0b93528c311a', 600, 700)],
            ['name' => 'Name Pending', 'role' => 'Executive Director',       'image' => $img('photo-1573497019940-1c28c88b4f3e', 600, 700)],
            ['name' => 'Name Pending', 'role' => 'Trustee',                  'image' => $img('photo-1544027993-37dbfe43562a', 600, 700)],
        ],
    ],
    [
        'title'   => 'Operations Team',
        'body'    => 'Coordinating programs and daily activities.',
        'members' => [
            ['name' => 'Name Pending', 'role' => 'Programmes Lead',    'image' => $img('photo-1521791136064-7986c2920216', 600, 700)],
            ['name' => 'Name Pending', 'role' => 'Outreach Coordinator','image' => $img('photo-1522202176988-66273c2fd55f', 600, 700)],
            ['name' => 'Name Pending', 'role' => 'Communications',      'image' => $img('photo-1552664730-d307ca884978', 600, 700)],
        ],
    ],
    [
        'title'   => 'Volunteers',
        'body'    => 'The heart of our outreach and initiatives.',
        'members' => [],
    ],
];

# --- Donate -----------------------------------------------------------------
// A link only - no payment integration, no keys, nothing to process on our side.
// Switch 'channel' to whichever the foundation wants live.
//
// PENDING: both destinations are placeholders. Supply the real WhatsApp number
// (international format, no +, no spaces) or the real Flutterwave payment link.
$donate = [
    'channel'          => 'whatsapp',            // 'whatsapp' | 'flutterwave'
    'whatsapp_number'  => '2348000000000',       // PENDING
    'whatsapp_message' => 'Hello HC Foundation, I would like to make a donation.',
    'flutterwave_url'  => '',                    // PENDING
];

$donate['url'] = $donate['channel'] === 'flutterwave'
    ? $donate['flutterwave_url']
    : 'https://wa.me/' . $donate['whatsapp_number'] . '?text=' . rawurlencode($donate['whatsapp_message']);

$donate['label'] = $donate['channel'] === 'flutterwave' ? 'Donate with Flutterwave' : 'Donate via WhatsApp';
$donate['icon']  = $donate['channel'] === 'flutterwave' ? 'gift' : 'whatsapp';
$donate['note']  = $donate['channel'] === 'flutterwave'
    ? 'You will be taken to our secure Flutterwave page.'
    : 'Opens a WhatsApp chat so we can share account details with you directly.';

# --- Gallery ----------------------------------------------------------------
$gallery_categories = ['Outreach Programs', 'Community Engagement', 'Events & Activities', 'Volunteers in Action'];

$gallery_items = [
    ['category' => 'Outreach Programs',    'caption' => 'Relief distribution',        'image' => $img('photo-1593113630400-ea4288922497', 900, 1100)],
    ['category' => 'Community Engagement', 'caption' => 'Listening to the community', 'image' => $img('photo-1511632765486-a01980e01a18', 900, 700)],
    ['category' => 'Events & Activities',  'caption' => 'Programme launch',           'image' => $img('photo-1540575467063-178a50c2df87', 900, 700)],
    ['category' => 'Volunteers in Action', 'caption' => 'Field team at work',         'image' => $img('photo-1559027615-cd4628902d4a', 900, 1100)],
    ['category' => 'Outreach Programs',    'caption' => 'School supplies drive',      'image' => $img('photo-1503676260728-1c00da094a0b', 900, 700)],
    ['category' => 'Community Engagement', 'caption' => 'Community gathering',        'image' => $img('photo-1517486808906-6ca8b3f04846', 900, 1100)],
    ['category' => 'Volunteers in Action', 'caption' => 'Volunteer briefing',         'image' => $img('photo-1531482615713-2afd69097998', 900, 700)],
    ['category' => 'Events & Activities',  'caption' => 'Health awareness day',       'image' => $img('photo-1576091160550-2173dba999ef', 900, 700)],
    ['category' => 'Outreach Programs',    'caption' => 'Food parcel packing',        'image' => $img('photo-1488521787991-ed7bbaae773c', 900, 1100)],
    ['category' => 'Community Engagement', 'caption' => 'Household visits',           'image' => $img('photo-1509099836639-18ba1795216d', 900, 700)],
    ['category' => 'Events & Activities',  'caption' => 'Annual review meeting',      'image' => $img('photo-1543269865-cbf427effbad', 900, 700)],
    ['category' => 'Volunteers in Action', 'caption' => 'Setting up for outreach',    'image' => $img('photo-1552664730-d307ca884978', 900, 1100)],
    ['category' => 'Outreach Programs',    'caption' => 'Mentorship session',         'image' => $img('photo-1522202176988-66273c2fd55f', 900, 700)],
    ['category' => 'Community Engagement', 'caption' => 'Neighbourhood consultation', 'image' => $img('photo-1517048676732-d65bc937f952', 900, 700)],
    ['category' => 'Events & Activities',  'caption' => 'Volunteer recognition',      'image' => $img('photo-1571019613454-1cb2f99b2d8b', 900, 1100)],
    ['category' => 'Volunteers in Action', 'caption' => 'Logistics and sorting',      'image' => $img('photo-1497633762265-9d179a990aa6', 900, 700)],
    ['category' => 'Outreach Programs',    'caption' => 'Rural community visit',      'image' => $img('photo-1469571486292-0ba58a3f068b', 900, 700)],
    ['category' => 'Volunteers in Action', 'caption' => 'Team debrief',               'image' => $img('photo-1573497019940-1c28c88b4f3e', 900, 1100)],
];

# --- Blog -------------------------------------------------------------------
$blog_categories = ['Impact Stories', 'Program Updates', 'Community Voices', 'Reflections & Insights'];

// PENDING: no posts supplied. Structure and layout shown.
$blog_posts = [
    ['slug' => 'sample-impact-story', 'title' => 'What changes when someone shows up consistently',
     'excerpt'  => 'A look at why continuity matters more than scale in the communities we serve, and what we have learned from staying.',
     'category' => 'Impact Stories', 'date' => '12 August 2026', 'read' => '5 min read', 'image' => $img('photo-1488521787991-ed7bbaae773c')],

    ['slug' => 'sample-program-update', 'title' => 'Education support: where the programme stands',
     'excerpt'  => 'An update on mentorship placements, learning support and what the next quarter looks like.',
     'category' => 'Program Updates', 'date' => '29 July 2026', 'read' => '4 min read', 'image' => $img('photo-1503676260728-1c00da094a0b')],

    ['slug' => 'sample-community-voice', 'title' => 'In their words: three families, one year on',
     'excerpt'  => 'We went back to ask what actually changed. The answers were not the ones we expected.',
     'category' => 'Community Voices', 'date' => '14 July 2026', 'read' => '7 min read', 'image' => $img('photo-1509099836639-18ba1795216d')],

    ['slug' => 'sample-reflection', 'title' => 'Measuring impact without flattening people into numbers',
     'excerpt'  => 'Reflections on accountability, reporting, and holding both rigour and humanity at once.',
     'category' => 'Reflections & Insights', 'date' => '02 July 2026', 'read' => '6 min read', 'image' => $img('photo-1497633762265-9d179a990aa6')],

    ['slug' => 'sample-health-awareness', 'title' => 'Bringing health awareness closer to home',
     'excerpt'  => 'Community-based interventions reach people earlier. Here is how we are building that out.',
     'category' => 'Program Updates', 'date' => '20 June 2026', 'read' => '5 min read', 'image' => $img('photo-1576091160550-2173dba999ef')],

    ['slug' => 'sample-volunteer-story', 'title' => 'Why our volunteers keep coming back',
     'excerpt'  => 'Six volunteers on what keeps them in the work, in their own words.',
     'category' => 'Community Voices', 'date' => '05 June 2026', 'read' => '4 min read', 'image' => $img('photo-1531482615713-2afd69097998')],

    ['slug' => 'sample-outreach-recap', 'title' => 'Notes from a month of community outreach',
     'excerpt'  => 'What four weeks in the field taught us about planning, listening and adjusting.',
     'category' => 'Impact Stories', 'date' => '22 May 2026', 'read' => '6 min read', 'image' => $img('photo-1593113630400-ea4288922497')],

    ['slug' => 'sample-partnership', 'title' => 'Working with partners without losing focus',
     'excerpt'  => 'Collaboration multiplies reach, but only when everyone is clear on who is accountable for what.',
     'category' => 'Reflections & Insights', 'date' => '08 May 2026', 'read' => '5 min read', 'image' => $img('photo-1543269865-cbf427effbad')],

    ['slug' => 'sample-youth-development', 'title' => 'Building skills that outlast the programme',
     'excerpt'  => 'Youth development works when the capacity stays behind after we do not.',
     'category' => 'Program Updates', 'date' => '19 April 2026', 'read' => '5 min read', 'image' => $img('photo-1522202176988-66273c2fd55f')],

    ['slug' => 'sample-listening-first', 'title' => 'Listening first: how we decide what to do next',
     'excerpt'  => 'Every initiative starts with a conversation we did not lead. Here is how that works in practice.',
     'category' => 'Reflections & Insights', 'date' => '03 April 2026', 'read' => '7 min read', 'image' => $img('photo-1517486808906-6ca8b3f04846')],

    ['slug' => 'sample-family-story', 'title' => 'One household, four seasons of support',
     'excerpt'  => 'Following a single family through a year of relief, schooling and health access.',
     'category' => 'Impact Stories', 'date' => '17 March 2026', 'read' => '8 min read', 'image' => $img('photo-1469571486292-0ba58a3f068b')],

    ['slug' => 'sample-community-voice-2', 'title' => 'Three programmes, one clinic, one afternoon',
     'excerpt'  => 'A volunteer, a teacher and a nurse on where their work overlaps.',
     'category' => 'Community Voices', 'date' => '28 February 2026', 'read' => '6 min read', 'image' => $img('photo-1552664730-d307ca884978')],

    ['slug' => 'sample-year-in-review', 'title' => 'The year in review, including what did not work',
     'excerpt'  => 'Reporting honestly on the programmes that fell short, and what we changed because of them.',
     'category' => 'Impact Stories', 'date' => '15 January 2026', 'read' => '9 min read', 'image' => $img('photo-1497486751825-1233686d5d80')],
];

// Author is uniform for now; becomes a per-post field when the CMS lands.
foreach ($blog_posts as $i => $post) {
    $blog_posts[$i]['author'] = 'HC Foundation';
}

# --- FAQ (contact page) -----------------------------------------------------
$faqs = [
    ['q' => 'How can I get involved with HC Foundation?',
     'a' => 'Through volunteering, partnership or advocacy. The volunteer page lists current openings, and the form on this page reaches us directly.'],
    ['q' => 'Do you accept partnership proposals from organisations?',
     'a' => 'Yes. We work with organisations whose objectives align with ours. Send an outline of what you have in mind and we will come back to you.'],
    ['q' => 'Where does HC Foundation currently operate?',
     'a' => 'We work across urban and rural communities, prioritising areas where existing support is thinnest.'],
    ['q' => 'How quickly will I hear back?',
     'a' => 'We aim to respond to every message within two working days.'],
];

# --- Partners ---------------------------------------------------------------
// PENDING: no partner list supplied. Names shown are placeholders.
$partners = ['Community Trust', 'Health Alliance', 'Learning Futures', 'Civic Council', 'Care Network', 'Youth Coalition'];
