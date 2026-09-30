<?php
/**
 * Cache-busting stamp for a built asset.
 *
 * app.css and app.js are overwritten in place by the Tailwind build, so their
 * URLs never change and browsers happily serve a stale copy for as long as
 * their cache allows. Appending the file's modification time means every
 * rebuild produces a new URL, and nobody has to be told to hard-refresh.
 *
 *   <link href="/assets/css/app.css?v=<?= asset_version('/assets/css/app.css') ?>">
 */

if (!function_exists('asset_version')) {
    function asset_version(string $webPath): string
    {
        $file = D_PATH . '/www' . $webPath;
        $time = is_file($file) ? filemtime($file) : false;

        return $time ? (string) $time : (string) time();
    }
}
