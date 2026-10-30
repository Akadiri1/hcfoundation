<?php
use App\Migrator\Seeder;

class HCFoundationSeeder extends Seeder {
    /**
     * Insert a seed row only if it is not there yet, so this seeder can run
     * any number of times without duplicating rows or overwriting edits made
     * in ADMC. Rows are matched on $key (hash_id); for single-row tables seeded
     * with $key = 'id', the row is inserted only when the table is empty.
     */
    private function seedOnce(string $table, array $row, string $key = 'hash_id'): void {
        if ($key === 'id' || !isset($row[$key])) {
            $exists = (int) $this->pdo->query("SELECT COUNT(*) FROM `$table`")->fetchColumn() > 0;
        } else {
            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM `$table` WHERE `$key` = ?");
            $stmt->execute([$row[$key]]);
            $exists = (int) $stmt->fetchColumn() > 0;
        }
        if (!$exists) {
            $this->insert($table, $row);
        }
    }

    /**
     * Run all seeds for Hathany Cosmos Foundation.
     */
    public function run() {
        echo "Seeding Hathany Cosmos Foundation data...\n";

        // Helper for placeholder images
        $img = function (string $id, int $w = 1200, int $h = 900): string {
            return "https://images.unsplash.com/{$id}?auto=format&fit=crop&w={$w}&h={$h}&q=80";
        };

        // 1. Settings & Identity
        $settings = [
            'visibility'               => 'show',
            'input_name'               => 'Hathany Cosmos Foundation',
            'input_short_name'         => 'HC Foundation',
            'input_tagline'            => 'Restoring Hope. Transforming Lives.',
            'text_promise'             => 'HC Foundation exists to stand with communities where support is scarce — turning compassion into practical, lasting change.',
            'text_description'         => 'A humanitarian-focused organization committed to improving lives through service, compassion, and action.',
            'input_email'              => 'contact@hcfoundations.com',
            'input_phone_number'       => '+1 770-727-6969',
            'input_address'            => 'Lagos, Nigeria',
            'input_logo'               => '/assets/images/logo.png',
            'text_about_who'           => 'HC Foundation is a humanitarian-focused organization committed to improving lives through service, compassion, and action. We work with communities to identify needs and deliver support that is both meaningful and sustainable.',
            'text_about_approach'      => 'Our approach is people-centered, transparent, and driven by a deep sense of responsibility to those we serve.',
            'text_vision'              => 'To build communities where hope is restored, dignity is upheld, and opportunities are accessible to all.',
            'text_mission'             => 'To serve and empower individuals and communities through impactful humanitarian initiatives, education support, health awareness, and community development.',
            'text_volunteer_intro'     => 'Volunteers are a vital part of our mission. By giving your time, skills, and passion, you help extend our reach and deepen our impact.',
            'text_team_intro'          => 'HC Foundation is led by dedicated individuals committed to service, leadership, and impact.',
            'input_donate_channel'     => 'whatsapp',
            'input_donate_whatsapp'    => '2348000000000',
            'text_donate_message'      => 'Hello HC Foundation, I would like to make a donation.',
            'input_donate_flutterwave' => '',
            'maintenance_status'       => 0,
        ];
        $this->seedOnce('settings_website_info', $settings, 'id');

        // 2. Mail Configuration
        $mailConfig = [
            'input_mail_username'    => 'contact@hcfoundations.com',
            'input_sender'           => 'HC Foundation',
            'input_password'         => '',
            'input_smtp_host'        => 'smtp.gmail.com',
            'input_smtp_port'        => '587',
            'input_smtp_secure_type' => 'tls',
        ];
        $this->seedOnce('read_mail_config', $mailConfig, 'id');

        // 3. Admin Account
        $adminPassword = password_hash('Admin@HCFoundation2026', PASSWORD_BCRYPT);
        $admin = [
            'hash_id'        => 'admin_hcfoundation_root',
            'firstname'      => 'Admin',
            'lastname'       => 'User',
            'username'       => 'admin',
            'input_username' => 'admin',
            'email'          => 'admin@hcfoundations.com',
            'hash'           => $adminPassword,
            'input_password' => $adminPassword,
            'verification'   => '1',
            'user_status'    => 1,
            'level'          => 'MASTER',
        ];
        $this->seedOnce('admin', $admin, 'hash_id');

        // 4. Social Media
        $socials = [
            [
                'hash_id'    => 'soc_' . md5('Facebook'),
                'visibility' => 'show',
                'input_name' => 'Facebook',
                'input_url'  => 'https://web.facebook.com/hathanyCosmosFoundation',
                'input_icon' => 'facebook',
            ],
        ];
        foreach ($socials as $row) {
            $this->seedOnce('panel_social_media_platform', $row, 'hash_id');
        }

        // 5. Initiatives
        $initiatives = [
            [
                'hash_id'          => 'init_community_outreach',
                'visibility'       => 'show',
                'input_slug'       => 'community-outreach',
                'input_title'      => 'Community Outreach',
                'text_summary'     => 'Supporting vulnerable individuals and families through targeted relief and engagement.',
                'input_programme'  => 'Community Relief Programs',
                'text_description' => 'Providing essential support to individuals and families during times of need.',
                'text_body'        => 'We meet people where they are. Our outreach teams work directly with families in situations of hardship, providing relief that responds to the need in front of us rather than the need we assumed.',
                'input_icon'       => 'hands',
                'input_image'      => $img('photo-1593113630400-ea4288922497'),
                'input_accent'     => 'teal',
            ],
            [
                'hash_id'          => 'init_education_support',
                'visibility'       => 'show',
                'input_slug'       => 'education-support',
                'input_title'      => 'Education Support',
                'text_summary'     => 'Providing learning support, mentorship, and opportunities for young people to thrive.',
                'input_programme'  => 'Educational Support Initiatives',
                'text_description' => 'Encouraging learning, personal growth, and access to educational opportunities.',
                'text_body'        => 'Education changes the arc of a life. We invest in learning support, mentorship and access, so that circumstance does not decide how far a young person can go.',
                'input_icon'       => 'book',
                'input_image'      => $img('photo-1503676260728-1c00da094a0b'),
                'input_accent'     => 'ember',
            ],
            [
                'hash_id'          => 'init_health_social_care',
                'visibility'       => 'show',
                'input_slug'       => 'health-social-care',
                'input_title'      => 'Health & Social Care',
                'text_summary'     => 'Promoting wellbeing through awareness, access, and community-based interventions.',
                'input_programme'  => 'Health & Awareness Programs',
                'text_description' => 'Promoting healthier communities through education and support services.',
                'text_body'        => 'Good health should not depend on proximity to a clinic. We work on awareness, access and community-based care that reaches people early rather than late.',
                'input_icon'       => 'heart',
                'input_image'      => $img('photo-1576091160550-2173dba999ef'),
                'input_accent'     => 'teal',
            ],
            [
                'hash_id'          => 'init_community_development',
                'visibility'       => 'show',
                'input_slug'       => 'community-development',
                'input_title'      => 'Community Development',
                'text_summary'     => 'Building capacity and empowering communities for sustainable growth.',
                'input_programme'  => 'Youth & Community Development',
                'text_description' => 'Equipping individuals with skills, confidence, and resources to improve their future.',
                'text_body'        => 'Lasting change is built locally. We equip communities with the skills, confidence and resources to carry their own progress forward long after a programme ends.',
                'input_icon'       => 'growth',
                'input_image'      => $img('photo-1531482615713-2afd69097998'),
                'input_accent'     => 'ember',
            ],
        ];
        foreach ($initiatives as $row) {
            $this->seedOnce('panel_initiatives', $row, 'hash_id');
        }

        // 6. Impact Stats
        $impactStats = [
            ['hash_id' => 'stat_1', 'visibility' => 'show', 'input_value' => 12000, 'input_suffix' => '+', 'input_label' => 'Lives touched',      'input_note' => 'across outreach and relief programmes'],
            ['hash_id' => 'stat_2', 'visibility' => 'show', 'input_value' => 45,    'input_suffix' => '',  'input_label' => 'Communities served', 'input_note' => 'in urban and rural settings'],
            ['hash_id' => 'stat_3', 'visibility' => 'show', 'input_value' => 300,   'input_suffix' => '+', 'input_label' => 'Active volunteers',  'input_note' => 'giving time, skill and presence'],
            ['hash_id' => 'stat_4', 'visibility' => 'show', 'input_value' => 8,     'input_suffix' => '',  'input_label' => 'Years of service',   'input_note' => 'consistent, accountable delivery'],
        ];
        foreach ($impactStats as $row) {
            $this->seedOnce('panel_impact_stats', $row, 'hash_id');
        }

        // 7. Core Values
        $coreValues = [
            ['hash_id' => 'val_1', 'visibility' => 'show', 'input_title' => 'Compassion',       'text_body' => 'We begin with the person, not the programme.',            'input_icon' => 'heart'],
            ['hash_id' => 'val_2', 'visibility' => 'show', 'input_title' => 'Integrity',        'text_body' => 'We do what we said we would do, and we say what we did.', 'input_icon' => 'shield'],
            ['hash_id' => 'val_3', 'visibility' => 'show', 'input_title' => 'Accountability',   'text_body' => 'Every contribution is traceable to an outcome.',          'input_icon' => 'check'],
            ['hash_id' => 'val_4', 'visibility' => 'show', 'input_title' => 'Service',          'text_body' => 'We show up consistently, not occasionally.',              'input_icon' => 'hands'],
            ['hash_id' => 'val_5', 'visibility' => 'show', 'input_title' => 'Community Impact', 'text_body' => 'We measure success in lives changed, not activity.',      'input_icon' => 'growth'],
        ];
        foreach ($coreValues as $row) {
            $this->seedOnce('panel_core_values', $row, 'hash_id');
        }

        // 8. Volunteer Benefits
        $volunteerBenefits = [
            ['hash_id' => 'vben_1', 'visibility' => 'show', 'input_title' => 'Make a tangible difference',        'text_body' => 'Work that ends in a result you can point to.'],
            ['hash_id' => 'vben_2', 'visibility' => 'show', 'input_title' => 'Serve alongside like-minded people','text_body' => 'Join a team that shares your conviction.'],
            ['hash_id' => 'vben_3', 'visibility' => 'show', 'input_title' => 'Gain valuable experience',          'text_body' => 'Build real skills in the field, not in theory.'],
            ['hash_id' => 'vben_4', 'visibility' => 'show', 'input_title' => 'Be part of meaningful community change', 'text_body' => 'Contribute to outcomes that outlast the day.'],
        ];
        foreach ($volunteerBenefits as $row) {
            $this->seedOnce('panel_volunteer_benefits', $row, 'hash_id');
        }

        // 9. Volunteer Roles
        $volunteerRoles = [
            ['hash_id' => 'vrole_1', 'visibility' => 'show', 'input_title' => 'Community Outreach',      'text_body' => 'Join field teams delivering relief and engaging directly with families.',  'input_icon' => 'hands'],
            ['hash_id' => 'vrole_2', 'visibility' => 'show', 'input_title' => 'Event & Program Support',  'text_body' => 'Help plan and run the programmes that carry our work into communities.',  'input_icon' => 'calendar'],
            ['hash_id' => 'vrole_3', 'visibility' => 'show', 'input_title' => 'Media & Communications',   'text_body' => 'Tell the story — photography, writing, social media and design.',         'input_icon' => 'camera'],
            ['hash_id' => 'vrole_4', 'visibility' => 'show', 'input_title' => 'Administrative Assistance', 'text_body' => 'Keep the engine running through coordination, records and logistics.',   'input_icon' => 'clipboard'],
        ];
        foreach ($volunteerRoles as $row) {
            $this->seedOnce('panel_volunteer_roles', $row, 'hash_id');
        }

        // 10. Team Members
        $team = [
            ['hash_id' => 'team_1', 'visibility' => 'show', 'input_name' => 'Name Pending', 'input_role' => 'Chair, Board of Trustees', 'input_group' => 'Board & Leadership', 'input_image' => $img('photo-1560250097-0b93528c311a', 600, 700)],
            ['hash_id' => 'team_2', 'visibility' => 'show', 'input_name' => 'Name Pending', 'input_role' => 'Executive Director',       'input_group' => 'Board & Leadership', 'input_image' => $img('photo-1573497019940-1c28c88b4f3e', 600, 700)],
            ['hash_id' => 'team_3', 'visibility' => 'show', 'input_name' => 'Name Pending', 'input_role' => 'Trustee',                  'input_group' => 'Board & Leadership', 'input_image' => $img('photo-1544027993-37dbfe43562a', 600, 700)],
            ['hash_id' => 'team_4', 'visibility' => 'show', 'input_name' => 'Name Pending', 'input_role' => 'Programmes Lead',          'input_group' => 'Operations Team',    'input_image' => $img('photo-1521791136064-7986c2920216', 600, 700)],
            ['hash_id' => 'team_5', 'visibility' => 'show', 'input_name' => 'Name Pending', 'input_role' => 'Outreach Coordinator',      'input_group' => 'Operations Team',    'input_image' => $img('photo-1522202176988-66273c2fd55f', 600, 700)],
            ['hash_id' => 'team_6', 'visibility' => 'show', 'input_name' => 'Name Pending', 'input_role' => 'Communications',          'input_group' => 'Operations Team',    'input_image' => $img('photo-1552664730-d307ca884978', 600, 700)],
        ];
        foreach ($team as $row) {
            $this->seedOnce('panel_team', $row, 'hash_id');
        }

        // 11. Gallery Items
        $gallery = [
            ['hash_id' => 'gal_1',  'visibility' => 'show', 'input_category' => 'Outreach Programs',    'input_caption' => 'Relief distribution',        'input_image' => $img('photo-1593113630400-ea4288922497', 900, 1100)],
            ['hash_id' => 'gal_2',  'visibility' => 'show', 'input_category' => 'Community Engagement', 'input_caption' => 'Listening to the community', 'input_image' => $img('photo-1511632765486-a01980e01a18', 900, 700)],
            ['hash_id' => 'gal_3',  'visibility' => 'show', 'input_category' => 'Events & Activities',  'input_caption' => 'Programme launch',           'input_image' => $img('photo-1540575467063-178a50c2df87', 900, 700)],
            ['hash_id' => 'gal_4',  'visibility' => 'show', 'input_category' => 'Volunteers in Action', 'input_caption' => 'Field team at work',         'input_image' => $img('photo-1559027615-cd4628902d4a', 900, 1100)],
            ['hash_id' => 'gal_5',  'visibility' => 'show', 'input_category' => 'Outreach Programs',    'input_caption' => 'School supplies drive',      'input_image' => $img('photo-1503676260728-1c00da094a0b', 900, 700)],
            ['hash_id' => 'gal_6',  'visibility' => 'show', 'input_category' => 'Community Engagement', 'input_caption' => 'Community gathering',        'input_image' => $img('photo-1517486808906-6ca8b3f04846', 900, 1100)],
            ['hash_id' => 'gal_7',  'visibility' => 'show', 'input_category' => 'Volunteers in Action', 'input_caption' => 'Volunteer briefing',         'input_image' => $img('photo-1531482615713-2afd69097998', 900, 700)],
            ['hash_id' => 'gal_8',  'visibility' => 'show', 'input_category' => 'Events & Activities',  'input_caption' => 'Health awareness day',       'input_image' => $img('photo-1576091160550-2173dba999ef', 900, 700)],
            ['hash_id' => 'gal_9',  'visibility' => 'show', 'input_category' => 'Outreach Programs',    'input_caption' => 'Food parcel packing',        'input_image' => $img('photo-1488521787991-ed7bbaae773c', 900, 1100)],
            ['hash_id' => 'gal_10', 'visibility' => 'show', 'input_category' => 'Community Engagement', 'input_caption' => 'Household visits',           'input_image' => $img('photo-1509099836639-18ba1795216d', 900, 700)],
            ['hash_id' => 'gal_11', 'visibility' => 'show', 'input_category' => 'Events & Activities',  'input_caption' => 'Annual review meeting',      'input_image' => $img('photo-1543269865-cbf427effbad', 900, 700)],
            ['hash_id' => 'gal_12', 'visibility' => 'show', 'input_category' => 'Volunteers in Action', 'input_caption' => 'Setting up for outreach',    'input_image' => $img('photo-1552664730-d307ca884978', 900, 1100)],
            ['hash_id' => 'gal_13', 'visibility' => 'show', 'input_category' => 'Outreach Programs',    'input_caption' => 'Mentorship session',         'input_image' => $img('photo-1522202176988-66273c2fd55f', 900, 700)],
            ['hash_id' => 'gal_14', 'visibility' => 'show', 'input_category' => 'Community Engagement', 'input_caption' => 'Neighbourhood consultation', 'input_image' => $img('photo-1517048676732-d65bc937f952', 900, 700)],
            ['hash_id' => 'gal_15', 'visibility' => 'show', 'input_category' => 'Events & Activities',  'input_caption' => 'Volunteer recognition',      'input_image' => $img('photo-1571019613454-1cb2f99b2d8b', 900, 1100)],
            ['hash_id' => 'gal_16', 'visibility' => 'show', 'input_category' => 'Volunteers in Action', 'input_caption' => 'Logistics and sorting',      'input_image' => $img('photo-1497633762265-9d179a990aa6', 900, 700)],
            ['hash_id' => 'gal_17', 'visibility' => 'show', 'input_category' => 'Outreach Programs',    'input_caption' => 'Rural community visit',      'input_image' => $img('photo-1469571486292-0ba58a3f068b', 900, 700)],
            ['hash_id' => 'gal_18', 'visibility' => 'show', 'input_category' => 'Volunteers in Action', 'input_caption' => 'Team debrief',               'input_image' => $img('photo-1573497019940-1c28c88b4f3e', 900, 1100)],
        ];
        foreach ($gallery as $row) {
            $this->seedOnce('panel_gallery', $row, 'hash_id');
        }

        // 12. Blog Articles
        $blogPosts = [
            [
                'hash_id'        => 'post_1',
                'visibility'     => 'show',
                'input_slug'     => 'sample-impact-story',
                'input_title'    => 'What changes when someone shows up consistently',
                'text_excerpt'   => 'A look at why continuity matters more than scale in the communities we serve, and what we have learned from staying.',
                'input_category' => 'Impact Stories',
                'input_date'     => '12 August 2026',
                'input_read_time'=> '5 min read',
                'input_image'    => $img('photo-1488521787991-ed7bbaae773c'),
                'input_author'   => 'HC Foundation',
            ],
            [
                'hash_id'        => 'post_2',
                'visibility'     => 'show',
                'input_slug'     => 'sample-program-update',
                'input_title'    => 'Education support: where the programme stands',
                'text_excerpt'   => 'An update on mentorship placements, learning support and what the next quarter looks like.',
                'input_category' => 'Program Updates',
                'input_date'     => '29 July 2026',
                'input_read_time'=> '4 min read',
                'input_image'    => $img('photo-1503676260728-1c00da094a0b'),
                'input_author'   => 'HC Foundation',
            ],
            [
                'hash_id'        => 'post_3',
                'visibility'     => 'show',
                'input_slug'     => 'sample-community-voice',
                'input_title'    => 'In their words: three families, one year on',
                'text_excerpt'   => 'We went back to ask what actually changed. The answers were not the ones we expected.',
                'input_category' => 'Community Voices',
                'input_date'     => '14 July 2026',
                'input_read_time'=> '7 min read',
                'input_image'    => $img('photo-1509099836639-18ba1795216d'),
                'input_author'   => 'HC Foundation',
            ],
            [
                'hash_id'        => 'post_4',
                'visibility'     => 'show',
                'input_slug'     => 'sample-reflection',
                'input_title'    => 'Measuring impact without flattening people into numbers',
                'text_excerpt'   => 'Reflections on accountability, reporting, and holding both rigour and humanity at once.',
                'input_category' => 'Reflections & Insights',
                'input_date'     => '02 July 2026',
                'input_read_time'=> '6 min read',
                'input_image'    => $img('photo-1497633762265-9d179a990aa6'),
                'input_author'   => 'HC Foundation',
            ],
            [
                'hash_id'        => 'post_5',
                'visibility'     => 'show',
                'input_slug'     => 'sample-health-awareness',
                'input_title'    => 'Bringing health awareness closer to home',
                'text_excerpt'   => 'Community-based interventions reach people earlier. Here is how we are building that out.',
                'input_category' => 'Program Updates',
                'input_date'     => '20 June 2026',
                'input_read_time'=> '5 min read',
                'input_image'    => $img('photo-1576091160550-2173dba999ef'),
                'input_author'   => 'HC Foundation',
            ],
            [
                'hash_id'        => 'post_6',
                'visibility'     => 'show',
                'input_slug'     => 'sample-volunteer-story',
                'input_title'    => 'Why our volunteers keep coming back',
                'text_excerpt'   => 'Six volunteers on what keeps them in the work, in their own words.',
                'input_category' => 'Community Voices',
                'input_date'     => '05 June 2026',
                'input_read_time'=> '4 min read',
                'input_image'    => $img('photo-1531482615713-2afd69097998'),
                'input_author'   => 'HC Foundation',
            ],
            [
                'hash_id'        => 'post_7',
                'visibility'     => 'show',
                'input_slug'     => 'sample-outreach-recap',
                'input_title'    => 'Notes from a month of community outreach',
                'text_excerpt'   => 'What four weeks in the field taught us about planning, listening and adjusting.',
                'input_category' => 'Impact Stories',
                'input_date'     => '22 May 2026',
                'input_read_time'=> '6 min read',
                'input_image'    => $img('photo-1593113630400-ea4288922497'),
                'input_author'   => 'HC Foundation',
            ],
            [
                'hash_id'        => 'post_8',
                'visibility'     => 'show',
                'input_slug'     => 'sample-partnership',
                'input_title'    => 'Working with partners without losing focus',
                'text_excerpt'   => 'Collaboration multiplies reach, but only when everyone is clear on who is accountable for what.',
                'input_category' => 'Reflections & Insights',
                'input_date'     => '08 May 2026',
                'input_read_time'=> '5 min read',
                'input_image'    => $img('photo-1543269865-cbf427effbad'),
                'input_author'   => 'HC Foundation',
            ],
            [
                'hash_id'        => 'post_9',
                'visibility'     => 'show',
                'input_slug'     => 'sample-youth-development',
                'input_title'    => 'Building skills that outlast the programme',
                'text_excerpt'   => 'Youth development works when the capacity stays behind after we do not.',
                'input_category' => 'Program Updates',
                'input_date'     => '19 April 2026',
                'input_read_time'=> '5 min read',
                'input_image'    => $img('photo-1522202176988-66273c2fd55f'),
                'input_author'   => 'HC Foundation',
            ],
            [
                'hash_id'        => 'post_10',
                'visibility'     => 'show',
                'input_slug'     => 'sample-listening-first',
                'input_title'    => 'Listening first: how we decide what to do next',
                'text_excerpt'   => 'Every initiative starts with a conversation we did not lead. Here is how that works in practice.',
                'input_category' => 'Reflections & Insights',
                'input_date'     => '03 April 2026',
                'input_read_time'=> '7 min read',
                'input_image'    => $img('photo-1517486808906-6ca8b3f04846'),
                'input_author'   => 'HC Foundation',
            ],
            [
                'hash_id'        => 'post_11',
                'visibility'     => 'show',
                'input_slug'     => 'sample-family-story',
                'input_title'    => 'One household, four seasons of support',
                'text_excerpt'   => 'Following a single family through a year of relief, schooling and health access.',
                'input_category' => 'Impact Stories',
                'input_date'     => '17 March 2026',
                'input_read_time'=> '8 min read',
                'input_image'    => $img('photo-1469571486292-0ba58a3f068b'),
                'input_author'   => 'HC Foundation',
            ],
            [
                'hash_id'        => 'post_12',
                'visibility'     => 'show',
                'input_slug'     => 'sample-community-voice-2',
                'input_title'    => 'Three programmes, one clinic, one afternoon',
                'text_excerpt'   => 'A volunteer, a teacher and a nurse on where their work overlaps.',
                'input_category' => 'Community Voices',
                'input_date'     => '28 February 2026',
                'input_read_time'=> '6 min read',
                'input_image'    => $img('photo-1552664730-d307ca884978'),
                'input_author'   => 'HC Foundation',
            ],
            [
                'hash_id'        => 'post_13',
                'visibility'     => 'show',
                'input_slug'     => 'sample-year-in-review',
                'input_title'    => 'The year in review, including what did not work',
                'text_excerpt'   => 'Reporting honestly on the programmes that fell short, and what we changed because of them.',
                'input_category' => 'Impact Stories',
                'input_date'     => '15 January 2026',
                'input_read_time'=> '9 min read',
                'input_image'    => $img('photo-1497486751825-1233686d5d80'),
                'input_author'   => 'HC Foundation',
            ],
        ];
        foreach ($blogPosts as $row) {
            $this->seedOnce('panel_blog', $row, 'hash_id');
        }

        // 13. FAQs
        $faqs = [
            [
                'hash_id'        => 'faq_1',
                'visibility'     => 'show',
                'input_question' => 'How can I get involved with HC Foundation?',
                'text_answer'    => 'Through volunteering, partnership or advocacy. The volunteer page lists current openings, and the form on this page reaches us directly.',
            ],
            [
                'hash_id'        => 'faq_2',
                'visibility'     => 'show',
                'input_question' => 'Do you accept partnership proposals from organisations?',
                'text_answer'    => 'Yes. We work with organisations whose objectives align with ours. Send an outline of what you have in mind and we will come back to you.',
            ],
            [
                'hash_id'        => 'faq_3',
                'visibility'     => 'show',
                'input_question' => 'Where does HC Foundation currently operate?',
                'text_answer'    => 'We work across urban and rural communities, prioritising areas where existing support is thinnest.',
            ],
            [
                'hash_id'        => 'faq_4',
                'visibility'     => 'show',
                'input_question' => 'How quickly will I hear back?',
                'text_answer'    => 'We aim to respond to every message within two working days.',
            ],
        ];
        foreach ($faqs as $row) {
            $this->seedOnce('panel_faqs', $row, 'hash_id');
        }

        // 14. Partners
        $partners = [
            ['hash_id' => 'part_1', 'visibility' => 'show', 'input_name' => 'Community Trust'],
            ['hash_id' => 'part_2', 'visibility' => 'show', 'input_name' => 'Health Alliance'],
            ['hash_id' => 'part_3', 'visibility' => 'show', 'input_name' => 'Learning Futures'],
            ['hash_id' => 'part_4', 'visibility' => 'show', 'input_name' => 'Civic Council'],
            ['hash_id' => 'part_5', 'visibility' => 'show', 'input_name' => 'Care Network'],
            ['hash_id' => 'part_6', 'visibility' => 'show', 'input_name' => 'Youth Coalition'],
        ];
        foreach ($partners as $row) {
            $this->seedOnce('panel_partners', $row, 'hash_id');
        }

        echo "All Hathany Cosmos Foundation data seeded successfully!\n";
    }
}
