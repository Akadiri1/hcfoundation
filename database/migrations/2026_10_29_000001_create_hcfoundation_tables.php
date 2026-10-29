<?php
/**
 * Hathany Cosmos Foundation - Core Tables Migration
 * Generated on 2026-10-29
 */

return new class {
    public function up($migration) {
        // 1. Settings & Identity
        $migration->table('settings_website_info', function ($table) {
            $table->id();
            $table->string('visibility', 50)->default('show');
            $table->string('input_name', 255)->default('Hathany Cosmos Foundation');
            $table->string('input_short_name', 100)->default('HC Foundation');
            $table->string('input_tagline', 255)->default('Restoring Hope. Transforming Lives.');
            $table->text('text_promise')->nullable();
            $table->text('text_description')->nullable();
            $table->string('input_email', 255)->default('contact@hcfoundations.com');
            $table->string('input_phone_number', 100)->default('+1 770-727-6969');
            $table->string('input_address', 255)->default('Lagos, Nigeria');
            $table->string('input_logo', 255)->default('/assets/images/logo.png');
            $table->text('text_about_who')->nullable();
            $table->text('text_about_approach')->nullable();
            $table->text('text_vision')->nullable();
            $table->text('text_mission')->nullable();
            $table->text('text_volunteer_intro')->nullable();
            $table->text('text_team_intro')->nullable();
            $table->string('input_donate_channel', 50)->default('whatsapp');
            $table->string('input_donate_whatsapp', 50)->default('2348000000000');
            $table->text('text_donate_message')->nullable();
            $table->string('input_donate_flutterwave', 255)->nullable();
            $table->integer('maintenance_status')->default(0);
            $table->timestamps();
        });

        // 2. Mail Configuration
        $migration->table('read_mail_config', function ($table) {
            $table->id();
            $table->string('input_mail_username', 255)->nullable();
            $table->string('input_sender', 255)->nullable();
            $table->string('input_password', 255)->nullable();
            $table->string('input_smtp_host', 255)->nullable();
            $table->string('input_smtp_port', 50)->nullable();
            $table->string('input_smtp_secure_type', 50)->nullable();
            $table->timestamps();
        });

        // 3. Admin Users
        $migration->table('admin', function ($table) {
            $table->id();
            $table->string('hash_id', 255)->unique();
            $table->string('input_username', 100)->default('admin');
            $table->string('input_email', 255)->default('admin@hcfoundations.com');
            $table->string('input_password', 255);
            $table->integer('user_status')->default(1);
            $table->string('level', 50)->default('MASTER');
            $table->timestamps();
        });

        // 4. Social Media Platforms
        $migration->table('panel_social_media_platform', function ($table) {
            $table->id();
            $table->string('hash_id', 255)->nullable();
            $table->string('visibility', 50)->default('show');
            $table->string('input_name', 100);
            $table->string('input_url', 255);
            $table->string('input_icon', 100)->default('facebook');
            $table->timestamps();
        });

        // 5. Initiatives
        $migration->table('panel_initiatives', function ($table) {
            $table->id();
            $table->string('hash_id', 255)->nullable();
            $table->string('visibility', 50)->default('show');
            $table->string('input_slug', 255);
            $table->string('input_title', 255);
            $table->text('text_summary')->nullable();
            $table->string('input_programme', 255);
            $table->text('text_description')->nullable();
            $table->text('text_body')->nullable();
            $table->string('input_icon', 100)->default('hands');
            $table->string('input_image', 500)->nullable();
            $table->string('image_1', 255)->nullable();
            $table->string('input_accent', 50)->default('teal');
            $table->timestamps();
        });

        // 6. Impact Stats
        $migration->table('panel_impact_stats', function ($table) {
            $table->id();
            $table->string('hash_id', 255)->nullable();
            $table->string('visibility', 50)->default('show');
            $table->integer('input_value')->default(0);
            $table->string('input_suffix', 50)->default('');
            $table->string('input_label', 255);
            $table->string('input_note', 255)->nullable();
            $table->timestamps();
        });

        // 7. Core Values
        $migration->table('panel_core_values', function ($table) {
            $table->id();
            $table->string('hash_id', 255)->nullable();
            $table->string('visibility', 50)->default('show');
            $table->string('input_title', 255);
            $table->text('text_body')->nullable();
            $table->string('input_icon', 100)->default('heart');
            $table->timestamps();
        });

        // 8. Volunteer Benefits
        $migration->table('panel_volunteer_benefits', function ($table) {
            $table->id();
            $table->string('hash_id', 255)->nullable();
            $table->string('visibility', 50)->default('show');
            $table->string('input_title', 255);
            $table->text('text_body')->nullable();
            $table->timestamps();
        });

        // 9. Volunteer Roles
        $migration->table('panel_volunteer_roles', function ($table) {
            $table->id();
            $table->string('hash_id', 255)->nullable();
            $table->string('visibility', 50)->default('show');
            $table->string('input_title', 255);
            $table->text('text_body')->nullable();
            $table->string('input_icon', 100)->default('hands');
            $table->timestamps();
        });

        // 10. Team Members
        $migration->table('panel_team', function ($table) {
            $table->id();
            $table->string('hash_id', 255)->nullable();
            $table->string('visibility', 50)->default('show');
            $table->string('input_name', 255);
            $table->string('input_role', 255);
            $table->string('input_group', 255)->default('Operations Team');
            $table->string('input_image', 500)->nullable();
            $table->string('image_1', 255)->nullable();
            $table->timestamps();
        });

        // 11. Gallery Items
        $migration->table('panel_gallery', function ($table) {
            $table->id();
            $table->string('hash_id', 255)->nullable();
            $table->string('visibility', 50)->default('show');
            $table->string('input_category', 255);
            $table->string('input_caption', 255);
            $table->string('input_image', 500)->nullable();
            $table->string('image_1', 255)->nullable();
            $table->timestamps();
        });

        // 12. Blog Articles
        $migration->table('panel_blog', function ($table) {
            $table->id();
            $table->string('hash_id', 255)->nullable();
            $table->string('visibility', 50)->default('show');
            $table->string('input_slug', 255);
            $table->string('input_title', 255);
            $table->text('text_excerpt')->nullable();
            $table->string('input_category', 255)->default('Impact Stories');
            $table->string('input_date', 100)->nullable();
            $table->string('input_read_time', 100)->default('5 min read');
            $table->string('input_image', 500)->nullable();
            $table->string('image_1', 255)->nullable();
            $table->string('input_author', 255)->default('HC Foundation');
            $table->longText('text_content')->nullable();
            $table->timestamps();
        });

        // 13. FAQs
        $migration->table('panel_faqs', function ($table) {
            $table->id();
            $table->string('hash_id', 255)->nullable();
            $table->string('visibility', 50)->default('show');
            $table->string('input_question', 500);
            $table->text('text_answer')->nullable();
            $table->timestamps();
        });

        // 14. Partners
        $migration->table('panel_partners', function ($table) {
            $table->id();
            $table->string('hash_id', 255)->nullable();
            $table->string('visibility', 50)->default('show');
            $table->string('input_name', 255);
            $table->timestamps();
        });

        // 15. Members (Volunteers / Registrations)
        $migration->table('panel_members', function ($table) {
            $table->id();
            $table->string('hash_id', 255)->nullable();
            $table->string('input_firstname', 255)->nullable();
            $table->string('input_lastname', 255)->nullable();
            $table->string('input_email', 255)->nullable();
            $table->string('input_phone_number', 100)->nullable();
            $table->string('input_address', 255)->nullable();
            $table->string('input_state', 100)->nullable();
            $table->string('input_city', 100)->nullable();
            $table->string('input_password', 255)->nullable();
            $table->string('verify', 50)->default('no');
            $table->string('verification', 255)->nullable();
            $table->string('input_members_status', 50)->default('active');
            $table->timestamps();
        });
    }

    public function down($migration) {
        $tables = [
            'panel_members',
            'panel_partners',
            'panel_faqs',
            'panel_blog',
            'panel_gallery',
            'panel_team',
            'panel_volunteer_roles',
            'panel_volunteer_benefits',
            'panel_core_values',
            'panel_impact_stats',
            'panel_initiatives',
            'panel_social_media_platform',
            'admin',
            'read_mail_config',
            'settings_website_info',
        ];

        foreach ($tables as $tbl) {
            $migration->dropTable($tbl);
        }
    }
};
