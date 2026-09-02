<?php
namespace App\Migrator;

abstract class Seeder {
    protected $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    abstract public function run();

    /**
     * Updated Static Runner: Handles all or a specific seeder.
     */
    public static function runAll($pdo, $specificSeeder = null) {
        $path = dirname(__DIR__, 2) . '/../database/seeds/';
        
        if ($specificSeeder) {
            $files = [$path . $specificSeeder . '.php'];
        } else {
            $files = glob($path . '*.php');
        }

        if (empty($files) || ($specificSeeder && !file_exists($files[0]))) {
            echo "No seeder(s) found.\n";
            return;
        }

        foreach ($files as $file) {
            if (file_exists($file)) {
                require_once $file;
                $class = pathinfo($file, PATHINFO_FILENAME);
                if (class_exists($class)) {
                    (new $class($pdo))->run();
                    echo "[Seed] Success: $class\n";
                }
            }
        }
    }

    protected function insert($table, $data) {
        $keys = array_keys($data);
        $fields = implode('`, `', $keys);
        $placeholders = implode(', ', array_fill(0, count($keys), '?'));
        $sql = "INSERT INTO `$table` (`$fields`) VALUES ($placeholders)";
        $this->pdo->prepare($sql)->execute(array_values($data));
    }

    protected function upsert($table, $data, $uniqueKey = 'id') {
        $keys = array_keys($data);
        $fields = implode('`, `', $keys);
        $placeholders = implode(', ', array_fill(0, count($keys), '?'));
        $updates = array_map(fn($k) => "`$k` = VALUES(`$k`)", $keys);
        $sql = "INSERT INTO `$table` (`$fields`) VALUES ($placeholders) ON DUPLICATE KEY UPDATE " . implode(', ', $updates);
        $this->pdo->prepare($sql)->execute(array_values($data));
    }
}