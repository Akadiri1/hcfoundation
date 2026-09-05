<?php
http_response_code(404);
$page_title = 'Page not found';
$page_meta  = "The page you are looking for could not be found.";
include APP_PATH . "/views/includes/header.php";
?>

<section class="relative flex min-h-[80vh] items-center overflow-hidden bg-white pt-[var(--header-h)]">
  <div class="absolute inset-0 fan-glow"></div>
  <div class="pointer-events-none absolute -right-20 top-24 h-80 w-80 rounded-full bg-ember-400/15 blur-3xl animate-float-slow"></div>
  <div class="pointer-events-none absolute -left-24 bottom-10 h-80 w-80 rounded-full bg-teal-400/15 blur-3xl"></div>

  <div class="container relative py-12 text-center">
    <p class="font-display text-[clamp(6rem,20vw,14rem)] font-bold leading-none reveal">
      <span class="text-gradient">404</span>
    </p>

    <h1 class="mt-2 text-display-md reveal" style="--reveal-delay:100ms">
      This page could not be found
    </h1>

    <p class="mx-auto mt-5 max-w-md text-lg leading-relaxed text-ink-soft reveal" style="--reveal-delay:180ms">
      The link may be out of date, or the page may have moved. These will get you
      back on track.
    </p>

    <div class="mt-10 flex flex-wrap justify-center gap-4 reveal" style="--reveal-delay:260ms">
      <a href="/home" class="btn-primary btn-lg">Back to home <?= icon('arrow', 'h-4 w-4') ?></a>
      <a href="/contact-us" class="btn-outline btn-lg">Contact us</a>
    </div>

    <div class="mx-auto mt-10 grid max-w-3xl gap-4 sm:grid-cols-3 reveal" style="--reveal-delay:340ms">
      <?php foreach ([
        ['Initiatives', '/initiatives', 'growth'],
        ['Volunteer',   '/volunteer',   'hands'],
        ['Blog',        '/blog',        'book'],
      ] as $i => [$label, $href, $ic]): ?>
        <a href="<?= $href ?>" class="card-hover card-rule group flex items-center gap-4 text-left">
          <span class="icon-tile h-11 w-11 <?= $i === 1 ? 'bg-ember-50 text-ember-500' : 'bg-teal-50 text-teal-600' ?>">
            <?= icon($ic, 'h-5 w-5') ?>
          </span>
          <span class="flex-1 font-display font-semibold text-ink"><?= $label ?></span>
          <span class="text-ink-muted transition-transform duration-300 group-hover:translate-x-1">
            <?= icon('arrow', 'h-4 w-4') ?>
          </span>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php include APP_PATH . "/views/includes/footer.php"; ?>
