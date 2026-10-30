<?php
$page_title = 'Initiatives';
$page_meta  = "Each HC Foundation initiative is designed to respond to real needs and create lasting outcomes.";
include APP_PATH . "/views/includes/header.php";

$hero_section = 'settings_initiatives_hero';
$hero_crumb   = $navLabels['input_initiatives'];
include APP_PATH . "/views/includes/partials/page-hero.php";

$pageCopy = admc_section('settings_initiatives_page');
$pageEdit = admc_edit('settings_initiatives_page', $pageCopy['id']);
?>

<!-- ===== Initiative list ============================================== -->
<section class="section bg-white">
  <div class="container">
    <div class="space-y-8 lg:space-y-12" <?= admc_list('panel_initiatives') ?>>

      <?php foreach ($initiatives as $i => $item):
        $flip   = $i % 2 === 1;
        $isTeal = $item['accent'] === 'teal';
        $edit   = admc_edit('panel_initiatives', $item['id'] ?? null);
      ?>
        <article class="reveal grid items-center gap-10 lg:grid-cols-2 lg:gap-12" style="--reveal-delay:<?= $i * 60 ?>ms">

          <div class="<?= $flip ? 'lg:order-2' : '' ?>">
            <div class="media media-zoom aspect-[5/4] rounded-[2.5rem] shadow-lift" <?= admc_image('panel_initiatives', $item['id'] ?? null) ?>>
              <img src="<?= $item['image'] ?>" alt="<?= htmlspecialchars($item['programme']) ?>" loading="lazy">
            </div>
          </div>

          <div class="<?= $flip ? 'lg:order-1 lg:pr-6' : 'lg:pl-6' ?>">
            <div class="flex items-center gap-4">
              <span class="icon-tile <?= $isTeal ? 'bg-teal-50 text-teal-600' : 'bg-ember-50 text-ember-500' ?>">
                <?= icon($item['icon'], 'h-7 w-7') ?>
              </span>
              <span class="font-display text-5xl font-bold leading-none text-ink-line"><?= sprintf('%02d', $i + 1) ?></span>
            </div>

            <h2 class="mt-6 text-display-sm" <?= $edit ?>><?= htmlspecialchars($item['programme']) ?></h2>
            <p class="mt-4 text-lg leading-relaxed text-ink" <?= $edit ?>><?= admc_plain($item['description']) ?></p>
            <p class="mt-4 leading-relaxed text-ink-soft" <?= $edit ?>><?= admc_plain($item['body']) ?></p>

            <div class="mt-8 flex flex-wrap gap-4" <?= $pageEdit ?>>
              <a href="/view-initiative/<?= $item['slug'] ?>" class="btn-primary">
                <?= htmlspecialchars($pageCopy['input_learn_more']) ?> <?= icon('arrow', 'h-4 w-4') ?>
              </a>
              <a href="/volunteer" class="btn-outline"><?= htmlspecialchars($pageCopy['input_support_button']) ?></a>
            </div>
          </div>

        </article>

        <?php if ($i < count($initiatives) - 1): ?>
          <hr class="border-ink-line">
        <?php endif; ?>
      <?php endforeach; ?>

    </div>
  </div>
</section>

<!-- ===== Approach strip =============================================== -->
<section class="section-tight bg-ink-wash">
  <div class="container">
    <div class="grid gap-6 md:grid-cols-3" <?= admc_list('panel_initiative_principles') ?>>
      <?php foreach ($panels['panel_initiative_principles'] as $i => $principle): ?>
        <div class="card-hover card-rule reveal" style="--reveal-delay:<?= $i * 90 ?>ms" <?= admc_edit('panel_initiative_principles', $principle['id']) ?>>
          <span class="icon-tile <?= $i === 1 ? 'bg-ember-50 text-ember-500' : 'bg-teal-50 text-teal-600' ?>">
            <?= icon($principle['input_icon'] ?: 'star', 'h-7 w-7') ?>
          </span>
          <h3 class="mt-5 font-display text-lg font-semibold text-ink"><?= htmlspecialchars($principle['input_title']) ?></h3>
          <p class="mt-2.5 leading-relaxed text-ink-soft"><?= admc_plain($principle['text_body']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php include APP_PATH . "/views/includes/footer.php"; ?>
