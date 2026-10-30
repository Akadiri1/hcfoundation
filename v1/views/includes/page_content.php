<?php
/**
 * ---------------------------------------------------------------------------
 * PAGE CONTENT DEFAULTS
 * ---------------------------------------------------------------------------
 * Every piece of page copy and imagery that ADMC can live-edit, keyed by the
 * table that stores it. One file feeds three things:
 *
 *   - database/seeds/HCFoundationPageContentSeeder.php seeds these values
 *   - admc_section() / admc_rows() fall back to them when a row is missing
 *   - DESIGN_MODE renders straight from them (no database)
 *
 * settings_*  one row per page section (edit only)
 * panels      repeating items (add / edit / delete from ADMC)
 * row_defaults  values for columns added to existing panel_* tables
 *
 * Headings use " | " to mark a deliberate line break; admc_lines() turns it
 * into <br>. Columns named text_content hold HTML from ADMC's rich editor.
 * ---------------------------------------------------------------------------
 */

$unsplash = function (string $id, int $w = 1200, int $h = 900): string {
    return "https://images.unsplash.com/{$id}?auto=format&fit=crop&w={$w}&h={$h}&q=80";
};

$initiativeBody = <<<'HTML'
<h2>What this looks like in practice</h2>
<p>Work under this initiative is planned with the community, delivered by teams drawn from the community wherever possible, and reported back to the community once complete.</p>
<ul>
<li>Needs identified through direct engagement rather than assumption</li>
<li>Delivery sized to what can be sustained beyond a single cycle</li>
<li>Outcomes recorded and published, including what did not work</li>
<li>Local capacity built so the work continues without us</li>
</ul>
<blockquote><p>Impact is measured by lives touched and stories changed.</p></blockquote>
<h2>How you can support it</h2>
<p>Volunteers, partner organisations and advocates all extend how far this initiative reaches. If any of those describe you, we would like to hear from you.</p>
HTML;

$blogBody = <<<'HTML'
<p>This is placeholder body copy. Once the CMS is connected, the full article will render here exactly as written in the admin panel, with headings, lists, quotes and images all styled to match.</p>
<h2>Why this matters</h2>
<p>Consistency is the part of this work that rarely gets photographed. It is also the part that changes outcomes. Showing up once is a gesture; showing up repeatedly is a relationship, and relationships are what carry a community through the months when nobody is watching.</p>
<blockquote><p>We believe impact is measured by lives touched and stories changed.</p></blockquote>
<h2>What we learned</h2>
<ul>
<li>Needs identified by the community are more accurate than needs assumed</li>
<li>Smaller programmes sustained over time outperform larger one-off pushes</li>
<li>Reporting honestly on what failed builds more trust than reporting only wins</li>
</ul>
<p>If this is work you would like to be part of, the volunteer page lists where we currently need help.</p>
HTML;

$privacyBody = <<<'HTML'
<h2>What we collect</h2>
<p>When you contact us or apply to volunteer, we collect the details you choose to give us: your name, email address, phone number and the content of your message. We do not collect payment information.</p>
<h2>How we use it</h2>
<ul>
<li>To respond to your enquiry or volunteer application</li>
<li>To keep you updated about the work you asked to hear about</li>
<li>To meet our record-keeping and reporting obligations</li>
</ul>
<h2>Who we share it with</h2>
<p>We do not sell your information, and we do not share it with third parties for marketing. We share it only where required by law, or with service providers who process it on our behalf under equivalent obligations.</p>
<h2>How long we keep it</h2>
<p>We keep enquiry and volunteer records for as long as needed for the purpose they were given, and then delete them.</p>
<h2>Your rights</h2>
<p>You may ask us for a copy of the information we hold about you, ask us to correct it, or ask us to delete it. Write to <a href="mailto:contact@hcfoundations.com">contact@hcfoundations.com</a> and we will respond within a reasonable period.</p>
<h2>Cookies</h2>
<p>This site uses only the cookies needed to keep it working. We will update this section if analytics or embedded media are added.</p>
<h2>Contact</h2>
<p>Questions about this policy can go to <a href="mailto:contact@hcfoundations.com">contact@hcfoundations.com</a> or Lagos, Nigeria.</p>
HTML;

