<?php
/**
 * Interior page hero.
 *
 * Either name the settings row that holds the hero copy:
 *   $hero_section = 'settings_about_hero';
 *   (input_eyebrow, input_title, input_title_highlight, text_intro)
 *
 * or set the pieces directly (detail pages, whose hero comes from the record):
 *   $hero_eyebrow, $hero_title (HTML), $hero_text, $hero_crumb,
 *   $hero_admc       admc_edit(...) for the eyebrow and title
 *   $hero_text_admc  admc_edit(...) for the intro, when it lives elsewhere
 *
 * Anything set directly wins over the section, so a page can take its title
 * from the section but its intro from another row.
 *
 * The breadcrumb's current page reads $hero_crumb; pages pass the matching
 * settings_navigation label so renaming a menu item renames the crumb too.
 */
if (!empty($hero_section)) {
    $hs = admc_section($hero_section);
    $hero_admc    = $hero_admc ?? admc_edit($hero_section, $hs['id']);
    $hero_eyebrow = $hero_eyebrow ?? ($hs['input_eyebrow'] ?? '');
    $hero_title   = $hero_title ?? (
        admc_plain($hs['input_title'] ?? '')
        . (($hs['input_title_highlight'] ?? '') !== '' ? ' <span class="text-gradient">' . admc_plain($hs['input_title_highlight']) . '</span>' : '')
    );
    if (!isset($hero_text) && array_key_exists('text_intro', $hs)) {
        $hero_text      = $hs['text_intro'];
        $hero_text_admc = $hero_text_admc ?? $hero_admc;
    }
}

$hero_eyebrow   = $hero_eyebrow   ?? '';
$hero_title     = $hero_title     ?? htmlspecialchars($page_title ?? '');
$hero_text      = $hero_text      ?? '';
$hero_crumb     = $hero_crumb     ?? ($page_title ?? '');
$hero_admc      = $hero_admc      ?? '';
$hero_text_admc = $hero_text_admc ?? '';
?>
<section class="relative overflow-hidden bg-ink-wash pt-[var(--header-h)]">
  <div class="absolute inset-0 fan-glow"></div>
  <div class="pointer-events-none absolute -right-20 top-10 h-72 w-72 rounded-full bg-ember-400/15 blur-3xl animate-float-slow"></div>
  <div class="pointer-events-none absolute -left-24 bottom-0 h-72 w-72 rounded-full bg-teal-400/15 blur-3xl"></div>

  <div class="container relative py-10 md:py-12">
    <nav class="flex items-center gap-2 text-sm text-ink-muted reveal" aria-label="Breadcrumb" <?= $navEdit ?? '' ?>>
      <a href="/home" class="transition-colors hover:text-teal-700"><?= htmlspecialchars($navLabels['input_home'] ?? 'Home') ?></a>
      <span class="text-ink-line">/</span>
      <span class="font-medium text-ink" <?= $hero_crumb_admc ?? '' ?>><?= htmlspecialchars($hero_crumb) ?></span>
    </nav>

    <div class="mt-7 max-w-3xl">
      <?php if ($hero_eyebrow): ?>
        <span class="eyebrow reveal" style="--reveal-delay:60ms" <?= $hero_admc ?>><?= htmlspecialchars($hero_eyebrow) ?></span>
      <?php endif; ?>

      <h1 class="mt-5 text-display-lg reveal" style="--reveal-delay:120ms" <?= $hero_admc ?>>
        <?= $hero_title ?>
      </h1>

      <?php if ($hero_text): ?>
        <p class="mt-6 max-w-2xl text-lg leading-relaxed text-ink-soft reveal" style="--reveal-delay:200ms" <?= $hero_text_admc ?>>
          <?= admc_plain($hero_text) ?>
        </p>
      <?php endif; ?>
    </div>
  </div>
</section>
