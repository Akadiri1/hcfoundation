<?php
/**
 * Shown when maintenance mode is on. Deliberately standalone: it must render
 * without the header, since the header is what routes here.
 */
http_response_code(503);
header('Retry-After: 3600');

require_once APP_PATH . "/views/includes/partials/icon.php";
require_once APP_PATH . "/views/includes/partials/logo.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>We will be back shortly | <?= htmlspecialchars($site_name ?? 'HC Foundation') ?></title>
<link rel="icon" href="/assets/images/favicon.png" type="image/png">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/app.css">
</head>
<body class="min-h-screen">

<main class="relative flex min-h-screen items-center overflow-hidden bg-teal-950">
  <div class="absolute inset-0 fan-glow-deep"></div>
  <div class="pointer-events-none absolute -right-24 -top-24 h-96 w-96 rounded-full bg-ember-500/20 blur-3xl animate-float-slow"></div>
  <div class="pointer-events-none absolute -bottom-32 -left-20 h-96 w-96 rounded-full bg-teal-400/20 blur-3xl"></div>

  <div class="container relative py-12 text-center">
    <div class="mx-auto flex max-w-lg flex-col items-center">

      <?= logo_lockup('light', 'h-20 w-auto') ?>

      <div class="relative mt-10">
        <span class="absolute inset-0 animate-pulse-ring rounded-full bg-white/20"></span>
        <span class="relative grid h-20 w-20 place-items-center rounded-full bg-white/10 text-white backdrop-blur-sm">
          <?= icon('growth', 'h-9 w-9') ?>
        </span>
      </div>

      <h1 class="mt-10 text-display-md text-white">We will be back shortly</h1>

      <p class="mt-5 text-lg leading-relaxed text-white/70">
        The site is briefly down for maintenance. The work continues in the meantime.
        Thank you for your patience.
      </p>

      <?php if (!empty($site_email)): ?>
        <a href="mailto:<?= htmlspecialchars($site_email) ?>" class="btn-ghost-light mt-10">
          <?= icon('mail', 'h-4 w-4') ?> <?= htmlspecialchars($site_email) ?>
        </a>
      <?php endif; ?>

    </div>
  </div>
</main>

</body>
</html>
