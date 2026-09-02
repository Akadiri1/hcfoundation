<?php
$page_title = 'Gallery';
$page_meta  = "A visual reflection of our work, our people, and the communities we serve.";
include APP_PATH . "/views/includes/header.php";

$hero_eyebrow = 'Gallery';
$hero_title   = 'Moments That <span class="text-gradient">Matter</span>';
$hero_text    = 'A visual reflection of our work, our people, and the communities we serve.';
include APP_PATH . "/views/includes/partials/page-hero.php";

// Repeating span pattern so the grid does not read as a uniform block.
$span_cycle = ['lg:row-span-2', '', '', 'lg:row-span-2', '', '', 'lg:row-span-2', ''];
?>

<section class="section bg-white" data-collection data-page-size="8" data-step="8">
  <div class="container">

    <!-- Filters -->
    <div class="flex flex-wrap justify-center gap-3 reveal" data-collection-filters>
      <button type="button" data-filter="all" aria-pressed="true"
              class="chip border-teal-600 bg-teal-600 text-white">
        All
      </button>
      <?php foreach ($gallery_categories as $cat): ?>
        <button type="button" data-filter="<?= htmlspecialchars($cat) ?>" aria-pressed="false"
                class="chip border-ink-line text-ink-soft hover:border-teal-600 hover:text-teal-700">
          <?= htmlspecialchars($cat) ?>
        </button>
      <?php endforeach; ?>
    </div>

    <!-- Grid -->
    <div class="mt-10 grid auto-rows-[240px] gap-5 sm:grid-cols-2 lg:grid-cols-3" data-collection-grid>
      <?php foreach ($gallery_items as $i => $item): ?>
        <button type="button"
                data-filter-item="<?= htmlspecialchars($item['category']) ?>"
                data-lightbox="<?= $item['image'] ?>"
                data-caption="<?= htmlspecialchars($item['caption']) ?>"
                data-alt="<?= htmlspecialchars($item['caption']) ?>"
                class="reveal reveal-scale group media media-zoom relative overflow-hidden rounded-[1.5rem] shadow-card transition-all duration-500 ease-out-expo hover:shadow-lift <?= $span_cycle[$i % count($span_cycle)] ?>"
                style="--reveal-delay:<?= min($i, 6) * 70 ?>ms">

          <img src="<?= $item['image'] ?>" alt="<?= htmlspecialchars($item['caption']) ?>" loading="lazy">

          <span class="absolute inset-0 bg-gradient-to-t from-ink/85 via-ink/10 to-transparent opacity-0 transition-opacity duration-500 group-hover:opacity-100"></span>

          <span class="absolute inset-x-5 bottom-5 translate-y-3 text-left opacity-0 transition-all duration-500 ease-out-expo group-hover:translate-y-0 group-hover:opacity-100">
            <span class="block text-xs font-semibold uppercase tracking-wider text-ember-300"><?= htmlspecialchars($item['category']) ?></span>
            <span class="mt-1.5 block font-display text-lg font-semibold text-white"><?= htmlspecialchars($item['caption']) ?></span>
          </span>

          <span class="absolute right-5 top-5 grid h-10 w-10 scale-75 place-items-center rounded-full bg-white/20 text-white opacity-0 backdrop-blur-sm transition-all duration-500 ease-spring group-hover:scale-100 group-hover:opacity-100">
            <?= icon('plus', 'h-4 w-4') ?>
          </span>
        </button>
      <?php endforeach; ?>
    </div>

    <p data-collection-empty class="hidden py-12 text-center text-ink-muted">
      Nothing in this category yet.
    </p>

    <!-- Load more -->
    <div class="mt-10 flex flex-col items-center gap-5">
      <p data-collection-status aria-live="polite" class="text-sm font-medium text-ink-muted"></p>

      <!-- Hidden by default: only useful once JS is running, and JS decides
           whether anything is left to load. -->
      <button type="button" data-collection-more class="btn-outline btn-lg hidden">
        Load more photos
        <span data-collection-remaining class="text-ink-muted"></span>
        <?= icon('chevron', 'h-4 w-4') ?>
      </button>
    </div>

    <p class="mt-10 text-center text-sm text-ink-muted">
      Photography shown is placeholder imagery pending the Foundation's own archive.
    </p>

  </div>
</section>

<?php include APP_PATH . "/views/includes/footer.php"; ?>
