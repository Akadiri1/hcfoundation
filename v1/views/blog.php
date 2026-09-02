<?php
$page_title = 'Blog';
$page_meta  = "Read about our work, the people we serve, and the lessons we learn along the way.";
include APP_PATH . "/views/includes/header.php";

$hero_eyebrow = 'Blog';
$hero_title   = 'Stories &amp; <span class="text-gradient">Updates</span>';
$hero_text    = 'Read about our work, the people we serve, and the lessons we learn along the way.';
include APP_PATH . "/views/includes/partials/page-hero.php";

$featured = $blog_posts[0];
$rest     = array_slice($blog_posts, 1);
?>

<!-- ===== Featured ===================================================== -->
<section class="pt-16 md:pt-20">
  <div class="container">
    <a href="/read-blog/<?= $featured['slug'] ?>"
       class="reveal group grid overflow-hidden rounded-[2rem] border border-ink-line bg-white shadow-card transition-all duration-500 ease-out-expo hover:-translate-y-1 hover:shadow-lift lg:grid-cols-2">

      <span class="media media-zoom block aspect-[16/11] lg:aspect-auto">
        <img src="<?= $featured['image'] ?>" alt="<?= htmlspecialchars($featured['title']) ?>">
      </span>

      <span class="flex flex-col justify-center p-8 md:p-12">
        <span class="flex items-center gap-3 text-xs font-semibold uppercase tracking-wider">
          <span class="rounded-full bg-ember-50 px-3 py-1.5 text-ember-600">Featured</span>
          <span class="text-teal-700"><?= htmlspecialchars($featured['category']) ?></span>
        </span>

        <h2 class="mt-6 font-display text-display-sm leading-tight text-ink transition-colors duration-300 group-hover:text-teal-700">
          <?= htmlspecialchars($featured['title']) ?>
        </h2>

        <p class="mt-4 leading-relaxed text-ink-soft"><?= htmlspecialchars($featured['excerpt']) ?></p>

        <span class="mt-8 flex items-center gap-4 text-sm text-ink-muted">
          <span><?= htmlspecialchars($featured['date']) ?></span>
          <span class="h-1 w-1 rounded-full bg-ink-line"></span>
          <span><?= htmlspecialchars($featured['read']) ?></span>
        </span>

        <span class="link-arrow mt-6">Read the story <?= icon('arrow', 'h-4 w-4') ?></span>
      </span>
    </a>
  </div>
</section>

<!-- ===== Posts ======================================================== -->
<section class="section" data-collection data-page-size="6" data-step="6">
  <div class="container">

    <div class="flex flex-wrap justify-center gap-3 reveal" data-collection-filters>
      <button type="button" data-filter="all" aria-pressed="true"
              class="rounded-full border border-teal-600 bg-teal-600 px-6 py-2.5 text-sm font-semibold text-white transition-all duration-300">
        All posts
      </button>
      <?php foreach ($blog_categories as $cat): ?>
        <button type="button" data-filter="<?= htmlspecialchars($cat) ?>" aria-pressed="false"
                class="rounded-full border border-ink-line px-6 py-2.5 text-sm font-semibold text-ink-soft transition-all duration-300 hover:border-teal-600 hover:text-teal-700">
          <?= htmlspecialchars($cat) ?>
        </button>
      <?php endforeach; ?>
    </div>

    <div class="mt-14 grid gap-6 md:grid-cols-2 lg:grid-cols-3" data-collection-grid>
      <?php foreach ($rest as $i => $post): ?>
        <article data-filter-item="<?= htmlspecialchars($post['category']) ?>"
                 class="reveal group overflow-hidden rounded-[1.75rem] border border-ink-line bg-white shadow-card transition-all duration-500 ease-out-expo hover:-translate-y-1.5 hover:shadow-lift"
                 style="--reveal-delay:<?= min($i, 5) * 90 ?>ms">
          <a href="/read-blog/<?= $post['slug'] ?>" class="block">
            <span class="media media-zoom block aspect-[16/10]">
              <img src="<?= $post['image'] ?>" alt="<?= htmlspecialchars($post['title']) ?>" loading="lazy">
              <span class="absolute left-5 top-5 rounded-full bg-white/90 px-3.5 py-1.5 text-xs font-semibold text-teal-700 backdrop-blur-sm">
                <?= htmlspecialchars($post['category']) ?>
              </span>
            </span>

            <span class="block p-7">
              <h3 class="font-display text-lg font-semibold leading-snug text-ink transition-colors duration-300 group-hover:text-teal-700">
                <?= htmlspecialchars($post['title']) ?>
              </h3>
              <p class="mt-3 text-[0.9375rem] leading-relaxed text-ink-soft"><?= htmlspecialchars($post['excerpt']) ?></p>

              <span class="mt-6 flex items-center gap-3 text-xs text-ink-muted">
                <span><?= htmlspecialchars($post['date']) ?></span>
                <span class="h-1 w-1 rounded-full bg-ink-line"></span>
                <span><?= htmlspecialchars($post['read']) ?></span>
              </span>
            </span>
          </a>
        </article>
      <?php endforeach; ?>
    </div>

    <p data-collection-empty class="hidden py-16 text-center text-ink-muted">
      No posts in this category yet.
    </p>

    <!-- Load more -->
    <div class="mt-14 flex flex-col items-center gap-5">
      <p data-collection-status aria-live="polite" class="text-sm font-medium text-ink-muted"></p>

      <!-- Hidden by default: only useful once JS is running, and JS decides
           whether anything is left to load. -->
      <button type="button" data-collection-more class="btn-outline btn-lg hidden">
        Load more posts
        <span data-collection-remaining class="text-ink-muted"></span>
        <?= icon('chevron', 'h-4 w-4') ?>
      </button>
    </div>

    <!-- Newsletter -->
    <div class="reveal mt-20 overflow-hidden rounded-[2rem] bg-teal-950">
      <div class="relative grid items-center gap-10 p-10 md:grid-cols-2 md:p-14">
        <div class="absolute inset-0 fan-glow-deep"></div>

        <div class="relative">
          <span class="eyebrow eyebrow-light">Stay in touch</span>
          <h2 class="mt-5 text-display-sm text-white">Get our stories in your inbox</h2>
          <p class="mt-4 leading-relaxed text-white/70">
            Occasional updates on programmes, impact and the communities we serve. No noise.
          </p>
        </div>

        <form class="relative" data-form novalidate>
          <div class="flex flex-col gap-3 sm:flex-row">
            <input type="email" name="email" required placeholder="you@example.com"
                   class="w-full rounded-full border border-white/20 bg-white/10 px-6 py-4 text-[0.9375rem] text-white backdrop-blur-sm transition-all duration-300 placeholder:text-white/45 focus:border-ember-400 focus:bg-white/15 focus:outline-none focus:ring-4 focus:ring-ember-500/20">
            <button type="submit" class="btn-ember shrink-0">Subscribe</button>
          </div>
          <p data-form-note class="mt-4 text-sm text-white/50">We will never share your address.</p>
        </form>
      </div>
    </div>

  </div>
</section>

<?php include APP_PATH . "/views/includes/footer.php"; ?>
