<?php
/**
 * ADMC live-edit attributes.
 *
 * admc.min.js (loaded in footer.php for logged-in admins) puts edit controls
 * on elements carrying these data attributes and saves through
 * https://<admc cookie>.admc.dev. See ADMC.md section 9.
 *
 *   <h3 <?= admc_edit('panel_team', $m['id']) ?>>      text fields of a row
 *   <div <?= admc_image('panel_team', $m['id']) ?>>    image_1 of a row (wrapper, not the <img>)
 *   <div <?= admc_list('panel_team') ?>>               "Add new" on a list container
 *
 * Each returns an empty string when there is no row id, which is the case in
 * DESIGN_MODE (static content, no database), so the markup stays clean there.
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
