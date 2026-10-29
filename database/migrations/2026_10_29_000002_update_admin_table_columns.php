<?php
/**
 * Brings an existing `admin` table in line with the current schema.
 *
 * Migration 000001 was edited after it had already been run on some servers
 * (commit 30c051a), so those databases still have the original admin columns.
 * This migration renames input_email -> email and adds the columns the login,
 * admin screens and seeder now expect. On a fresh install 000001 already
 * creates everything and this migration changes nothing.
 */

return new class {
    public function up($migration) {
        // Step 1: rename. Kept separate from the adds because the migrator
        // reads the existing columns once per table() call.
        $migration->table('admin', function ($table) {
            $table->renameColumn('input_email', 'email');
        });

        // Step 2: add whatever is still missing, and relax input_password.
        $migration->table('admin', function ($table) {
            $table->string('firstname', 100)->default('Admin');
            $table->string('lastname', 100)->default('User');
            $table->string('username', 100)->default('admin');
            $table->string('email', 255)->default('admin@hcfoundations.com');
            $table->string('hash', 255)->nullable();
            $table->string('verification', 50)->default('1');
            $table->string('input_password', 255)->nullable()->change();
        });
    }

    public function down($migration) {
        $migration->table('admin', function ($table) {
            $table->dropColumn('firstname');
            $table->dropColumn('lastname');
            $table->dropColumn('username');
            $table->dropColumn('hash');
            $table->dropColumn('verification');
        });

        $migration->table('admin', function ($table) {
            $table->renameColumn('email', 'input_email');
        });
    }
};
