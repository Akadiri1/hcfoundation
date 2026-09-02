<?php
/**
 * Interior page hero.
 *
 * Set before including:
 *   $hero_eyebrow, $hero_title, $hero_text (optional), $hero_crumb (optional)
 */
$hero_eyebrow = $hero_eyebrow ?? '';
$hero_title   = $hero_title   ?? ($page_title ?? '');
$hero_text    = $hero_text    ?? '';
$hero_crumb   = $hero_crumb   ?? ($page_title ?? '');
?>
<section class="relative overflow-hidden bg-ink-wash pt-[var(--header-h)]">
  <div class="absolute inset-0 fan-glow"></div>
  <div class="absolute inset-0 grid-lines opacity-60 mask-fade-b"></div>
  <div class="pointer-events-none absolute -right-20 top-10 h-72 w-72 rounded-full bg-ember-400/15 blur-3xl animate-float-slow"></div>
  <div class="pointer-events-none absolute -left-24 bottom-0 h-72 w-72 rounded-full bg-teal-400/15 blur-3xl"></div>

  <div class="container relative py-16 md:py-24">
    <nav class="flex items-center gap-2 text-sm text-ink-muted reveal" aria-label="Breadcrumb">
      <a href="/home" class="transition-colors hover:text-teal-700">Home</a>
      <span class="text-ink-line">/</span>
      <span class="font-medium text-ink"><?= htmlspecialchars($hero_crumb) ?></span>
    </nav>

    <div class="mt-7 max-w-3xl">
      <?php if ($hero_eyebrow): ?>
        <span class="eyebrow reveal" style="--reveal-delay:60ms"><?= htmlspecialchars($hero_eyebrow) ?></span>
      <?php endif; ?>

      <h1 class="mt-5 text-display-lg reveal" style="--reveal-delay:120ms">
        <?= $hero_title ?>
      </h1>

      <?php if ($hero_text): ?>
        <p class="mt-6 max-w-2xl text-lg leading-relaxed text-ink-soft reveal" style="--reveal-delay:200ms">
          <?= htmlspecialchars($hero_text) ?>
        </p>
      <?php endif; ?>
    </div>
  </div>
</section>
