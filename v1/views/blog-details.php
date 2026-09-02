<?php
/**
 * Single blog post. $slug is set by the router.
 */
$post = null;
foreach ($blog_posts as $p) {
    if ($p['slug'] === ($slug ?? '')) { $post = $p; break; }
}

if (!$post) {
    include APP_PATH . "/views/404.php";
    die;
}

$related = array_slice(array_values(array_filter($blog_posts, function ($p) use ($post) { return $p['slug'] !== $post['slug']; })), 0, 3);

$page_title = $post['title'];
$page_meta  = $post['excerpt'];
include APP_PATH . "/views/includes/header.php";
?>

<!-- ===== Post header ================================================== -->
<section class="relative overflow-hidden bg-ink-wash pt-[var(--header-h)]">
  <div class="absolute inset-0 fan-glow"></div>
  <div class="absolute inset-0 grid-lines opacity-50 mask-fade-b"></div>

  <div class="container relative py-12 md:py-16">
    <nav class="flex items-center gap-2 text-sm text-ink-muted reveal" aria-label="Breadcrumb">
      <a href="/home" class="transition-colors hover:text-teal-700">Home</a>
      <span class="text-ink-line">/</span>
      <a href="/blog" class="transition-colors hover:text-teal-700">Blog</a>
      <span class="text-ink-line">/</span>
      <span class="font-medium text-ink"><?= htmlspecialchars($post['category']) ?></span>
    </nav>

    <div class="mt-8 max-w-3xl">
      <span class="inline-flex rounded-full bg-teal-600 px-4 py-1.5 text-xs font-semibold uppercase tracking-wider text-white reveal">
        <?= htmlspecialchars($post['category']) ?>
      </span>

      <h1 class="mt-6 text-display-lg reveal" style="--reveal-delay:80ms">
        <?= htmlspecialchars($post['title']) ?>
      </h1>

      <div class="mt-8 flex flex-wrap items-center gap-5 text-sm text-ink-soft reveal" style="--reveal-delay:160ms">
        <span class="flex items-center gap-3">
          <span class="grid h-10 w-10 place-items-center rounded-full bg-teal-grad text-white">
            <?= icon('users', 'h-4 w-4') ?>
          </span>
          <span class="font-semibold text-ink"><?= htmlspecialchars($post['author']) ?></span>
        </span>
        <span class="h-1 w-1 rounded-full bg-ink-line"></span>
        <span><?= htmlspecialchars($post['date']) ?></span>
        <span class="h-1 w-1 rounded-full bg-ink-line"></span>
        <span><?= htmlspecialchars($post['read']) ?></span>
      </div>
    </div>
  </div>
</section>

