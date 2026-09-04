<?php
/**
 * Inline SVG icon set. Inline rather than a font so icons inherit currentColor,
 * scale cleanly and cost no extra request.
 *
 *   <?= icon('heart', 'h-6 w-6') ?>
 */

if (!function_exists('icon')) {

    function icon(string $name, string $class = 'h-6 w-6'): string
    {
        $paths = [
            'hands'     => '<path d="M7 11V6a2 2 0 1 1 4 0v5m0 0V4a2 2 0 1 1 4 0v7m0 0V6a2 2 0 1 1 4 0v9a6 6 0 0 1-6 6h-2a6 6 0 0 1-6-6v-3a2 2 0 1 1 4 0"/>',
            'book'      => '<path d="M12 7v13m0-13a5 5 0 0 0-5-5H3v14h4a5 5 0 0 1 5 5m0-19a5 5 0 0 1 5-5h4v14h-4a5 5 0 0 0-5 5"/>',
            'heart'     => '<path d="M20.8 5.6a5.1 5.1 0 0 0-7.2 0L12 7.2l-1.6-1.6a5.1 5.1 0 0 0-7.2 7.2l8.8 8.8 8.8-8.8a5.1 5.1 0 0 0 0-7.2Z"/>',
            'growth'    => '<path d="M3 21h18M7 21V11m5 10V6m5 15v-7M4 8l5-5 4 4 6-6"/>',
            'shield'    => '<path d="M12 2 4 5.5v6c0 5 3.4 9.4 8 10.5 4.6-1.1 8-5.5 8-10.5v-6L12 2Z"/><path d="m9 12 2 2 4-4"/>',
            'check'     => '<path d="M12 2 4 5.5v6c0 5 3.4 9.4 8 10.5 4.6-1.1 8-5.5 8-10.5v-6L12 2Z"/>',
            'calendar'  => '<rect x="3" y="5" width="18" height="16" rx="2"/><path d="M16 3v4M8 3v4M3 11h18"/>',
            'camera'    => '<path d="M3 8a2 2 0 0 1 2-2h2l1.5-2h7L17 6h2a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8Z"/><circle cx="12" cy="13" r="3.5"/>',
            'clipboard' => '<path d="M9 4h6a1 1 0 0 1 1 1v1H8V5a1 1 0 0 1 1-1Z"/><path d="M16 6h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h2"/><path d="M9 12h6M9 16h4"/>',
            'arrow'     => '<path d="M5 12h14m0 0-6-6m6 6-6 6"/>',
            'arrow-ul'  => '<path d="M7 17 17 7m0 0H8m9 0v9"/>',
            'mail'      => '<rect x="2" y="4" width="20" height="16" rx="2"/><path d="m2 7 10 6 10-6"/>',
            'phone'     => '<path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 1.9.7 2.8a2 2 0 0 1-.4 2.1L8.1 9.9a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.6 2.8.7a2 2 0 0 1 1.7 2Z"/>',
            'pin'       => '<path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/>',
            'quote'     => '<path d="M10 11H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v8a4 4 0 0 1-4 4m14-8h-4a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v8a4 4 0 0 1-4 4"/>',
            'play'      => '<circle cx="12" cy="12" r="10"/><path d="m10 8 6 4-6 4V8Z"/>',
            'plus'      => '<path d="M12 5v14M5 12h14"/>',
            'search'    => '<circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/>',
            'star'      => '<path d="m12 3 2.6 5.6 6 .8-4.4 4.2 1.1 6-5.3-2.9-5.3 2.9 1.1-6L3.4 9.4l6-.8L12 3Z"/>',
            'users'     => '<path d="M16 20v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 20v-2a4 4 0 0 0-3-3.9"/><path d="M16 3.1a4 4 0 0 1 0 7.8"/>',
            'menu'      => '<path d="M4 7h16M4 12h16M4 17h16"/>',
            'close'     => '<path d="M6 6 18 18M18 6 6 18"/>',
            'chevron'   => '<path d="m6 9 6 6 6-6"/>',
            'gift'      => '<rect x="3" y="9" width="18" height="12" rx="2"/><path d="M3 13h18M12 9v12"/><path d="M12 9C10.5 9 7 8.6 7 6.5A2.5 2.5 0 0 1 12 6a2.5 2.5 0 0 1 5 .5C17 8.6 13.5 9 12 9Z"/>',
            // Filled glyph, so it overrides the stroke defaults on the wrapper.
            'whatsapp'  => '<path fill="currentColor" stroke="none" d="M12.04 2.5A9.4 9.4 0 0 0 2.6 11.9c0 1.66.44 3.28 1.27 4.71L2.5 21.5l5-1.3a9.4 9.4 0 0 0 4.54 1.16h.01a9.4 9.4 0 0 0 9.44-9.4 9.4 9.4 0 0 0-9.45-9.46Zm5.5 13.42c-.23.65-1.35 1.24-1.86 1.28-.48.05-.93.22-3.14-.65-2.63-1.04-4.3-3.72-4.43-3.9-.13-.17-1.06-1.4-1.06-2.68 0-1.27.67-1.9.9-2.16.24-.26.52-.32.69-.32l.5.01c.16.01.37-.06.58.45.22.52.74 1.8.8 1.93.07.13.11.29.02.46-.08.17-.13.28-.26.44l-.39.45c-.13.13-.26.28-.11.54.15.26.67 1.11 1.45 1.8 1 .89 1.84 1.17 2.1 1.3.26.13.41.11.56-.07.15-.17.65-.75.82-1.01.17-.26.34-.22.58-.13.24.09 1.52.72 1.78.85.26.13.43.2.5.3.06.11.06.61-.17 1.25Z"/>',
        ];

        $d = $paths[$name] ?? $paths['arrow'];

        return '<svg class="' . $class . '" viewBox="0 0 24 24" fill="none" stroke="currentColor"'
             . ' stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">'
             . $d . '</svg>';
    }
}

if (!function_exists('social_icon')) {

    function social_icon(string $name, string $class = 'h-4 w-4'): string
    {
        $paths = [
            'facebook'  => '<path d="M14 9h3V6h-3a4 4 0 0 0-4 4v2H8v3h2v7h3v-7h2.5l.5-3h-3v-2a1 1 0 0 1 1-1Z"/>',
            'instagram' => '<rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1.2" fill="currentColor" stroke="none"/>',
            'youtube'   => '<rect x="2.5" y="5.5" width="19" height="13" rx="4"/><path d="m10.5 9.5 5 2.5-5 2.5v-5Z"/>',
            'x'         => '<path d="m4 4 16 16M20 4 4 20"/>',
            'linkedin'  => '<rect x="3" y="3" width="18" height="18" rx="3"/><path d="M8 10v7M8 7v.01M12 17v-4a2 2 0 0 1 4 0v4"/>',
        ];

        $d = $paths[$name] ?? $paths['x'];

        return '<svg class="' . $class . '" viewBox="0 0 24 24" fill="none" stroke="currentColor"'
             . ' stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">'
             . $d . '</svg>';
    }
}
