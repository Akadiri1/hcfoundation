<?php
$page_title = 'About Us';
$page_meta  = "HC Foundation is a humanitarian-focused organization committed to improving lives through service, compassion, and action.";
include APP_PATH . "/views/includes/header.php";

$hero_section = 'settings_about_hero';
$hero_crumb   = $navLabels['input_about_us'];
include APP_PATH . "/views/includes/partials/page-hero.php";

$story    = admc_section('settings_about_story');
$values   = admc_section('settings_about_values');
$approach = admc_section('settings_about_approach');

$storyEdit = admc_edit('settings_about_story', $story['id']);
$siteEdit  = admc_edit('settings_website_info', $site_id);
?>

<!-- ===== Story ======================================================== -->
<section class="section bg-white">
  <div class="container">
    <div class="grid items-start gap-12 lg:grid-cols-12">

      <div class="lg:col-span-5">
        <div class="lg:sticky lg:top-32">
          <div class="reveal reveal-left media aspect-[4/5] rounded-[2.5rem] shadow-lift media-zoom" <?= admc_image('settings_about_story', $story['id']) ?>>
            <img src="<?= htmlspecialchars(admc_src($story)) ?>" alt="Working with the community"
                 loading="lazy" decoding="async">
          </div>
          <div class="reveal mt-6 rounded-3xl border border-ink-line bg-ink-wash p-7" style="--reveal-delay:180ms" <?= $storyEdit ?>>
            <span class="text-ember-500"><?= icon('quote', 'h-7 w-7') ?></span>
            <p class="mt-4 font-display text-lg font-medium leading-relaxed text-ink">
              <?= admc_plain($story['text_quote']) ?>
            </p>
          </div>
        </div>
      </div>

      <div class="lg:col-span-6 lg:col-start-7">
        <span class="eyebrow reveal" <?= $storyEdit ?>><?= htmlspecialchars($story['input_eyebrow']) ?></span>
        <h2 class="mt-6 text-display-md reveal" style="--reveal-delay:80ms" <?= $storyEdit ?>>
          <?= admc_lines($story['input_heading']) ?>
        </h2>

        <div class="prose-brand mt-7 reveal" style="--reveal-delay:160ms">
          <p <?= $siteEdit ?>><?= admc_plain($about_who) ?></p>
          <p <?= $siteEdit ?>><?= admc_plain($about_approach) ?></p>
          <p <?= $storyEdit ?>><?= admc_plain($story['text_extra']) ?></p>
        </div>

        <!-- Vision / Mission -->
        <div class="mt-10 grid gap-5 sm:grid-cols-2">
          <div class="reveal relative overflow-hidden rounded-3xl bg-teal-grad p-8 text-white shadow-glow" style="--reveal-delay:240ms">
            <span class="pointer-events-none absolute -right-8 -top-8 h-32 w-32 rounded-full bg-white/10"></span>
            <span class="relative grid h-12 w-12 place-items-center rounded-2xl bg-white/15">
              <?= icon('star', 'h-6 w-6') ?>
            </span>
            <h3 class="relative mt-5 font-display text-xl font-bold" <?= $storyEdit ?>><?= htmlspecialchars($story['input_vision_title']) ?></h3>
            <p class="relative mt-3 leading-relaxed text-white/80" <?= $siteEdit ?>><?= admc_plain($vision) ?></p>
          </div>

          <div class="reveal relative overflow-hidden rounded-3xl bg-ember-grad p-8 text-white shadow-ember" style="--reveal-delay:320ms">
            <span class="pointer-events-none absolute -right-8 -top-8 h-32 w-32 rounded-full bg-white/10"></span>
            <span class="relative grid h-12 w-12 place-items-center rounded-2xl bg-white/15">
              <?= icon('growth', 'h-6 w-6') ?>
            </span>
            <h3 class="relative mt-5 font-display text-xl font-bold" <?= $storyEdit ?>><?= htmlspecialchars($story['input_mission_title']) ?></h3>
            <p class="relative mt-3 leading-relaxed text-white/85" <?= $siteEdit ?>><?= admc_plain($mission) ?></p>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ===== Core values ================================================== -->
