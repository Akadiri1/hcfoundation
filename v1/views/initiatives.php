<?php
$page_title = 'Initiatives';
$page_meta  = "Each HC Foundation initiative is designed to respond to real needs and create lasting outcomes.";
include APP_PATH . "/views/includes/header.php";

$hero_eyebrow = 'Our Work';
$hero_title   = 'Initiatives that answer <span class="text-gradient">real needs</span>';
$hero_text    = 'Each initiative is designed to respond to real needs and create lasting outcomes.';
include APP_PATH . "/views/includes/partials/page-hero.php";
?>

<!-- ===== Initiative list ============================================== -->
<section class="section bg-white">
  <div class="container">
    <div class="space-y-8 lg:space-y-12">

      <?php foreach ($initiatives as $i => $item):
        $flip   = $i % 2 === 1;
        $isTeal = $item['accent'] === 'teal';
      ?>
        <article class="reveal grid items-center gap-10 lg:grid-cols-2 lg:gap-16" style="--reveal-delay:<?= $i * 60 ?>ms">

          <div class="<?= $flip ? 'lg:order-2' : '' ?>">
            <div class="media media-zoom aspect-[5/4] rounded-[2.5rem] shadow-lift">
              <img src="<?= $item['image'] ?>" alt="<?= htmlspecialchars($item['programme']) ?>" loading="lazy">
            </div>
          </div>

          <div class="<?= $flip ? 'lg:order-1 lg:pr-6' : 'lg:pl-6' ?>">
            <div class="flex items-center gap-4">
              <span class="icon-tile <?= $isTeal ? 'bg-teal-50 text-teal-600' : 'bg-ember-50 text-ember-500' ?>">
                <?= icon($item['icon'], 'h-7 w-7') ?>
              </span>
              <span class="font-display text-5xl font-bold leading-none text-ink-line">0<?= $i + 1 ?></span>
            </div>

            <h2 class="mt-6 text-display-sm"><?= htmlspecialchars($item['programme']) ?></h2>
            <p class="mt-4 text-lg leading-relaxed text-ink"><?= htmlspecialchars($item['description']) ?></p>
            <p class="mt-4 leading-relaxed text-ink-soft"><?= htmlspecialchars($item['body']) ?></p>

            <div class="mt-8 flex flex-wrap gap-4">
              <a href="/view-initiative/<?= $item['slug'] ?>" class="btn-primary">
                Learn more <?= icon('arrow', 'h-4 w-4') ?>
              </a>
              <a href="/volunteer" class="btn-outline">Support this work</a>
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
    <div class="grid gap-6 md:grid-cols-3">
      <?php foreach ([
        ['users',  'Community-led',   'Programmes are shaped by the people they serve, not designed at a distance.'],
        ['shield', 'Accountable',     'Every initiative reports against outcomes, not activity counts.'],
        ['growth', 'Built to last',   'We hand over capacity, so progress continues after we step back.'],
      ] as $i => [$ic, $title, $body]): ?>
        <div class="card-hover card-rule reveal" style="--reveal-delay:<?= $i * 90 ?>ms">
          <span class="icon-tile <?= $i === 1 ? 'bg-ember-50 text-ember-500' : 'bg-teal-50 text-teal-600' ?>">
            <?= icon($ic, 'h-7 w-7') ?>
          </span>
          <h3 class="mt-5 font-display text-lg font-semibold text-ink"><?= $title ?></h3>
          <p class="mt-2.5 leading-relaxed text-ink-soft"><?= $body ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php include APP_PATH . "/views/includes/footer.php"; ?>
