<?php
use App\Migrator\Seeder;

/**
 * Seeds the page content tables from v1/views/includes/page_content.php.
 *
 * Safe to run any number of times and never overwrites an admin's edits:
 *   - a settings_* table gets its single row only if it has none; on an
 *     existing row, only columns still NULL are filled
 *   - a panel_* row is inserted only if its hash_id is not there yet
 *   - new columns on existing panel_* rows are filled only where empty
 *
 * Run it on its own so the older seeders are not re-run:
 *   php mck seed HCFoundationPageContentSeeder
 */
class HCFoundationPageContentSeeder extends Seeder {

    public function run() {
        echo "Seeding page content...\n";
        $content = require dirname(__DIR__, 2) . '/v1/views/includes/page_content.php';

        foreach ($content['settings'] as $table => $fields) {
            $count = (int) $this->pdo->query("SELECT COUNT(*) FROM `$table`")->fetchColumn();
            if ($count === 0) {
                $this->insert($table, ['hash_id' => $table, 'visibility' => 'show'] + $fields);
                echo "  + $table\n";
                continue;
            }
            // Row exists: fill only columns that have never been set (NULL),
            // e.g. a field added to page_content.php after the first seed.
            foreach ($fields as $column => $value) {
                $stmt = $this->pdo->prepare("UPDATE `$table` SET `$column` = ? WHERE `$column` IS NULL");
                $stmt->execute([$value]);
                if ($stmt->rowCount() > 0) {
                    echo "  ~ $table.$column\n";
                }
            }
        }

        foreach ($content['panels'] as $table => $rows) {
            $exists = $this->pdo->prepare("SELECT COUNT(*) FROM `$table` WHERE hash_id = ?");
            foreach ($rows as $row) {
                $exists->execute([$row['hash_id']]);
                if ((int) $exists->fetchColumn() === 0) {
                    $this->insert($table, ['visibility' => 'show'] + $row);
                    echo "  + $table: {$row['hash_id']}\n";
                }
            }
        }

        foreach ($content['row_defaults'] as $table => $fields) {
            foreach ($fields as $column => $value) {
                if ($value === '') {
                    continue;
                }
                $stmt = $this->pdo->prepare("UPDATE `$table` SET `$column` = ? WHERE `$column` IS NULL OR `$column` = ''");
                $stmt->execute([$value]);
                if ($stmt->rowCount() > 0) {
                    echo "  ~ $table.$column ({$stmt->rowCount()} rows)\n";
                }
            }
        }

        echo "Page content seeded.\n";
    }
}
