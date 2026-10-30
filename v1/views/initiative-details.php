<?php
/**
 * Single initiative. $slug is set by the router.
 */
$slug = $slug ?? $_GET['slug'] ?? $_GET['id'] ?? null;
$current = null;
foreach ($initiatives as $item) {
    if ($item['slug'] === $slug || (isset($item['id']) && (string)$item['id'] === (string)$slug)) { $current = $item; break; }
}

if (!$current) {
    include APP_PATH . "/views/404.php";
    die;
}

$others = array_values(array_filter($initiatives, function ($i) use ($current) { return $i['slug'] !== $current['slug']; }));

$page_title = $current['programme'];
$page_meta  = strip_tags($current['description']);
include APP_PATH . "/views/includes/header.php";

$edit = admc_edit('panel_initiatives', $current['id'] ?? null);

$hero_eyebrow   = $current['title'];
$hero_crumb     = $current['programme'];
$hero_crumb_admc = $edit;
$hero_title     = htmlspecialchars($current['programme']);
$hero_text      = $current['description'];
$hero_admc      = $edit;
$hero_text_admc = $edit;
include APP_PATH . "/views/includes/partials/page-hero.php";

$labels     = admc_section('settings_initiative_details');
$labelsEdit = admc_edit('settings_initiative_details', $labels['id']);
?>

<section class="section bg-white">
  <div class="container">
    <div class="grid gap-10 lg:grid-cols-12 lg:gap-12">

      <!-- Body -->
      <div class="lg:col-span-7">
        <div class="reveal media media-zoom aspect-[16/10] rounded-[2rem] shadow-lift" <?= admc_image('panel_initiatives', $current['id'] ?? null) ?>>
          <img src="<?= $current['image'] ?>" alt="<?= htmlspecialchars($current['title']) ?>">
        </div>

        <div class="prose-brand mt-10 reveal" style="--reveal-delay:120ms" <?= $edit ?>>
          <p class="text-xl leading-relaxed text-ink"><?= admc_plain($current['body']) ?></p>
          <?= admc_rich($current['content']) ?>
        </div>

        <div class="mt-10 flex flex-wrap gap-4 reveal" <?= $labelsEdit ?>>
          <a href="/volunteer" class="btn-primary"><?= htmlspecialchars($labels['input_volunteer_button']) ?> <?= icon('arrow', 'h-4 w-4') ?></a>
          <a href="/contact-us" class="btn-outline"><?= htmlspecialchars($labels['input_partner_button']) ?></a>
        </div>
      </div>

      <!-- Sidebar -->
      <aside class="lg:col-span-4 lg:col-start-9">
        <div class="lg:sticky lg:top-32 space-y-6">

          <div class="reveal reveal-right rounded-3xl bg-teal-grad p-8 text-white shadow-glow" <?= $edit ?>>
            <h2 class="font-display text-xl font-bold" <?= $labelsEdit ?>><?= htmlspecialchars($labels['input_glance_title']) ?></h2>
            <dl class="mt-6 space-y-4 text-sm">
              <?php foreach ([
                $labels['input_focus_label']    => $current['title'],
                $labels['input_approach_label'] => $current['approach'],
                $labels['input_status_label']   => $current['status'],
                $labels['input_reach_label']    => $current['reach'],
              ] as $k => $v): ?>
                <div class="flex items-start justify-between gap-4 border-b border-white/15 pb-4 last:border-0 last:pb-0">
                  <dt class="text-white/60"><?= htmlspecialchars($k) ?></dt>
                  <dd class="text-right font-medium"><?= htmlspecialchars($v) ?></dd>
                </div>
              <?php endforeach; ?>
            </dl>
          </div>

          <div class="reveal reveal-right card" style="--reveal-delay:120ms">
            <h2 class="font-display text-lg font-semibold text-ink" <?= $labelsEdit ?>><?= htmlspecialchars($labels['input_others_title']) ?></h2>
            <ul class="mt-5 space-y-1">
              <?php foreach ($others as $o): ?>
                <li <?= admc_edit('panel_initiatives', $o['id'] ?? null) ?>>
                  <a href="/view-initiative/<?= $o['slug'] ?>"
                     class="group flex items-center justify-between gap-4 rounded-2xl px-4 py-3 transition-colors duration-300 hover:bg-ink-wash">
                    <span class="text-[0.9375rem] font-medium text-ink"><?= htmlspecialchars($o['title']) ?></span>
                    <span class="text-ink-muted transition-transform duration-300 group-hover:translate-x-1">
                      <?= icon('arrow', 'h-4 w-4') ?>
                    </span>
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>

        </div>
      </aside>

    </div>
  </div>
</section>

<?php include APP_PATH . "/views/includes/footer.php"; ?>
