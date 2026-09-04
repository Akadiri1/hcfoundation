<?php
/**
 * Brand logo.
 *
 * The client supplied the logo as artwork, so it is served as a file rather
 * than redrawn in markup. Two variants exist:
 *
 *   logo-nav.png        full colour, for light backgrounds
 *   logo-nav-light.png  identical except the neutral grey of the "Foundation"
 *                       script and its two rules is lifted to white. On the
 *                       footer that grey measures 1.72:1, below the 3:1 floor
 *                       for graphical objects. The teal and orange are byte
 *                       for byte the same in both files.
 *
 * Usage:
 *   <?= logo_lockup('dark') ?>                     header, light background
 *   <?= logo_lockup('light') ?>                    footer, dark background
 *   <?= logo_lockup('light', 'h-20 w-auto') ?>     custom size
 *
 * The lockup is stacked (mark above wordmark) with an aspect of 1.169, so
 * always size it by height and leave the width automatic.
 */

if (!function_exists('logo_lockup')) {
    function logo_lockup(string $tone = 'dark', string $class = 'h-[52px] w-auto md:h-[76px]'): string
    {
        $src = $tone === 'light'
            ? '/assets/images/logo-nav-light.png'
            : '/assets/images/logo-nav.png';

        return '<img src="' . $src . '" alt="Hathany Cosmos Foundation"'
             . ' width="300" height="257"'
             . ' class="' . htmlspecialchars($class, ENT_QUOTES) . '"'
             . ' decoding="async">';
    }
}
