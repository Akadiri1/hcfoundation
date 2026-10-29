<?php
namespace App\Migrator;

class ProjectInitializer extends Initializer {
    
    public function setup() {
        echo "Initializing Hathany Cosmos Foundation Database Setup...\n";

        // 1. Wipe and Migrate all tables
        $this->migrator->fresh();

        // 2. Seed all foundation content
        echo "Populating database tables from seeders...\n";
        Seeder::runAll($this->pdo);

        echo "Initialization complete! All tables and data are ready.\n";
    }
}
