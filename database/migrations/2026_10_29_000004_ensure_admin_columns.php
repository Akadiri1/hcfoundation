<?php
/**
 * Makes sure the `admin` table has every column the app and seeders use.
 *
 * Some servers ended up without columns such as `username` even after 000002
 * (their `admin` table came from a different starting point than 000001), and
 * HCFoundationSeeder then failed with "Unknown column". The migrator only adds
 * columns that are missing, so this is a no-op wherever the table is already
 * complete.
 */

return new class {
    public function up($migration) {
        $migration->table('admin', function ($table) {
            $table->string('hash_id', 255)->nullable();
            $table->string('firstname', 100)->default('Admin');
            $table->string('lastname', 100)->default('User');
            $table->string('username', 100)->default('admin');
            $table->string('input_username', 100)->default('admin');
            $table->string('email', 255)->default('admin@hcfoundations.com');
            $table->string('hash', 255)->nullable();
            $table->string('input_password', 255)->nullable();
            $table->string('verification', 50)->default('1');
            $table->integer('user_status')->default(1);
            $table->string('level', 50)->default('MASTER');
        });
    }

    public function down($migration) {
        // Nothing to undo: the columns belong to the admin schema itself.
    }
};
