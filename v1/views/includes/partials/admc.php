<?php
/**
 * ADMC live-edit helpers.
 *
 * admc.min.js (loaded in footer.php for logged-in admins) puts edit controls
 * on elements carrying these data attributes and saves through
 * https://<admc cookie>.admc.dev. See ADMC.md section 9.
 *
 *   <h3 <?= admc_edit('panel_team', $m['id']) ?>>      text fields of a row
 *   <div <?= admc_image('panel_team', $m['id']) ?>>    image_1 of a row (wrapper, not the <img>)
 *   <div <?= admc_list('panel_team') ?>>               "Create / Manage" on a list container
 *
 * Each returns an empty string when there is no row id, which is the case in
 * DESIGN_MODE (static content, no database), so the markup stays clean there.
 *
 * Page copy lives in settings_* rows, loaded into $sections by db_content.php
 * (or static_content.php in design mode):
 *
 *   $s = admc_section('settings_home_hero');
 *   <h1 <?= admc_edit('settings_home_hero', $s['id']) ?>><?= admc_lines($s['input_heading']) ?></h1>
 */

if (!function_exists('admc_edit')) {
    function admc_edit(string $table, $id): string
    {
        if ($id === null || $id === '') {
            return '';
        }
        return 'data-admc-manage="' . htmlspecialchars($table, ENT_QUOTES, 'UTF-8') . '"'
             . ' data-admc-id="' . (int) $id . '"';
    }
}

if (!function_exists('admc_image')) {
    function admc_image(string $table, $id): string
    {
        if ($id === null || $id === '') {
            return '';
        }
        return 'data-admc-image="' . htmlspecialchars($table, ENT_QUOTES, 'UTF-8') . '"'
             . ' data-admc-id="' . (int) $id . '"';
    }
}

if (!function_exists('admc_list')) {
    function admc_list(string $table): string
    {
        if (!empty($GLOBALS['designMode'])) {
            return '';
        }
        return 'data-admc-tb="' . htmlspecialchars($table, ENT_QUOTES, 'UTF-8') . '"';
    }
}

if (!function_exists('admc_section')) {
    /**
     * A settings_* row merged over its defaults from page_content.php.
     * Always has an 'id' key (null when there is no database row).
     */
    function admc_section(string $table): array
    {
        $sections = $GLOBALS['sections'] ?? [];
        return $sections[$table] ?? ['id' => null];
    }
}

if (!function_exists('admc_src')) {
    /**
     * Image URL for a row. image_1 is what ADMC writes when an admin swaps an
     * image; it may be a full URL or a site path. input_image holds the seeded
     * placeholder and is used until an image has been uploaded.
     */
    function admc_src(array $row): string
    {
        $image = trim((string) ($row['image_1'] ?? ''));
        if ($image === '') {
            return (string) ($row['input_image'] ?? '');
        }
        if (preg_match('#^(https?:)?//#i', $image)) {
            return $image;
        }
        return '/' . ltrim($image, '/');
    }
}

if (!function_exists('admc_plain')) {
    /**
     * Escaped plain text for a text_* column.
     *
     * ADMC edits text_* columns with CKEditor, which saves HTML such as
     * "<p>Hello</p>". Where the design wraps the value in its own <p> or <h*>,
     * that markup is stripped so it reads as text instead of showing tags.
     */
    function admc_plain($value): string
    {
        $value = (string) $value;
        if ($value !== strip_tags($value)) {
            $value = preg_replace('#</(p|div|h[1-6]|li|blockquote)>|<br\s*/?>#i', ' ', $value);
            $value = strip_tags($value);
            $value = html_entity_decode($value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $value = trim(preg_replace('/\s+/u', ' ', $value));
        }
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('admc_lines')) {
    /**
     * Escaped text where "|" marks a deliberate line break in a heading.
     * $brClass lets a break apply only at some sizes, e.g. 'hidden sm:block'.
     */
    function admc_lines($value, string $brClass = ''): string
    {
        $parts = array_map('trim', explode('|', admc_plain($value)));
        $br = $brClass !== '' ? '<br class="' . htmlspecialchars($brClass, ENT_QUOTES, 'UTF-8') . '">' : '<br>';
        return implode($br . ' ', $parts);
    }
}

if (!function_exists('admc_rich')) {
    /**
     * HTML body from a text_content column (ADMC rich editor). Only admins
     * can write it; script tags and inline handlers are removed anyway.
     */
    function admc_rich($value): string
    {
        $value = (string) $value;
        $value = preg_replace('#<\s*(script|style|iframe|object|embed)\b[^>]*>.*?<\s*/\s*\1\s*>#is', '', $value);
        $value = preg_replace('#\son[a-z]+\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]+)#i', '', $value);
        $value = preg_replace('#(href|src)\s*=\s*(["\'])\s*javascript:[^"\']*\2#i', '$1="#"', $value);
        if ($value !== '' && $value === strip_tags($value)) {
            // Plain text typed without the editor: keep its paragraphs.
            $value = '<p>' . implode('</p><p>', array_map('htmlspecialchars', preg_split('/\R{2,}/', trim($value)))) . '</p>';
        }
        return $value;
    }
}
