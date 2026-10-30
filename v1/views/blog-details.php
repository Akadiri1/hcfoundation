<?php
/**
 * Single blog post. $slug is set by the router.
 */
$slug = $slug ?? $_GET['slug'] ?? $_GET['id'] ?? null;
$post = null;
foreach ($blog_posts as $p) {
    if ($p['slug'] === $slug || (isset($p['id']) && (string)$p['id'] === (string)$slug)) { $post = $p; break; }
}

if (!$post) {
    include APP_PATH . "/views/404.php";
    die;
}

$related = array_slice(array_values(array_filter($blog_posts, function ($p) use ($post) { return $p['slug'] !== $post['slug']; })), 0, 3);

$page_title = $post['title'];
$page_meta  = strip_tags($post['excerpt']);
include APP_PATH . "/views/includes/header.php";

$postEdit   = admc_edit('panel_blog', $post['id'] ?? null);
$labels     = admc_section('settings_blog_post');
$labelsEdit = admc_edit('settings_blog_post', $labels['id']);
?>

<!-- ===== Post header ================================================== -->
<section class="relative overflow-hidden bg-ink-wash pt-[var(--header-h)]">
  <div class="absolute inset-0 fan-glow"></div>
  <div class="container relative py-10 md:py-12">
    <nav class="flex items-center gap-2 text-sm text-ink-muted reveal" aria-label="Breadcrumb" <?= $navEdit ?>>
      <a href="/home" class="transition-colors hover:text-teal-700"><?= htmlspecialchars($navLabels['input_home']) ?></a>
      <span class="text-ink-line">/</span>
      <a href="/blog" class="transition-colors hover:text-teal-700"><?= htmlspecialchars($navLabels['input_blog']) ?></a>
      <span class="text-ink-line">/</span>
      <span class="font-medium text-ink" <?= $postEdit ?>><?= htmlspecialchars($post['category']) ?></span>
    </nav>

    <div class="mt-8 max-w-3xl">
      <span class="inline-flex rounded-full bg-teal-600 px-4 py-1.5 text-xs font-semibold uppercase tracking-wider text-white reveal" <?= $postEdit ?>>
        <?= htmlspecialchars($post['category']) ?>
      </span>

      <h1 class="mt-6 text-display-lg reveal" style="--reveal-delay:80ms" <?= $postEdit ?>>
        <?= htmlspecialchars($post['title']) ?>
      </h1>

      <div class="mt-8 flex flex-wrap items-center gap-5 text-sm text-ink-soft reveal" style="--reveal-delay:160ms" <?= $postEdit ?>>
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
        <div class="reveal media aspect-[16/9] rounded-[2rem] shadow-lift" <?= admc_image('panel_blog', $post['id'] ?? null) ?>>
          <img src="<?= $post['image'] ?>" alt="<?= htmlspecialchars($post['title']) ?>">
        </div>

        <div class="prose-brand mt-10 reveal" style="--reveal-delay:100ms" <?= $postEdit ?>>
          <p class="text-xl leading-relaxed text-ink"><?= admc_plain($post['excerpt']) ?></p>
          <?= admc_rich($post['content']) ?>
        </div>

        <!-- Share -->
        <div class="mt-10 flex flex-wrap items-center justify-between gap-6 rounded-3xl border border-ink-line bg-ink-wash p-7 reveal">
          <p class="font-display text-lg font-semibold text-ink" <?= $labelsEdit ?>><?= htmlspecialchars($labels['input_share_title']) ?></p>
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
            <h2 class="font-display text-lg font-semibold text-ink" <?= $labelsEdit ?>><?= htmlspecialchars($labels['input_categories_title']) ?></h2>
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

          <div class="reveal reveal-right rounded-3xl bg-ember-grad p-8 text-white shadow-ember" style="--reveal-delay:120ms" <?= $labelsEdit ?>>
            <h2 class="font-display text-xl font-bold"><?= admc_lines($labels['input_cta_heading']) ?></h2>
            <p class="mt-3 leading-relaxed text-white/85">
              <?= admc_plain($labels['text_cta_intro']) ?>
            </p>
            <a href="/volunteer" class="btn mt-6 w-full bg-white text-ember-600 hover:bg-white/90">
              <?= htmlspecialchars($labels['input_cta_button']) ?> <?= icon('arrow', 'h-4 w-4') ?>
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
    <h2 class="text-display-sm reveal" <?= $labelsEdit ?>><?= htmlspecialchars($labels['input_related_title']) ?></h2>

    <div class="mt-10 grid gap-6 md:grid-cols-3" <?= admc_list('panel_blog') ?>>
      <?php foreach ($related as $i => $r): ?>
        <article class="reveal group overflow-hidden rounded-[1.75rem] border border-ink-line bg-white shadow-card transition-all duration-500 ease-out-expo hover:-translate-y-1.5 hover:shadow-lift"
                 style="--reveal-delay:<?= $i * 90 ?>ms">
          <a href="/read-blog/<?= $r['slug'] ?>" class="block">
            <span class="media media-zoom block aspect-[16/10]" <?= admc_image('panel_blog', $r['id'] ?? null) ?>>
              <img src="<?= $r['image'] ?>" alt="<?= htmlspecialchars($r['title']) ?>" loading="lazy">
            </span>
            <span class="block p-6" <?= admc_edit('panel_blog', $r['id'] ?? null) ?>>
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