<!-- ===== Body ========================================================= -->
<section class="section bg-white">
  <div class="container">
    <div class="grid gap-10 lg:grid-cols-12 lg:gap-12">

      <article class="lg:col-span-8">
        <div class="reveal media aspect-[16/9] rounded-[2rem] shadow-lift">
          <img src="<?= $post['image'] ?>" alt="<?= htmlspecialchars($post['title']) ?>">
        </div>

        <div class="prose-brand mt-10 reveal" style="--reveal-delay:100ms">
          <p class="text-xl leading-relaxed text-ink"><?= htmlspecialchars($post['excerpt']) ?></p>

          <p>
            This is placeholder body copy. Once the CMS is connected, the full article
            will render here exactly as written in the admin panel, with headings,
            lists, quotes and images all styled to match.
          </p>

          <h2>Why this matters</h2>
          <p>
            Consistency is the part of this work that rarely gets photographed. It is
            also the part that changes outcomes. Showing up once is a gesture; showing
            up repeatedly is a relationship, and relationships are what carry a
            community through the months when nobody is watching.
          </p>

          <blockquote>
            We believe impact is measured by lives touched and stories changed.
          </blockquote>

          <h2>What we learned</h2>
          <ul>
            <li>Needs identified by the community are more accurate than needs assumed</li>
            <li>Smaller programmes sustained over time outperform larger one-off pushes</li>
            <li>Reporting honestly on what failed builds more trust than reporting only wins</li>
          </ul>

          <p>
            If this is work you would like to be part of, the volunteer page lists where
            we currently need help.
          </p>
        </div>

        <!-- Share -->
        <div class="mt-12 flex flex-wrap items-center justify-between gap-6 rounded-3xl border border-ink-line bg-ink-wash p-7 reveal">
          <p class="font-display text-lg font-semibold text-ink">Share this story</p>
          <div class="flex gap-2.5">
            <?php foreach ($socialLinks as $s): ?>
              <a href="#" aria-label="Share on <?= $s['name'] ?>"
                 class="grid h-11 w-11 place-items-center rounded-full border border-ink-line bg-white text-ink-soft transition-all duration-300 hover:-translate-y-0.5 hover:border-teal-600 hover:bg-teal-600 hover:text-white">
                <?= social_icon($s['icon']) ?>
              </a>
            <?php endforeach; ?>
          </div>
        </div>
      </article>

      <!-- Sidebar -->
      <aside class="lg:col-span-4 lg:col-start-9">
        <div class="lg:sticky lg:top-32 space-y-6">

          <div class="reveal reveal-right card">
            <h2 class="font-display text-lg font-semibold text-ink">Categories</h2>
            <ul class="mt-5 space-y-1">
              <?php foreach ($blog_categories as $cat): ?>
                <li>
                  <a href="/blog" class="group flex items-center justify-between gap-4 rounded-2xl px-4 py-3 transition-colors duration-300 hover:bg-ink-wash">
                    <span class="text-[0.9375rem] text-ink"><?= htmlspecialchars($cat) ?></span>
                    <span class="text-ink-muted transition-transform duration-300 group-hover:translate-x-1">
                      <?= icon('arrow', 'h-4 w-4') ?>
                    </span>
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>

          <div class="reveal reveal-right rounded-3xl bg-ember-grad p-8 text-white shadow-ember" style="--reveal-delay:120ms">
            <h2 class="font-display text-xl font-bold">Be part of the next story</h2>
            <p class="mt-3 leading-relaxed text-white/85">
              Volunteers extend how far this work reaches.
            </p>
            <a href="/volunteer" class="btn mt-6 w-full bg-white text-ember-600 hover:bg-white/90">
              Volunteer with us <?= icon('arrow', 'h-4 w-4') ?>
            </a>
          </div>

        </div>
      </aside>

    </div>
  </div>
</section>

<!-- ===== Related ====================================================== -->
<section class="section-tight bg-ink-wash">
  <div class="container">
    <h2 class="text-display-sm reveal">Continue reading</h2>

    <div class="mt-10 grid gap-6 md:grid-cols-3">
      <?php foreach ($related as $i => $r): ?>
        <article class="reveal group overflow-hidden rounded-[1.75rem] border border-ink-line bg-white shadow-card transition-all duration-500 ease-out-expo hover:-translate-y-1.5 hover:shadow-lift"
                 style="--reveal-delay:<?= $i * 90 ?>ms">
          <a href="/read-blog/<?= $r['slug'] ?>" class="block">
            <span class="media media-zoom block aspect-[16/10]">
              <img src="<?= $r['image'] ?>" alt="<?= htmlspecialchars($r['title']) ?>" loading="lazy">
            </span>
            <span class="block p-6">
              <span class="text-xs font-semibold uppercase tracking-wider text-teal-700"><?= htmlspecialchars($r['category']) ?></span>
              <h3 class="mt-3 font-display text-base font-semibold leading-snug text-ink transition-colors duration-300 group-hover:text-teal-700">
                <?= htmlspecialchars($r['title']) ?>
              </h3>
              <span class="mt-4 block text-xs text-ink-muted"><?= htmlspecialchars($r['date']) ?></span>
            </span>
          </a>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php include APP_PATH . "/views/includes/footer.php"; ?>
