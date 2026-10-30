<?php
/**
 * Page content tables for ADMC live edit.
 *
 * Creates one settings_* table per page section and the panel_* tables for
 * repeating page items, and adds the extra columns that existing panel_*
 * tables now render. Column lists come from v1/views/includes/page_content.php
 * so the schema and the defaults cannot drift apart; types follow the ADMC
 * column prefixes:
 *
 *   input_*      VARCHAR(255)   (input_image VARCHAR(500): placeholder URL)
 *   text_*       TEXT           (text_content LONGTEXT: rich editor body)
 *   image_1      VARCHAR(255)   written by the ADMC image editor
 *
 * Adding a field later means adding it to page_content.php AND writing a new
 * migration; this one only runs once.
 */

return new class {
    private function content(): array {
        return require dirname(__DIR__, 2) . '/v1/views/includes/page_content.php';
    }

    private function addColumn($table, string $name): void {
        if ($name === 'text_content') {
            $table->longText($name)->nullable();
        } elseif (strpos($name, 'text_') === 0) {
            $table->text($name)->nullable();
        } elseif ($name === 'input_image') {
            $table->string($name, 500)->nullable();
        } else {
            $table->string($name, 255)->nullable();
        }
    }

    private function createTable($migration, string $name, array $columns): void {
        $migration->table($name, function ($table) use ($columns) {
            $table->id();
            $table->string('hash_id', 255)->nullable();
            $table->string('visibility', 50)->default('show');
            foreach ($columns as $column) {
                if (in_array($column, ['id', 'hash_id', 'visibility'], true)) {
                    continue;
                }
                $this->addColumn($table, $column);
            }
            $table->string('created_by', 255)->nullable();
            $table->timestamps();
        });
    }

    public function up($migration) {
        $content = $this->content();

        foreach ($content['settings'] as $name => $fields) {
            $this->createTable($migration, $name, array_keys($fields));
        }

        foreach ($content['panels'] as $name => $rows) {
            $columns = [];
            foreach ($rows as $row) {
                $columns = array_merge($columns, array_keys($row));
            }
            $this->createTable($migration, $name, array_values(array_unique($columns)));
        }

        // Existing tables: the migrator only adds columns that are missing.
        foreach ($content['row_defaults'] as $name => $fields) {
            $migration->table($name, function ($table) use ($fields) {
                foreach (array_keys($fields) as $column) {
                    $this->addColumn($table, $column);
                }
            });
        }
    }

    public function down($migration) {
        $content = $this->content();

        foreach ($content['row_defaults'] as $name => $fields) {
            $migration->table($name, function ($table) use ($fields) {
                foreach (array_keys($fields) as $column) {
                    $table->dropColumn($column);
                }
            });
        }

        foreach (array_merge(array_keys($content['panels']), array_keys($content['settings'])) as $name) {
            $migration->dropTable($name);
        }
    }
};
