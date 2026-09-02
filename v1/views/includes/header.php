<?php
/**
 * Site head + masthead.
 *
 * Pages set $page_title and optionally $page_meta before including this.
 */

if (!empty($maintenance_status) && empty($_SESSION['active'])) {
    include APP_PATH . "/views/maintenance.php";
    exit;
}

require_once APP_PATH . "/views/includes/partials/icon.php";
require_once APP_PATH . "/views/includes/partials/logo.php";

$page_title    = $page_title ?? '';
$webpage_title = $page_title ? "{$page_title} — {$site_name}" : "{$site_name} — {$site_tagline}";
$metaTitle     = $webpage_title;
$metaDescription = $page_meta ?? $metaDescription;

$path = strtok(strtok($_SERVER['REQUEST_URI'], "?"), "#");
$path = rtrim($path, '/');

/**
 * Navigation.
 *
 * Eight flat items need roughly 1150px before they collide with the logo and
 * the button, which would push the full nav out to very wide screens only.
 * Grouping two pairs under dropdowns brings it to six, so the bar fits from
 * 1024px up. Add a 'children' key to any item to turn it into a dropdown.
 */
$nav = [
    ['label' => 'Home', 'href' => '/home', 'match' => ['', '/home']],

    ['label' => 'About', 'href' => '/about-us', 'match' => ['/about-us', '/team'], 'children' => [
        ['label' => 'About Us', 'href' => '/about-us', 'icon' => 'quote', 'desc' => 'Who we are and what drives us'],
        ['label' => 'Our Team', 'href' => '/team',     'icon' => 'users', 'desc' => 'The people behind the work'],
    ]],

    ['label' => 'Initiatives', 'href' => '/initiatives', 'match' => ['/initiatives', '/view-initiative']],

    ['label' => 'Volunteer', 'href' => '/volunteer', 'match' => ['/volunteer']],

    ['label' => 'Media', 'href' => '/gallery', 'match' => ['/gallery', '/blog', '/read-blog'], 'children' => [
        ['label' => 'Gallery', 'href' => '/gallery', 'icon' => 'camera', 'desc' => 'Moments from the field'],
        ['label' => 'Blog',    'href' => '/blog',    'icon' => 'book',   'desc' => 'Stories and updates'],
    ]],

    ['label' => 'Contact', 'href' => '/contact-us', 'match' => ['/contact-us']],
];

$is_active = function (array $item) use ($path): bool {
    foreach ($item['match'] ?? [] as $m) {
        if ($path === $m || ($m !== '' && str_starts_with($path, $m . '/'))) {
            return true;
        }
    }
    return false;
};

$child_active = function (array $child) use ($path): bool {
    return $path === rtrim($child['href'], '/');
};
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= htmlspecialchars($webpage_title) ?></title>

<meta name="description" content="<?= htmlspecialchars($metaDescription) ?>">
<meta name="keywords" content="<?= htmlspecialchars(implode(', ', $siteKeywords)) ?>">
<meta name="theme-color" content="#1C7C9C">

<meta property="og:type" content="website">
<meta property="og:site_name" content="<?= htmlspecialchars($site_name) ?>">
<meta property="og:title" content="<?= htmlspecialchars($metaTitle) ?>">
<meta property="og:description" content="<?= htmlspecialchars($metaDescription) ?>">
<meta name="twitter:card" content="summary_large_image">

<link rel="icon" href="/assets/images/favicon.svg" type="image/svg+xml">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Inter:wght@400;500;600&family=Caveat:wght@600&display=swap" rel="stylesheet">

<script>document.documentElement.classList.add('js');</script>
<link rel="stylesheet" href="/assets/css/app.css">
</head>

<body class="min-h-screen bg-white">

<a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:left-5 focus:top-5 focus:z-[100] focus:rounded-full focus:bg-teal-600 focus:px-5 focus:py-3 focus:text-sm focus:font-semibold focus:text-white">
  Skip to content
</a>

