<?php
/**
 * Brand mark, redrawn as SVG so it stays crisp at every size and can be
 * recoloured for dark backgrounds.
 *
 * If the Foundation supplies the original artwork, drop it at
 * www/assets/images/logo.svg and swap the <svg> below for an <img>.
 *
 *   <?= logo_mark('h-12 w-12') ?>          the two figures only
 *   <?= logo_lockup('dark') ?>             mark + wordmark
 */

if (!function_exists('logo_mark')) {

    function logo_mark(string $class = 'h-11 w-11'): string
    {
        // One figure, drawn facing right; the second is mirrored via transform.
        $figure = '<path d="M16 112 C42 90 86 90 106 104 C100 190 88 258 76 312 C72 322 60 322 56 312 C40 250 26 180 16 112 Z"/>';
        $head   = '<circle cx="61" cy="54" r="31"/>';
        $rayA   = '<path d="M26 150 C18 198 9 242 1 282 L19 289 C28 244 37 200 46 158 Z"/>';
        $rayB   = '<path d="M50 176 C44 220 37 256 30 292 L47 298 C55 258 63 220 70 182 Z"/>';

        return <<<SVG
<svg class="{$class}" viewBox="0 0 320 340" fill="none" aria-hidden="true">
  <g class="logo-left">
    <g fill="var(--logo-teal-pale, #7DCCE0)" opacity=".85">{$rayA}</g>
    <g fill="var(--logo-teal-mid,  #2AA5C7)">{$rayB}</g>
    <g fill="var(--logo-teal,      #1C7C9C)">{$head}{$figure}</g>
  </g>
  <g class="logo-right" transform="translate(320,0) scale(-1,1)">
    <g fill="var(--logo-ember-pale, #F9C06B)" opacity=".85">{$rayA}</g>
    <g fill="var(--logo-ember-mid,  #F5A03F)">{$rayB}</g>
    <g fill="var(--logo-ember,      #F47B20)">{$head}{$figure}</g>
  </g>
</svg>
SVG;
    }
}

if (!function_exists('logo_lockup')) {

    function logo_lockup(string $tone = 'dark', string $markClass = 'h-11 w-11'): string
    {
        $isLight = $tone === 'light';

        $hathany = $isLight ? 'text-white'      : 'text-ember-500';
        $cosmos  = $isLight ? 'text-white'      : 'text-teal-600';
        $found   = $isLight ? 'text-white/60'   : 'text-ink-muted';
        $rule    = $isLight ? 'bg-white/25'     : 'bg-ink-line';

        // On dark backgrounds the pale rays lose contrast, so lift them.
        $vars = $isLight
            ? 'style="--logo-teal:#7DCCE0;--logo-teal-mid:#AEE1EF;--logo-teal-pale:#D5EFF7;--logo-ember:#F9C06B;--logo-ember-mid:#FDD2A8;--logo-ember-pale:#FFEAD4"'
            : '';

        $mark = logo_mark($markClass);

        return <<<HTML
<span class="flex items-center gap-3" {$vars}>
  {$mark}
  <span class="flex flex-col leading-none">
    <span class="font-display text-[1.0625rem] font-extrabold uppercase tracking-[-0.01em]">
      <span class="{$hathany}">Hathany</span>&nbsp;<span class="{$cosmos}">Cosmos</span>
    </span>
    <span class="mt-1 flex items-center gap-2">
      <span class="h-px w-4 {$rule}"></span>
      <span class="font-script text-sm {$found}">Foundation</span>
      <span class="h-px flex-1 {$rule}"></span>
    </span>
  </span>
</span>
HTML;
    }
}
