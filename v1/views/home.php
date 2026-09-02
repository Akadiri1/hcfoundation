<?php
$page_meta = "HC Foundation is a humanitarian organisation restoring hope and transforming lives through outreach, education, health and community development.";
include APP_PATH . "/views/includes/header.php";
?>

<!-- ===== Hero ========================================================= -->
<section class="relative overflow-hidden bg-white pt-[var(--header-h)]">
  <div class="absolute inset-0 fan-glow"></div>
  <div class="absolute inset-x-0 top-0 h-[520px] grid-lines opacity-60 mask-fade-b"></div>

  <div class="container relative pb-14 pt-12 md:pb-20 md:pt-16 lg:pb-24">
    <div class="grid items-center gap-10 lg:grid-cols-12 lg:gap-10">

      <!-- Copy -->
      <div class="lg:col-span-6 xl:col-span-5">
        <span class="eyebrow reveal">Humanitarian Foundation</span>

        <h1 class="mt-6 text-display-xl">
          <span class="reveal-words block text-ink">Restoring Hope.</span>
          <span class="reveal-words block text-gradient">Transforming Lives.</span>
        </h1>

        <p class="mt-7 max-w-lg text-lg leading-relaxed text-ink-soft reveal" style="--reveal-delay:240ms">
          <?= htmlspecialchars($site_promise) ?>
        </p>

        <div class="mt-10 flex flex-wrap gap-4 reveal" style="--reveal-delay:320ms">
          <a href="/initiatives" class="btn-primary btn-lg">
            Explore our work <?= icon('arrow', 'h-4 w-4') ?>
          </a>
          <a href="/volunteer" class="btn-outline btn-lg">Volunteer with us</a>
        </div>

        <!-- Trust strip -->
        <div class="mt-12 flex items-center gap-5 reveal" style="--reveal-delay:400ms">
          <div class="flex -space-x-3">
            <?php foreach (array_slice($hero_images, 0, 3) as $i => $src): ?>
              <span class="media h-11 w-11 rounded-full ring-2 ring-white">
                <img src="<?= $src ?>" alt="" loading="lazy">
              </span>
            <?php endforeach; ?>
            <span class="grid h-11 w-11 place-items-center rounded-full bg-ember-500 text-xs font-bold text-white ring-2 ring-white">
              300+
            </span>
          </div>
          <p class="text-sm leading-snug text-ink-muted">
            Volunteers giving time,<br>skill and presence.
          </p>
        </div>
      </div>

      <!-- Art -->
      <div class="lg:col-span-6 lg:col-start-7">
        <div class="relative mx-auto max-w-xl lg:max-w-none">

          <!-- Fan motif from the logo -->
          <div class="pointer-events-none absolute -left-10 -top-10 h-40 w-40 rounded-full bg-teal-300/25 blur-2xl animate-float-slow"></div>
          <div class="pointer-events-none absolute -bottom-8 -right-6 h-48 w-48 rounded-full bg-ember-400/25 blur-2xl"></div>

          <div class="relative grid grid-cols-5 grid-rows-6 gap-4" data-parallax="9">
            <div class="reveal reveal-scale col-span-3 row-span-6 media rounded-[2rem] shadow-lift media-zoom">
              <img src="<?= $hero_images[0] ?>" alt="Community outreach in progress" class="h-full w-full">
            </div>
            <div class="reveal reveal-scale col-span-2 row-span-3 media rounded-[2rem] shadow-card media-zoom" style="--reveal-delay:140ms">
              <img src="<?= $hero_images[1] ?>" alt="Volunteers at work">
            </div>
            <div class="reveal reveal-scale col-span-2 row-span-3 media rounded-[2rem] shadow-card media-zoom" style="--reveal-delay:260ms">
              <img src="<?= $hero_images[2] ?>" alt="Community gathering">
            </div>
          </div>

          <!-- Floating impact chip -->
          <div class="reveal absolute -bottom-7 -left-4 z-10 rounded-3xl border border-ink-line bg-white/95 p-5 shadow-lift backdrop-blur sm:-left-8"
               style="--reveal-delay:420ms" data-parallax="-14">
            <div class="flex items-center gap-4">
              <span class="icon-tile bg-teal-50 text-teal-600"><?= icon('users', 'h-6 w-6') ?></span>
              <div>
                <p class="font-display text-2xl font-bold leading-none text-ink">
                  <span data-count="12000">0</span><span class="text-ember-500">+</span>
                </p>
                <p class="mt-1.5 text-xs font-medium uppercase tracking-wider text-ink-muted">Lives touched</p>
              </div>
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>
</section>