<!-- ===== Masthead ===================================================== -->
<header id="masthead"
        class="fixed inset-x-0 top-0 z-50 transition-all duration-500 ease-out-expo"
        data-header>
  <div class="border-b border-transparent transition-all duration-500 ease-out-expo" data-header-shell>
    <div class="container">
      <div class="flex h-[var(--header-h)] items-center justify-between gap-4 xl:gap-6">

        <a href="/home" class="shrink-0 transition-transform duration-500 ease-out-expo hover:scale-[1.02]"
           aria-label="<?= htmlspecialchars($site_name) ?> — home">
          <?= logo_lockup('dark') ?>
        </a>

        <!-- Desktop nav: 1024px and up -->
        <nav class="hidden items-center gap-5 lg:flex xl:gap-8" aria-label="Primary">
          <?php foreach ($nav as $item):
            $active   = $is_active($item);
            $children = $item['children'] ?? null;
          ?>

            <?php if (!$children): ?>
              <a href="<?= $item['href'] ?>"
                 class="nav-link<?= $active ? ' is-active' : '' ?>"
                 <?= $active ? 'aria-current="page"' : '' ?>><?= $item['label'] ?></a>

            <?php else: ?>
              <div class="group relative" data-dropdown>
                <button type="button"
                        class="nav-link flex items-center gap-1.5<?= $active ? ' is-active' : '' ?>"
                        aria-expanded="false" aria-haspopup="true" data-dropdown-trigger>
                  <?= $item['label'] ?>
                  <?= icon('chevron', 'h-3.5 w-3.5 transition-transform duration-300 group-hover:rotate-180 group-focus-within:rotate-180') ?>
                </button>

                <div class="invisible absolute left-1/2 top-full z-50 w-[17rem] -translate-x-1/2 translate-y-2 pt-4 opacity-0 transition-all duration-300 ease-out-expo group-hover:visible group-hover:translate-y-0 group-hover:opacity-100 group-focus-within:visible group-focus-within:translate-y-0 group-focus-within:opacity-100"
                     data-dropdown-panel>
                  <div class="overflow-hidden rounded-2xl border border-ink-line bg-white p-2 shadow-lift">
                    <?php foreach ($children as $child): $ca = $child_active($child); ?>
                      <a href="<?= $child['href'] ?>"
                         class="group/item flex items-start gap-3 rounded-xl p-3 transition-colors duration-300 <?= $ca ? 'bg-teal-50' : 'hover:bg-ink-wash' ?>">
                        <span class="mt-0.5 grid h-9 w-9 shrink-0 place-items-center rounded-lg <?= $ca ? 'bg-teal-600 text-white' : 'bg-ink-wash text-teal-600 group-hover/item:bg-teal-600 group-hover/item:text-white' ?> transition-colors duration-300">
                          <?= icon($child['icon'], 'h-4 w-4') ?>
                        </span>
                        <span class="min-w-0">
                          <span class="block text-[0.9375rem] font-semibold <?= $ca ? 'text-teal-700' : 'text-ink' ?>">
                            <?= $child['label'] ?>
                          </span>
                          <span class="mt-0.5 block text-xs leading-snug text-ink-muted"><?= $child['desc'] ?></span>
                        </span>
                      </a>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
            <?php endif; ?>

          <?php endforeach; ?>
        </nav>

        <div class="flex items-center gap-3">
          <!-- Reserved slot: a Donate button drops in here without touching layout. -->
          <a href="/volunteer" class="btn-primary hidden px-5 sm:inline-flex xl:px-7">
            Get Involved <?= icon('arrow', 'h-4 w-4') ?>
          </a>

          <!-- Drawer trigger: below 1024px only -->
          <button type="button"
                  class="grid h-11 w-11 place-items-center rounded-full border border-ink-line text-ink transition-colors duration-300 hover:border-teal-600 hover:text-teal-700 lg:hidden"
                  data-menu-open aria-label="Open menu" aria-expanded="false" aria-controls="mobile-nav">
            <?= icon('menu', 'h-5 w-5') ?>
          </button>
        </div>

      </div>
    </div>
  </div>
</header>