<section class="section bg-ink-wash">
  <div class="container">

    <div class="mx-auto max-w-2xl text-center" <?= admc_edit('settings_about_values', $values['id']) ?>>
      <span class="eyebrow reveal"><?= htmlspecialchars($values['input_eyebrow']) ?></span>
      <h2 class="mt-6 text-display-lg reveal" style="--reveal-delay:80ms">
        <?= admc_lines($values['input_heading']) ?>
      </h2>
    </div>

    <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-5" <?= admc_list('panel_core_values') ?>>
      <?php foreach ($core_values as $i => $v): ?>
        <div class="card-hover card-rule reveal text-center" style="--reveal-delay:<?= $i * 80 ?>ms" <?= admc_edit('panel_core_values', $v['id'] ?? null) ?>>
          <span class="icon-tile mx-auto <?= $i % 2 ? 'bg-ember-50 text-ember-500' : 'bg-teal-50 text-teal-600' ?>">
            <?= icon($v['icon'], 'h-7 w-7') ?>
          </span>
          <h3 class="mt-5 font-display text-lg font-semibold text-ink"><?= htmlspecialchars($v['title']) ?></h3>
          <p class="mt-2.5 text-sm leading-relaxed text-ink-soft"><?= admc_plain($v['body']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<!-- ===== Impact band ================================================== -->
<section class="relative overflow-hidden bg-teal-950 py-10 md:py-12">
  <div class="absolute inset-0 fan-glow-deep"></div>
  <div class="container relative">
    <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4" <?= admc_list('panel_impact_stats') ?>>
      <?php foreach ($impact_stats as $i => $stat): ?>
        <div class="reveal text-center" style="--reveal-delay:<?= $i * 90 ?>ms" <?= admc_edit('panel_impact_stats', $stat['id'] ?? null) ?>>
          <p class="font-display text-[3rem] font-bold leading-none text-white">
            <span data-count="<?= $stat['value'] ?>">0</span><span class="text-ember-400"><?= htmlspecialchars($stat['suffix']) ?></span>
          </p>
          <p class="mt-3 font-semibold text-white"><?= htmlspecialchars($stat['label']) ?></p>
          <p class="mt-1 text-sm text-white/55"><?= htmlspecialchars($stat['note']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ===== Approach ===================================================== -->
<section class="section bg-white">
  <div class="container">
    <div class="grid gap-10 lg:grid-cols-12">

      <div class="lg:col-span-5" <?= admc_edit('settings_about_approach', $approach['id']) ?>>
        <span class="eyebrow reveal"><?= htmlspecialchars($approach['input_eyebrow']) ?></span>
        <h2 class="mt-6 text-display-md reveal" style="--reveal-delay:80ms">
          <?= admc_lines($approach['input_heading']) ?>
        </h2>
        <p class="mt-6 leading-relaxed text-ink-soft reveal" style="--reveal-delay:160ms">
          <?= admc_plain($approach['text_intro']) ?>
        </p>
      </div>

      <div class="lg:col-span-6 lg:col-start-7">
        <ol class="space-y-4" <?= admc_list('panel_about_steps') ?>>
          <?php foreach ($panels['panel_about_steps'] as $i => $step): ?>
            <li class="card-hover reveal flex items-start gap-6" style="--reveal-delay:<?= $i * 110 ?>ms" <?= admc_edit('panel_about_steps', $step['id']) ?>>
              <span class="font-display text-4xl font-bold leading-none text-ink-line"><?= sprintf('%02d', $i + 1) ?></span>
              <span>
                <h3 class="font-display text-xl font-semibold text-ink"><?= htmlspecialchars($step['input_title']) ?></h3>
                <p class="mt-2 leading-relaxed text-ink-soft"><?= admc_plain($step['text_body']) ?></p>
              </span>
            </li>
          <?php endforeach; ?>
        </ol>
      </div>

    </div>
  </div>
</section>

<?php include APP_PATH . "/views/includes/footer.php"; ?>
