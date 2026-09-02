<?php
/**
 * Single initiative. $slug is set by the router.
 */
$current = null;
foreach ($initiatives as $item) {
    if ($item['slug'] === ($slug ?? '')) { $current = $item; break; }
}

if (!$current) {
    include APP_PATH . "/views/404.php";
    die;
}

$others = array_values(array_filter($initiatives, function ($i) use ($current) { return $i['slug'] !== $current['slug']; }));

$page_title = $current['title'];
$page_meta  = $current['summary'];
include APP_PATH . "/views/includes/header.php";

$hero_eyebrow = 'Initiative';
$hero_crumb   = $current['title'];
$hero_title   = htmlspecialchars($current['title']);
$hero_text    = $current['summary'];
include APP_PATH . "/views/includes/partials/page-hero.php";
?>

<section class="section bg-white">
  <div class="container">
    <div class="grid gap-14 lg:grid-cols-12 lg:gap-16">

      <!-- Body -->
      <div class="lg:col-span-7">
        <div class="reveal media media-zoom aspect-[16/10] rounded-[2rem] shadow-lift">
          <img src="<?= $current['image'] ?>" alt="<?= htmlspecialchars($current['title']) ?>">
        </div>

        <div class="prose-brand mt-10 reveal" style="--reveal-delay:120ms">
          <p class="text-xl leading-relaxed text-ink"><?= htmlspecialchars($current['body']) ?></p>

          <h2>What this looks like in practice</h2>
          <p>
            Work under this initiative is planned with the community, delivered by
            teams drawn from the community wherever possible, and reported back to
            the community once complete.
          </p>

          <ul>
            <li>Needs identified through direct engagement rather than assumption</li>
            <li>Delivery sized to what can be sustained beyond a single cycle</li>
            <li>Outcomes recorded and published, including what did not work</li>
            <li>Local capacity built so the work continues without us</li>
          </ul>

          <blockquote>
            Impact is measured by lives touched and stories changed.
          </blockquote>

          <h2>How you can support it</h2>
          <p>
            Volunteers, partner organisations and advocates all extend how far this
            initiative reaches. If any of those describe you, we would like to hear
            from you.
          </p>
        </div>

        <div class="mt-10 flex flex-wrap gap-4 reveal">
          <a href="/volunteer" class="btn-primary">Volunteer for this <?= icon('arrow', 'h-4 w-4') ?></a>
          <a href="/contact-us" class="btn-outline">Partner with us</a>
        </div>
      </div>

      <!-- Sidebar -->
      <aside class="lg:col-span-4 lg:col-start-9">
        <div class="lg:sticky lg:top-32 space-y-6">

          <div class="reveal reveal-right rounded-3xl bg-teal-grad p-8 text-white shadow-glow">
            <h2 class="font-display text-xl font-bold">At a glance</h2>
            <dl class="mt-6 space-y-4 text-sm">
              <?php foreach ([
                'Focus'    => $current['title'],
                'Approach' => 'Community-led delivery',
                'Status'   => 'Active',
                'Reach'    => 'Urban and rural communities',
              ] as $k => $v): ?>
                <div class="flex items-start justify-between gap-4 border-b border-white/15 pb-4 last:border-0 last:pb-0">
                  <dt class="text-white/60"><?= $k ?></dt>
                  <dd class="text-right font-medium"><?= htmlspecialchars($v) ?></dd>
                </div>
              <?php endforeach; ?>
            </dl>
          </div>

          <div class="reveal reveal-right card" style="--reveal-delay:120ms">
            <h2 class="font-display text-lg font-semibold text-ink">Other initiatives</h2>
            <ul class="mt-5 space-y-1">
              <?php foreach ($others as $o): ?>
                <li>
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
