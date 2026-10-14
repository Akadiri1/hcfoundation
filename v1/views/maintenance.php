<?php
/**
 * Hathany Cosmos Foundation — Coming Soon Page
 *
 * Designed in the website's exact brand style (light clean canvas, Figtree
 * typography, brand logo lockup, teal & ember accents, and card components).
 *
 * This is the ONLY page displayed while COMING_SOON=true.
 */

$isMaintenance = getenv('MAINTENANCE_MODE') === 'true';
if ($isMaintenance) {
    http_response_code(503);
    header('Retry-After: 3600');
}

require_once APP_PATH . "/views/includes/partials/asset.php";
require_once APP_PATH . "/views/includes/partials/icon.php";
require_once APP_PATH . "/views/includes/partials/logo.php";

$site_name    = $site_name ?? 'Hathany Cosmos Foundation';
$site_tagline = $site_tagline ?? 'Restoring Hope. Transforming Lives.';
$site_promise = $site_promise ?? 'HC Foundation exists to stand with communities where support is scarce — turning compassion into practical, lasting change.';
$site_email   = $site_email ?? 'contact@hcfoundations.com';
$site_phone   = $site_phone ?? '+1 770-727-6969';
$site_address = $site_address ?? '';

$socialLinks  = $socialLinks ?? [
    ['name' => 'Facebook', 'url' => 'https://web.facebook.com/hathanyCosmosFoundation', 'icon' => 'facebook'],
];
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Coming Soon — <?= htmlspecialchars($site_name) ?></title>

<meta name="description" content="<?= htmlspecialchars($site_tagline . ' — ' . $site_promise) ?>">
<meta name="theme-color" content="#1C7C9C">

<meta property="og:type" content="website">
<meta property="og:site_name" content="<?= htmlspecialchars($site_name) ?>">
<meta property="og:title" content="Coming Soon — <?= htmlspecialchars($site_name) ?>">
<meta property="og:description" content="<?= htmlspecialchars($site_promise) ?>">

<link rel="icon" href="/assets/images/favicon.png" type="image/png">
<link rel="apple-touch-icon" href="/assets/images/apple-touch-icon.png">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;500;600;700&display=swap" rel="stylesheet">

<script>document.documentElement.classList.add('js');</script>
<link rel="stylesheet" href="/assets/css/app.css?v=<?= asset_version('/assets/css/app.css') ?>">
</head>

<body class="min-h-screen bg-white font-sans text-ink antialiased selection:bg-teal-600 selection:text-white">