<!-- ===== Mobile drawer (below 1024px) ================================= -->
<div id="mobile-nav" class="fixed inset-0 z-[60] hidden lg:hidden" data-menu-panel>
  <div class="absolute inset-0 bg-ink/45 opacity-0 backdrop-blur-sm transition-opacity duration-400"
       data-menu-scrim></div>

  <div class="absolute inset-y-0 right-0 flex w-full max-w-sm translate-x-full flex-col bg-white shadow-lift transition-transform duration-500 ease-out-expo"
       data-menu-sheet role="dialog" aria-modal="true" aria-label="Menu">

    <div class="flex h-[var(--header-h)] shrink-0 items-center justify-between border-b border-ink-line px-6">
      <?= logo_lockup('dark', 'h-9 w-9') ?>
      <button type="button"
              class="grid h-10 w-10 place-items-center rounded-full border border-ink-line text-ink transition-colors hover:border-teal-600 hover:text-teal-700"
              data-menu-close aria-label="Close menu">
        <?= icon('close', 'h-5 w-5') ?>
      </button>
    </div>

    <nav class="flex-1 overflow-y-auto px-6 py-8" aria-label="Mobile">
      <ul class="space-y-1">
        <?php foreach ($nav as $item):
          $active   = $is_active($item);
          $children = $item['children'] ?? null;
        ?>
          <li>
            <?php if (!$children): ?>
              <a href="<?= $item['href'] ?>"
                 class="group flex items-center justify-between rounded-2xl px-4 py-3.5 font-display text-lg font-semibold transition-colors duration-300 <?= $active ? 'bg-teal-50 text-teal-700' : 'text-ink hover:bg-ink-wash' ?>">
                <?= $item['label'] ?>
                <span class="text-ink-muted transition-transform duration-300 group-hover:translate-x-1">
                  <?= icon('arrow', 'h-4 w-4') ?>
                </span>
              </a>

            <?php else: ?>
              <div data-sub<?= $active ? ' class="is-open"' : '' ?>>
                <button type="button" data-sub-trigger aria-expanded="<?= $active ? 'true' : 'false' ?>"
                        class="group flex w-full items-center justify-between rounded-2xl px-4 py-3.5 text-left font-display text-lg font-semibold transition-colors duration-300 <?= $active ? 'bg-teal-50 text-teal-700' : 'text-ink hover:bg-ink-wash' ?>">
                  <?= $item['label'] ?>
                  <span class="text-ink-muted transition-transform duration-400 group-aria-expanded:rotate-180">
                    <?= icon('chevron', 'h-4 w-4') ?>
                  </span>
                </button>

                <div data-sub-panel
                     class="overflow-hidden transition-[max-height] duration-500 ease-out-expo"
                     style="max-height:<?= $active ? '20rem' : '0' ?>">
                  <ul class="space-y-1 py-1 pl-4">
                    <?php foreach ($children as $child): $ca = $child_active($child); ?>
                      <li>
                        <a href="<?= $child['href'] ?>"
                           class="group flex items-center gap-3 rounded-xl px-4 py-3 text-[0.9375rem] font-medium transition-colors duration-300 <?= $ca ? 'bg-teal-50 text-teal-700' : 'text-ink-soft hover:bg-ink-wash hover:text-ink' ?>">
                          <span class="grid h-8 w-8 shrink-0 place-items-center rounded-lg <?= $ca ? 'bg-teal-600 text-white' : 'bg-ink-wash text-teal-600' ?>">
                            <?= icon($child['icon'], 'h-4 w-4') ?>
                          </span>
                          <?= $child['label'] ?>
                        </a>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              </div>
            <?php endif; ?>
          </li>
        <?php endforeach; ?>
      </ul>

      <a href="/volunteer" class="btn-primary mt-8 w-full">
        Get Involved <?= icon('arrow', 'h-4 w-4') ?>
      </a>

      <div class="mt-10 space-y-4 border-t border-ink-line pt-8 text-sm text-ink-soft">
        <a href="mailto:<?= htmlspecialchars($site_email) ?>" class="flex items-center gap-3 hover:text-teal-700">
          <?= icon('mail', 'h-4 w-4 text-teal-600') ?><?= htmlspecialchars($site_email) ?>
        </a>
        <a href="tel:<?= preg_replace('/\s+/', '', $site_phone) ?>" class="flex items-center gap-3 hover:text-teal-700">
          <?= icon('phone', 'h-4 w-4 text-teal-600') ?><?= htmlspecialchars($site_phone) ?>
        </a>
      </div>

      <div class="mt-8 flex gap-2.5">
        <?php foreach ($socialLinks as $s): ?>
          <a href="<?= $s['url'] ?>" aria-label="<?= $s['name'] ?>"
             class="grid h-10 w-10 place-items-center rounded-full border border-ink-line text-ink-soft transition-all duration-300 hover:border-teal-600 hover:bg-teal-600 hover:text-white">
            <?= social_icon($s['icon']) ?>
          </a>
        <?php endforeach; ?>
      </div>
    </nav>
  </div>
</div>

<main id="main">