<!-- ===== What We Do =================================================== -->
<section class="section bg-ink-wash">
  <div class="container">

    <div class="mx-auto max-w-2xl text-center">
      <span class="eyebrow eyebrow-center reveal">What We Do</span>
      <h2 class="mt-6 text-display-lg reveal" style="--reveal-delay:80ms">
        Four ways we show up<br class="hidden sm:block"> for communities
      </h2>
      <p class="mt-6 text-lg leading-relaxed text-ink-soft reveal" style="--reveal-delay:160ms">
        Each programme answers a need we have heard directly from the people we serve.
      </p>
    </div>

    <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
      <?php foreach ($initiatives as $i => $item):
        $isTeal = $item['accent'] === 'teal';
        $tile   = $isTeal ? 'bg-teal-50 text-teal-600' : 'bg-ember-50 text-ember-500';
      ?>
        <article class="card-hover card-rule group reveal flex flex-col" style="--reveal-delay:<?= $i * 90 ?>ms">
          <span class="icon-tile <?= $tile ?>"><?= icon($item['icon'], 'h-7 w-7') ?></span>

          <h3 class="mt-6 font-display text-xl font-semibold leading-snug text-ink">
            <?= htmlspecialchars($item['title']) ?>
          </h3>
          <p class="mt-3 flex-1 text-[0.9375rem] leading-relaxed text-ink-soft">
            <?= htmlspecialchars($item['summary']) ?>
          </p>

          <a href="/view-initiative/<?= $item['slug'] ?>" class="link-arrow mt-6">
            Learn more <?= icon('arrow', 'h-4 w-4') ?>
          </a>
        </article>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<!-- ===== Who we are ==================================================== -->
<section class="section overflow-hidden bg-white">
  <div class="container">
    <div class="grid items-center gap-12 lg:grid-cols-2">

      <div class="relative">
        <div class="reveal reveal-left media aspect-[4/5] rounded-[2.5rem] shadow-lift media-zoom">
          <img src="<?= $img('photo-1509099836639-18ba1795216d', 900, 1120) ?>" alt="Working alongside the community">
        </div>

        <div class="reveal absolute -bottom-8 -right-4 w-56 rounded-3xl bg-ember-grad p-6 text-white shadow-ember sm:-right-8"
             style="--reveal-delay:260ms">
          <p class="font-display text-4xl font-bold leading-none">
            <span data-count="45">0</span>
          </p>
          <p class="mt-2 text-sm font-medium leading-snug text-white/85">
            Communities served, urban and rural
          </p>
        </div>

        <div class="pointer-events-none absolute -left-12 -top-12 h-40 w-40 rounded-full bg-teal-300/30 blur-3xl"></div>
      </div>

      <div class="lg:pl-6">
        <span class="eyebrow reveal">Who We Are</span>
        <h2 class="mt-6 text-display-lg reveal" style="--reveal-delay:80ms">
          People-centered.<br>Transparent. Accountable.
        </h2>

        <div class="prose-brand mt-7 reveal" style="--reveal-delay:160ms">
          <p><?= htmlspecialchars($about_who) ?></p>
          <p><?= htmlspecialchars($about_approach) ?></p>
        </div>

        <div class="mt-9 grid gap-4 sm:grid-cols-2 reveal" style="--reveal-delay:240ms">
          <?php foreach (array_slice($core_values, 0, 4) as $v): ?>
            <div class="flex items-start gap-3">
              <span class="mt-0.5 grid h-8 w-8 shrink-0 place-items-center rounded-lg bg-teal-50 text-teal-600">
                <?= icon($v['icon'], 'h-4 w-4') ?>
              </span>
              <div>
                <p class="font-semibold text-ink"><?= htmlspecialchars($v['title']) ?></p>
                <p class="mt-0.5 text-sm text-ink-muted"><?= htmlspecialchars($v['body']) ?></p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <a href="/about-us" class="btn-outline mt-10 reveal" style="--reveal-delay:320ms">
          More about us <?= icon('arrow', 'h-4 w-4') ?>
        </a>
      </div>

    </div>
  </div>