<div class="relative flex min-h-screen flex-col justify-between overflow-hidden">

  <!-- Ambient brand fan glow -->
  <div class="absolute inset-0 fan-glow pointer-events-none"></div>
  <div class="pointer-events-none absolute -left-12 -top-12 h-64 w-64 rounded-full bg-teal-300/20 blur-3xl animate-float-slow"></div>
  <div class="pointer-events-none absolute -bottom-16 -right-16 h-80 w-80 rounded-full bg-ember-400/20 blur-3xl"></div>

  <!-- Top bar -->
  <header class="relative z-10">
    <div class="container py-8 sm:py-10 flex items-center justify-between">
      <a href="/" class="transition-transform duration-300 hover:scale-[1.02]">
        <?= logo_lockup('dark', 'h-14 sm:h-16 md:h-20 w-auto') ?>
      </a>

      <div class="inline-flex items-center gap-2 rounded-full border border-teal-200 bg-teal-50 px-4 py-1.5 text-xs font-semibold uppercase tracking-wider text-teal-800 shadow-sm">
        <span class="relative flex h-2 w-2">
          <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-teal-400 opacity-75"></span>
          <span class="relative inline-flex h-2 w-2 rounded-full bg-teal-600"></span>
        </span>
        Coming Soon
      </div>
    </div>
  </header>

  <!-- Main center stage -->
  <main class="relative z-10 flex-1 flex items-center py-10 sm:py-14">
    <div class="container">
      <div class="mx-auto flex max-w-3xl flex-col items-center text-center">

        <span class="eyebrow">Humanitarian Foundation</span>

        <h1 class="mt-5 font-display text-display-lg md:text-display-xl font-bold leading-tight tracking-tight text-ink">
          <span class="block">Restoring Hope.</span>
          <span class="block text-gradient">Transforming Lives.</span>
        </h1>

        <p class="mx-auto mt-6 max-w-xl text-lg md:text-xl leading-relaxed text-ink-soft">
          Our official website is currently on the way. HC Foundation stands with communities
          where support is scarce — turning compassion into practical, lasting change.
        </p>

        <!-- Direct Contact Cards -->
        <div class="mt-10 w-full max-w-2xl">
          <div class="grid gap-4 sm:grid-cols-2 text-left">
            
            <!-- Email Card -->
            <a href="mailto:<?= htmlspecialchars($site_email) ?>"
               class="card-hover card-rule flex items-start gap-4 p-5">
              <span class="icon-tile bg-teal-50 text-teal-600 shrink-0">
                <?= icon('mail', 'h-6 w-6') ?>
              </span>
              <div class="min-w-0 flex-1">
                <p class="text-xs font-semibold uppercase tracking-wider text-ink-muted">Email Us</p>
                <p class="mt-1 font-semibold text-ink transition-colors hover:text-teal-700 break-all text-sm sm:text-base">
                  <?= htmlspecialchars($site_email) ?>
                </p>
              </div>
            </a>

            <!-- Phone Card -->
            <a href="tel:<?= preg_replace('/\s+/', '', $site_phone) ?>"
               class="card-hover card-rule flex items-start gap-4 p-5">
              <span class="icon-tile bg-ember-50 text-ember-500 shrink-0">
                <?= icon('phone', 'h-6 w-6') ?>
              </span>
              <div class="min-w-0 flex-1">
                <p class="text-xs font-semibold uppercase tracking-wider text-ink-muted">Call Us</p>
                <p class="mt-1 font-semibold text-ink transition-colors hover:text-ember-500 text-sm sm:text-base">
                  <?= htmlspecialchars($site_phone) ?>
                </p>
              </div>
            </a>

          </div>

          <!-- Operational Status Strip -->
          <div class="mt-4 flex items-center justify-center gap-2 rounded-2xl border border-ink-line bg-ink-wash px-5 py-3.5 text-xs text-ink-muted">
            <span class="h-2 w-2 rounded-full bg-ember-500 animate-pulse"></span>
            <span>Outreach &amp; relief operations active — feel free to reach out</span>
          </div>
        </div>

        <!-- Social Media Link -->
        <div class="mt-9 flex flex-wrap justify-center items-center gap-3">
          <span class="text-xs font-semibold uppercase tracking-wider text-ink-muted">Connect with us:</span>
          <?php foreach ($socialLinks as $s): ?>
            <a href="<?= $s['url'] ?>" target="_blank" rel="noopener noreferrer"
               aria-label="<?= htmlspecialchars($s['name']) ?>" title="<?= htmlspecialchars($s['name']) ?>"
               class="flex items-center gap-2 rounded-full border border-ink-line bg-white px-5 py-2.5 text-xs font-semibold text-ink transition-all duration-300 hover:-translate-y-0.5 hover:border-teal-600 hover:text-teal-700 hover:shadow-card">
              <?= social_icon($s['icon'], 'h-4 w-4 text-teal-700') ?>
              <span>Follow on <?= htmlspecialchars($s['name']) ?></span>
            </a>
          <?php endforeach; ?>
        </div>

      </div>
    </div>
  </main>

  <!-- Clean Minimal Footer -->
  <footer class="relative z-10 border-t border-ink-line py-6 text-center text-xs text-ink-muted">
    <div class="container">
      <p>&copy; <?= date('Y') ?> <?= htmlspecialchars($site_name) ?>. All rights reserved.</p>
    </div>
  </footer>

</div>

</body>
</html>