$termsBody = <<<'HTML'
<h2>Using this site</h2>
<p>By using this website you agree to these terms. If you do not agree with them, please do not use the site.</p>
<h2>Our content</h2>
<p>The text, images, logos and design on this site belong to Hathany Cosmos Foundation unless stated otherwise. You may read and share our content with attribution, but you may not republish it as your own or use it commercially without written permission.</p>
<h2>Your submissions</h2>
<p>When you send us a message or a volunteer application, you confirm that the information you give is accurate and that you have the right to share it.</p>
<h2>Accuracy</h2>
<p>We keep this site as accurate and current as we can, but we do not guarantee that every page is complete or error-free at all times.</p>
<h2>External links</h2>
<p>Where we link to other websites, we are not responsible for their content or their privacy practices.</p>
<h2>Changes</h2>
<p>We may update these terms. The date above shows when they were last revised.</p>
<h2>Contact</h2>
<p>Questions can go to <a href="mailto:contact@hcfoundations.com">contact@hcfoundations.com</a>.</p>
HTML;

return [

    # =======================================================================
    # SETTINGS - one row per section
    # =======================================================================
    'settings' => [

        # --- Layout --------------------------------------------------------
        // Labels for the header menu; the footer link lists reuse them.
        'settings_navigation' => [
            'input_home'          => 'Home',
            'input_about'         => 'About',
            'input_about_us'      => 'About Us',
            'input_about_us_desc' => 'Who we are and what drives us',
            'input_team'          => 'Our Team',
            'input_team_desc'     => 'The people behind the work',
            'input_initiatives'   => 'Initiatives',
            'input_volunteer'     => 'Volunteer',
            'input_media'         => 'Media',
            'input_gallery'       => 'Gallery',
            'input_gallery_desc'  => 'Moments from the field',
            'input_blog'          => 'Blog',
            'input_blog_desc'     => 'Stories and updates',
            'input_contact'       => 'Contact',
        ],
        'settings_header' => [
            'input_image'  => '/assets/images/logo-nav.png',
            'image_1'      => '',
            'input_button' => 'Get Involved',
        ],
        'settings_footer_cta' => [
            'input_eyebrow'          => 'Get Involved',
            'input_heading'          => "There's a place for you | in the work we do.",
            'text_intro'             => "Whether through volunteering, partnerships, or advocacy, there's a place for you in the work we do.",
            'input_primary_button'   => 'Become a volunteer',
            'input_secondary_button' => 'Partner with us',
        ],
        'settings_footer' => [
            'input_image'         => '/assets/images/logo-nav-light.png',
            'image_1'             => '',
            'text_about'          => 'Restoring hope, transforming lives. A humanitarian organisation working with communities to deliver support that is meaningful and sustainable.',
            'input_follow_label'  => 'Follow us on',
            'input_explore_title' => 'Explore',
            'input_more_title'    => 'More',
            'input_contact_title' => 'Get in touch',
            'input_copyright'     => 'All rights reserved.',
            'input_privacy_link'  => 'Privacy Policy',
            'input_terms_link'    => 'Terms of Use',
        ],

        # --- Home ----------------------------------------------------------
        'settings_home_hero' => [
            'input_eyebrow'           => 'Humanitarian Foundation',
            'input_heading'           => 'Restoring Hope.',
            'input_heading_highlight' => 'Transforming Lives.',
            'input_primary_button'    => 'Explore our work',
            'input_secondary_button'  => 'Volunteer with us',
            'input_trust_badge'       => '300+',
            'input_trust_text'        => 'Volunteers giving time, | skill and presence.',
            'input_chip_value'        => '12000',
            'input_chip_suffix'       => '+',
            'input_chip_label'        => 'Lives touched',
        ],
        'settings_home_what_we_do' => [
            'input_eyebrow'    => 'What We Do',
            'input_heading'    => 'Four ways we show up | for communities',
            'text_intro'       => 'Each programme answers a need we have heard directly from the people we serve.',
            'input_link_label' => 'Learn more',
        ],
        'settings_home_who_we_are' => [
            'input_image'       => $unsplash('photo-1509099836639-18ba1795216d', 900, 1120),
            'image_1'           => '',
            'input_badge_value' => '45',
            'input_badge_label' => 'Communities served, urban and rural',
            'input_eyebrow'     => 'Who We Are',
            'input_heading'     => 'People-centered. | Transparent. Accountable.',
            'input_button'      => 'More about us',
        ],
        'settings_home_impact' => [
            'input_eyebrow' => 'Our Impact So Far',
            'input_heading' => 'Measured in lives touched, not activity reported.',
            'text_intro'    => 'We believe impact is measured by lives touched and stories changed. Across communities, HC Foundation continues to create meaningful change through consistent service and collaboration.',
            'input_button'  => 'See the programmes',
        ],
        'settings_home_initiatives' => [
            'input_eyebrow'   => 'Our Work',
            'input_heading'   => 'Initiatives built to last',
            'input_link'      => 'View all initiatives',
            'input_card_tag'  => 'Initiative',
            'input_card_link' => 'Learn more',
        ],
        'settings_home_blog' => [
            'input_eyebrow' => 'Stories & Updates',
            'input_heading' => 'From the field',
            'input_link'    => 'Read the blog',
        ],
        'settings_home_partners' => [
            'input_heading' => 'Working alongside',
        ],

        # --- About ---------------------------------------------------------
        'settings_about_hero' => [
            'input_eyebrow'         => 'About Us',
            'input_title'           => 'Who',
            'input_title_highlight' => 'We Are',
            'text_intro'            => 'A humanitarian-focused organization committed to improving lives through service, compassion, and action.',
        ],
        'settings_about_story' => [
            'input_image'         => $unsplash('photo-1517486808906-6ca8b3f04846', 900, 1120),
            'image_1'             => '',
            'text_quote'          => 'We work with communities to identify needs and deliver support that is both meaningful and sustainable.',
            'input_eyebrow'       => 'Our Story',
            'input_heading'       => 'Responsibility to those we serve',
            'text_extra'          => 'That responsibility shapes how we plan, how we spend, and how we report. Every programme begins with listening, and every outcome is traceable back to the people it was meant to serve.',
            'input_vision_title'  => 'Our Vision',
            'input_mission_title' => 'Our Mission',
        ],
        'settings_about_values' => [
            'input_eyebrow' => 'Our Core Values',
            'input_heading' => 'What we hold ourselves to',
        ],
        'settings_about_approach' => [
            'input_eyebrow' => 'How We Work',
            'input_heading' => 'Listen first. Deliver second. Report always.',
            'text_intro'    => 'The same three steps run through every initiative we take on, whether it reaches four families or four hundred.',
        ],

        # --- Initiatives ---------------------------------------------------
        'settings_initiatives_hero' => [
            'input_eyebrow'         => 'Our Work',
            'input_title'           => 'Initiatives that answer',
            'input_title_highlight' => 'real needs',
            'text_intro'            => 'Each initiative is designed to respond to real needs and create lasting outcomes.',
        ],
        'settings_initiatives_page' => [
            'input_learn_more'     => 'Learn more',
            'input_support_button' => 'Support this work',
        ],
        'settings_initiative_details' => [
            'input_volunteer_button' => 'Volunteer for this',
            'input_partner_button'   => 'Partner with us',
            'input_glance_title'     => 'At a glance',
            'input_focus_label'      => 'Focus',
            'input_approach_label'   => 'Approach',
            'input_status_label'     => 'Status',
            'input_reach_label'      => 'Reach',
            'input_others_title'     => 'Other initiatives',
        ],

        # --- Volunteer -----------------------------------------------------
        'settings_volunteer_hero' => [
            'input_eyebrow'         => 'Volunteer',
            'input_title'           => 'Volunteer with',
            'input_title_highlight' => 'HC Foundation',
        ],
        'settings_volunteer_why' => [
            'input_image'       => $unsplash('photo-1531482615713-2afd69097998', 900, 1120),
            'image_1'           => '',
            'input_stat_value'  => '300',
            'input_stat_suffix' => '+',
            'input_stat_label'  => 'Active volunteers',
            'input_eyebrow'     => 'Why Volunteer with Us?',
            'input_heading'     => 'Your time is the resource we cannot buy',
        ],
        'settings_volunteer_roles' => [
            'input_eyebrow'    => 'Volunteer Opportunities',
            'input_heading'    => 'Where you could fit',
            'text_intro'       => 'Four ways to contribute. Tell us which sounds like you and we will take it from there.',
            'input_apply_link' => 'Apply for this',
        ],
        'settings_volunteer_signup' => [
            'input_eyebrow'       => 'Sign Up',
            'input_heading'       => 'Tell us how you would like to help',
            'text_intro'          => 'Fill in the form and a member of the team will be in touch within two working days to talk through where you might fit.',
            'input_email_label'   => 'Email us',
            'input_call_label'    => 'Call us',
            'input_visit_label'   => 'Visit us',
            'input_submit_button' => 'Submit application',
            'input_name_label'          => 'Full name',
            'input_name_placeholder'    => 'Your full name',
            'input_email_field_label'   => 'Email address',
            'input_email_placeholder'   => 'you@example.com',
            'input_phone_field_label'   => 'Phone number',
            'input_phone_placeholder'   => '+234 …',
            'input_role_label'          => 'Preferred role',
            'input_role_placeholder'    => 'Select an area',
            'input_message_label'       => 'Why do you want to volunteer?',
            'input_message_placeholder' => 'Tell us a little about yourself and what you would like to contribute.',
            'input_form_note'           => 'We will never share your details. Read our',
            'input_privacy_link'        => 'privacy policy',
        ],
        'settings_volunteer_donate' => [
            'input_eyebrow' => 'Support Our Work',
            'input_heading' => 'Not able to give time? You can still give.',
            'text_intro'    => 'Every contribution goes directly into relief, education support and health outreach in the communities we serve.',
        ],

        # --- Team ----------------------------------------------------------
        'settings_team_hero' => [
            'input_eyebrow'         => 'HC Foundation Team',
            'input_title'           => 'The people behind',
            'input_title_highlight' => 'the work',
        ],
        'settings_team_recruit' => [
            'input_heading' => 'Could your name be here?',
            'text_intro'    => 'Our volunteers are the heart of every outreach and initiative we run. There is room for your time, your skill and your presence.',
            'input_button'  => 'Join the team',
        ],

        # --- Gallery -------------------------------------------------------
        'settings_gallery_hero' => [
            'input_eyebrow'         => 'Gallery',
            'input_title'           => 'Moments That',
            'input_title_highlight' => 'Matter',
            'text_intro'            => 'A visual reflection of our work, our people, and the communities we serve.',
        ],
        'settings_gallery_page' => [
            'input_all_filter' => 'All',
            'input_load_more'  => 'Load more photos',
            'input_empty'      => 'Nothing in this category yet.',
            'text_note'        => "Photography shown is placeholder imagery pending the Foundation's own archive.",
        ],

        # --- Blog ----------------------------------------------------------
        'settings_blog_hero' => [
            'input_eyebrow'         => 'Blog',
            'input_title'           => 'Stories &',
            'input_title_highlight' => 'Updates',
            'text_intro'            => 'Read about our work, the people we serve, and the lessons we learn along the way.',
        ],
        'settings_blog_page' => [
            'input_featured_tag' => 'Featured',
            'input_read_link'    => 'Read the story',
            'input_all_filter'   => 'All posts',
            'input_load_more'    => 'Load more posts',
            'input_empty'        => 'No posts in this category yet.',
        ],
        'settings_blog_newsletter' => [
            'input_eyebrow' => 'Stay in touch',
            'input_heading' => 'Get our stories in your inbox',
            'text_intro'    => 'Occasional updates on programmes, impact and the communities we serve. No noise.',
            'input_button'  => 'Subscribe',
            'input_note'    => 'We will never share your address.',
            'input_placeholder' => 'you@example.com',
        ],
        'settings_blog_post' => [
            'input_share_title'      => 'Share this story',
            'input_categories_title' => 'Categories',
            'input_cta_heading'      => 'Be part of the next story',
            'text_cta_intro'         => 'Volunteers extend how far this work reaches.',
            'input_cta_button'       => 'Volunteer with us',
            'input_related_title'    => 'Continue reading',
        ],

        # --- Contact -------------------------------------------------------
        'settings_contact_hero' => [
            'input_eyebrow'         => 'Contact',
            'input_title'           => 'Get in',
            'input_title_highlight' => 'Touch',
            'text_intro'            => "We'd love to hear from you.",
        ],
        'settings_contact_page' => [
            'input_email_label'   => 'Email',
            'input_email_note'    => 'Replies within two working days',
            'input_phone_label'   => 'Phone',
            'input_phone_note'    => 'Mon – Fri, 9am – 5pm',
            'input_address_label' => 'Office Address',
            'input_address_note'  => 'Visits by appointment',
            'input_form_eyebrow'  => 'Send a message',
            'input_form_heading'  => 'Tell us what is on your mind',
            'input_submit_button' => 'Send message',
            'input_faq_eyebrow'   => 'Questions',
            'input_faq_heading'   => 'Before you write',
            'input_call_heading'  => 'Prefer to talk?',
            'text_call_intro'     => 'Call the office during working hours and someone will pick up.',
            'input_name_label'          => 'Name',
            'input_name_placeholder'    => 'Your full name',
            'input_email_field_label'   => 'Email',
            'input_email_placeholder'   => 'you@example.com',
            'input_subject_label'       => 'Subject',
            'input_subject_placeholder' => 'What is this about?',
            'input_message_label'       => 'Message',
            'input_message_placeholder' => 'How can we help?',
            'input_form_note'           => 'By sending this you agree to our',
            'input_privacy_link'        => 'privacy policy',
        ],

        # --- Legal ---------------------------------------------------------
        'settings_privacy_policy' => [
            'input_eyebrow'         => 'Legal',
            'input_title'           => 'Privacy',
            'input_title_highlight' => 'Policy',
            'text_intro'            => 'How we collect, use and protect the information you share with us.',
            'text_notice'           => 'Placeholder text. This policy must be reviewed and approved before launch — the site collects names, email addresses and phone numbers through two forms, which brings it under NDPR.',
            'input_last_updated'    => 'October 2026',
            'text_content'          => $privacyBody,
        ],
        'settings_terms_of_use' => [
            'input_eyebrow'         => 'Legal',
            'input_title'           => 'Terms of',
            'input_title_highlight' => 'Use',
            'text_intro'            => 'The terms that apply when you use this website.',
            'text_notice'           => 'Placeholder text. These terms must be reviewed and approved before launch.',
            'input_last_updated'    => 'October 2026',
            'text_content'          => $termsBody,
        ],

        # --- 404 -----------------------------------------------------------
        'settings_not_found' => [
            'input_heading'        => 'This page could not be found',
            'text_intro'           => 'The link may be out of date, or the page may have moved. These will get you back on track.',
            'input_home_button'    => 'Back to home',
            'input_contact_button' => 'Contact us',
            'input_link_one'       => 'Initiatives',
            'input_link_two'       => 'Volunteer',
            'input_link_three'     => 'Blog',
        ],
    ],

    # =======================================================================
    # PANELS - repeating items
    # =======================================================================
    'panels' => [
        // The home hero collage has exactly three slots.
        'panel_home_hero_images' => [
            ['hash_id' => 'home_hero_img_1', 'input_alt' => 'Community outreach in progress', 'input_image' => $unsplash('photo-1488521787991-ed7bbaae773c', 900, 1200), 'image_1' => ''],
            ['hash_id' => 'home_hero_img_2', 'input_alt' => 'Volunteers at work',             'input_image' => $unsplash('photo-1509099836639-18ba1795216d', 800, 600),  'image_1' => ''],
            ['hash_id' => 'home_hero_img_3', 'input_alt' => 'Community gathering',            'input_image' => $unsplash('photo-1517486808906-6ca8b3f04846', 800, 600),  'image_1' => ''],
        ],
        'panel_about_steps' => [
            ['hash_id' => 'about_step_1', 'input_title' => 'Identify the need',   'text_body' => 'We start in the community, not in a strategy document. Needs are surfaced by the people living them.'],
            ['hash_id' => 'about_step_2', 'input_title' => 'Deliver the support', 'text_body' => 'Programmes are designed around what was actually heard, and sized to what can be sustained.'],
            ['hash_id' => 'about_step_3', 'input_title' => 'Account for it',      'text_body' => 'Outcomes are recorded and reported. Every contribution can be traced to a result.'],
        ],
        'panel_initiative_principles' => [
            ['hash_id' => 'principle_1', 'input_icon' => 'users',  'input_title' => 'Community-led', 'text_body' => 'Programmes are shaped by the people they serve, not designed at a distance.'],
            ['hash_id' => 'principle_2', 'input_icon' => 'shield', 'input_title' => 'Accountable',   'text_body' => 'Every initiative reports against outcomes, not activity counts.'],
            ['hash_id' => 'principle_3', 'input_icon' => 'growth', 'input_title' => 'Built to last', 'text_body' => 'We hand over capacity, so progress continues after we step back.'],
        ],
        // Team members join a group when panel_team.input_group matches input_title.
        'panel_team_groups' => [
            ['hash_id' => 'team_group_1', 'input_title' => 'Board & Leadership', 'text_body' => 'Providing vision, governance, and strategic direction.'],
            ['hash_id' => 'team_group_2', 'input_title' => 'Operations Team',    'text_body' => 'Coordinating programs and daily activities.'],
            ['hash_id' => 'team_group_3', 'input_title' => 'Volunteers',         'text_body' => 'The heart of our outreach and initiatives.'],
        ],
    ],

    # =======================================================================
    # ROW DEFAULTS - columns added to existing panel_* tables
    # =======================================================================
    'row_defaults' => [
        'panel_initiatives' => [
            'text_content'   => $initiativeBody,
            'input_approach' => 'Community-led delivery',
            'input_status'   => 'Active',
            'input_reach'    => 'Urban and rural communities',
        ],
        'panel_blog' => [
            'text_content' => $blogBody,
        ],
        'panel_team' => [
            'input_linkedin' => '',
            'input_x'        => '',
            'input_email'    => '',
        ],
    ],
];