</section>

<!-- ===== Impact ======================================================= -->
<section class="relative overflow-hidden bg-teal-950 py-14 md:py-20">
  <div class="absolute inset-0 fan-glow-deep"></div>
  <div class="absolute inset-0 grid-lines opacity-30"></div>

  <div class="container relative">
    <div class="grid gap-10 lg:grid-cols-12 lg:gap-12">

      <div class="lg:col-span-5">
        <span class="eyebrow eyebrow-light reveal">Our Impact So Far</span>
        <h2 class="mt-6 text-display-lg text-white reveal" style="--reveal-delay:80ms">
          Measured in lives touched, not activity reported.
        </h2>
        <p class="mt-6 text-lg leading-relaxed text-white/70 reveal" style="--reveal-delay:160ms">
          We believe impact is measured by lives touched and stories changed. Across
          communities, HC Foundation continues to create meaningful change through
          consistent service and collaboration.
        </p>
        <a href="/initiatives" class="btn-ghost-light mt-9 reveal" style="--reveal-delay:240ms">
          See the programmes <?= icon('arrow', 'h-4 w-4') ?>
        </a>
      </div>

      <div class="lg:col-span-6 lg:col-start-7">
        <div class="grid gap-5 sm:grid-cols-2">
          <?php foreach ($impact_stats as $i => $stat): ?>
            <div class="reveal rounded-3xl border border-white/12 bg-white/[0.06] p-7 backdrop-blur-sm transition-colors duration-500 hover:border-ember-500/50 hover:bg-white/[0.09]"
                 style="--reveal-delay:<?= $i * 90 ?>ms">
              <p class="font-display text-[2.75rem] font-bold leading-none text-white">
                <span data-count="<?= $stat['value'] ?>">0</span><span class="text-ember-400"><?= $stat['suffix'] ?></span>
              </p>
              <p class="mt-3 font-semibold text-white"><?= htmlspecialchars($stat['label']) ?></p>
              <p class="mt-1 text-sm leading-snug text-white/55"><?= htmlspecialchars($stat['note']) ?></p>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ===== Initiatives feature ========================================== -->
<section class="section bg-white">
  <div class="container">

    <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
      <div class="max-w-xl">
        <span class="eyebrow reveal">Our Work</span>
        <h2 class="mt-6 text-display-lg reveal" style="--reveal-delay:80ms">
          Initiatives built to last
        </h2>
      </div>
      <a href="/initiatives" class="link-arrow reveal shrink-0" style="--reveal-delay:160ms">
        View all initiatives <?= icon('arrow', 'h-4 w-4') ?>
      </a>
    </div>

    <div class="mt-10 grid gap-6 md:grid-cols-2">
      <?php foreach (array_slice($initiatives, 0, 2) as $i => $item): ?>
        <a href="/view-initiative/<?= $item['slug'] ?>"
           class="group reveal media media-zoom relative flex min-h-[26rem] flex-col justify-end overflow-hidden rounded-[2rem] p-8 shadow-card transition-shadow duration-500 hover:shadow-lift"
           style="--reveal-delay:<?= $i * 120 ?>ms">
          <img src="<?= $item['image'] ?>" alt="<?= htmlspecialchars($item['title']) ?>" class="absolute inset-0">
          <span class="absolute inset-0 bg-gradient-to-t from-ink via-ink/55 to-transparent"></span>

          <span class="relative">
            <span class="inline-flex rounded-full bg-white/15 px-3.5 py-1.5 text-xs font-semibold uppercase tracking-wider text-white backdrop-blur-sm">
              Initiative
            </span>
            <h3 class="mt-4 font-display text-2xl font-bold text-white"><?= htmlspecialchars($item['title']) ?></h3>
            <p class="mt-2.5 max-w-md text-[0.9375rem] leading-relaxed text-white/75"><?= htmlspecialchars($item['summary']) ?></p>
            <span class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-ember-300 transition-transform duration-300 group-hover:translate-x-1">
              Learn more <?= icon('arrow', 'h-4 w-4') ?>
            </span>
          </span>
        </a>
      <?php endforeach; ?>
    </div>

    <div class="mt-6 grid gap-6 sm:grid-cols-2">
      <?php foreach (array_slice($initiatives, 2, 2) as $i => $item):
        $isTeal = $item['accent'] === 'teal';
      ?>
        <a href="/view-initiative/<?= $item['slug'] ?>"
           class="card-hover card-rule group reveal flex items-start gap-5"
           style="--reveal-delay:<?= $i * 120 ?>ms">
          <span class="icon-tile <?= $isTeal ? 'bg-teal-50 text-teal-600' : 'bg-ember-50 text-ember-500' ?>">
            <?= icon($item['icon'], 'h-7 w-7') ?>
          </span>
          <span>
            <h3 class="font-display text-xl font-semibold text-ink"><?= htmlspecialchars($item['title']) ?></h3>
            <p class="mt-2 text-[0.9375rem] leading-relaxed text-ink-soft"><?= htmlspecialchars($item['summary']) ?></p>
            <span class="link-arrow mt-4">Learn more <?= icon('arrow', 'h-4 w-4') ?></span>
          </span>
        </a>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<!-- ===== Latest from the blog ========================================= -->
