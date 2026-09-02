<?php
$page_title = 'Our Team';
$page_meta  = "HC Foundation is led by dedicated individuals committed to service, leadership, and impact.";
include APP_PATH . "/views/includes/header.php";

$hero_eyebrow = 'HC Foundation Team';
$hero_title   = 'The people behind <span class="text-gradient">the work</span>';
$hero_text    = $team_intro;
include APP_PATH . "/views/includes/partials/page-hero.php";
?>

<?php foreach ($team_groups as $g => $group):
  $hasMembers = !empty($group['members']);
  $alt = $g % 2 === 1;
?>
<section class="section <?= $alt ? 'bg-ink-wash' : 'bg-white' ?>">
  <div class="container">

    <div class="flex flex-col gap-5 md:flex-row md:items-end md:justify-between">
      <div class="max-w-xl">
        <span class="eyebrow reveal"><?= sprintf('%02d', $g + 1) ?> — <?= htmlspecialchars($group['title']) ?></span>
        <h2 class="mt-5 text-display-md reveal" style="--reveal-delay:80ms"><?= htmlspecialchars($group['title']) ?></h2>
        <p class="mt-4 text-lg leading-relaxed text-ink-soft reveal" style="--reveal-delay:140ms">
          <?= htmlspecialchars($group['body']) ?>
        </p>
      </div>
    </div>

    <?php if ($hasMembers): ?>
      <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <?php foreach ($group['members'] as $i => $m): ?>
          <article class="reveal group overflow-hidden rounded-[1.75rem] border border-ink-line bg-white shadow-card transition-all duration-500 ease-out-expo hover:-translate-y-1.5 hover:shadow-lift"
                   style="--reveal-delay:<?= $i * 100 ?>ms">

            <div class="media media-zoom relative aspect-[4/5]">
              <img src="<?= $m['image'] ?>" alt="<?= htmlspecialchars($m['name']) ?>" loading="lazy">
              <span class="absolute inset-0 bg-gradient-to-t from-ink/80 via-transparent to-transparent opacity-0 transition-opacity duration-500 group-hover:opacity-100"></span>

              <div class="absolute inset-x-5 bottom-5 flex translate-y-3 gap-2 opacity-0 transition-all duration-500 ease-out-expo group-hover:translate-y-0 group-hover:opacity-100">
                <?php foreach (['linkedin', 'x', 'mail'] as $s): ?>
                  <a href="#" aria-label="<?= $s ?>"
                     class="grid h-9 w-9 place-items-center rounded-full bg-white/20 text-white backdrop-blur-sm transition-colors hover:bg-white hover:text-ink">
                    <?= $s === 'mail' ? icon('mail', 'h-4 w-4') : social_icon($s) ?>
                  </a>
                <?php endforeach; ?>
              </div>
            </div>

            <div class="p-6">
              <h3 class="font-display text-lg font-semibold text-ink"><?= htmlspecialchars($m['name']) ?></h3>
              <p class="mt-1 text-sm font-medium text-teal-700"><?= htmlspecialchars($m['role']) ?></p>
            </div>
          </article>
        <?php endforeach; ?>
      </div>

    <?php else: ?>
      <!-- Volunteers group: no individual profiles, so a recruitment panel instead -->
      <div class="reveal mt-12 overflow-hidden rounded-[2rem] bg-teal-grad shadow-glow">
        <div class="grid items-center gap-10 p-10 md:grid-cols-2 md:p-14">
          <div>
            <h3 class="font-display text-display-sm text-white">Could your name be here?</h3>
            <p class="mt-4 leading-relaxed text-white/75">
              Our volunteers are the heart of every outreach and initiative we run.
              There is room for your time, your skill and your presence.
            </p>
            <a href="/volunteer" class="btn-ember mt-8">
              Join the team <?= icon('arrow', 'h-4 w-4') ?>
            </a>
          </div>

          <div class="flex justify-center md:justify-end">
            <div class="relative">
              <span class="absolute inset-0 animate-pulse-ring rounded-full bg-white/25"></span>
              <span class="relative grid h-32 w-32 place-items-center rounded-full bg-white/15 text-white backdrop-blur-sm">
                <?= icon('users', 'h-14 w-14') ?>
              </span>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>

  </div>
</section>
<?php endforeach; ?>

<?php include APP_PATH . "/views/includes/footer.php"; ?>