<section class="section bg-ink-wash">
  <div class="container">

    <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
      <div class="max-w-xl">
        <span class="eyebrow reveal">Stories &amp; Updates</span>
        <h2 class="mt-6 text-display-lg reveal" style="--reveal-delay:80ms">From the field</h2>
      </div>
      <a href="/blog" class="link-arrow reveal shrink-0" style="--reveal-delay:160ms">
        Read the blog <?= icon('arrow', 'h-4 w-4') ?>
      </a>
    </div>

    <div class="mt-10 grid gap-6 md:grid-cols-3">
      <?php foreach (array_slice($blog_posts, 0, 3) as $i => $post): ?>
        <article class="reveal group overflow-hidden rounded-[1.75rem] border border-ink-line bg-white shadow-card transition-all duration-500 ease-out-expo hover:-translate-y-1.5 hover:shadow-lift"
                 style="--reveal-delay:<?= $i * 100 ?>ms">
          <a href="/read-blog/<?= $post['slug'] ?>" class="block">
            <span class="media media-zoom block aspect-[16/10]">
              <img src="<?= $post['image'] ?>" alt="<?= htmlspecialchars($post['title']) ?>" loading="lazy">
            </span>
            <span class="block p-7">
              <span class="flex items-center gap-3 text-xs font-semibold uppercase tracking-wider">
                <span class="text-teal-700"><?= htmlspecialchars($post['category']) ?></span>
                <span class="h-1 w-1 rounded-full bg-ink-line"></span>
                <span class="text-ink-muted"><?= htmlspecialchars($post['read']) ?></span>
              </span>
              <h3 class="mt-4 font-display text-lg font-semibold leading-snug text-ink transition-colors duration-300 group-hover:text-teal-700">
                <?= htmlspecialchars($post['title']) ?>
              </h3>
              <p class="mt-3 text-[0.9375rem] leading-relaxed text-ink-soft"><?= htmlspecialchars($post['excerpt']) ?></p>
              <span class="mt-5 block text-xs font-medium text-ink-muted"><?= htmlspecialchars($post['date']) ?></span>
            </span>
          </a>
        </article>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<!-- ===== Partners ===================================================== -->
<section class="border-y border-ink-line bg-white py-14">
  <div class="container">
    <p class="text-center text-sm font-medium uppercase tracking-[0.16em] text-ink-muted reveal">
      Working alongside
    </p>

    <div class="marquee-wrap mask-fade-r mt-9 overflow-hidden">
      <div class="marquee-track flex w-max items-center gap-12">
        <?php for ($pass = 0; $pass < 2; $pass++): ?>
          <?php foreach ($partners as $p): ?>
            <span class="flex shrink-0 items-center gap-3 font-display text-xl font-semibold text-ink-muted/70 transition-colors duration-300 hover:text-teal-700">
              <span class="grid h-9 w-9 place-items-center rounded-lg bg-ink-wash text-teal-600">
                <?= icon('star', 'h-4 w-4') ?>
              </span>
              <?= htmlspecialchars($p) ?>
            </span>
          <?php endforeach; ?>
        <?php endfor; ?>
      </div>
    </div>
  </div>
</section>

<?php include APP_PATH . "/views/includes/footer.php"; ?>
