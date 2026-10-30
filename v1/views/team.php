<?php
$page_title = 'Our Team';
$page_meta  = "HC Foundation is led by dedicated individuals committed to service, leadership, and impact.";
include APP_PATH . "/views/includes/header.php";

$hero_section   = 'settings_team_hero';
$hero_crumb     = $navLabels['input_team'];
$hero_text      = $team_intro;
$hero_text_admc = admc_edit('settings_website_info', $site_id);
include APP_PATH . "/views/includes/partials/page-hero.php";

$recruit = admc_section('settings_team_recruit');
?>

<?php foreach ($team_groups as $g => $group):
  $hasMembers = !empty($group['members']);
  $alt = $g % 2 === 1;
  $groupEdit = admc_edit('panel_team_groups', $group['id'] ?? null);
?>
<section class="section <?= $alt ? 'bg-ink-wash' : 'bg-white' ?>" <?= $g === 0 ? admc_list('panel_team_groups') : '' ?>>
  <div class="container">

    <div class="flex flex-col gap-5 md:flex-row md:items-end md:justify-between">
      <div class="max-w-xl" <?= $groupEdit ?>>
        <span class="eyebrow reveal"><?= sprintf('%02d', $g + 1) ?> — <?= htmlspecialchars($group['title']) ?></span>
        <h2 class="mt-5 text-display-md reveal" style="--reveal-delay:80ms"><?= htmlspecialchars($group['title']) ?></h2>
        <p class="mt-4 text-lg leading-relaxed text-ink-soft reveal" style="--reveal-delay:140ms">
          <?= admc_plain($group['body']) ?>
        </p>
      </div>
    </div>

    <?php if ($hasMembers): ?>
      <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3" <?= admc_list('panel_team') ?>>
        <?php foreach ($group['members'] as $i => $m):
          $socials = array_filter([
            'linkedin' => $m['linkedin'] ?? '',
            'x'        => $m['x'] ?? '',
            'mail'     => !empty($m['email']) ? 'mailto:' . $m['email'] : '',
          ]);
        ?>
          <article class="reveal group overflow-hidden rounded-[1.75rem] border border-ink-line bg-white shadow-card transition-all duration-500 ease-out-expo hover:-translate-y-1.5 hover:shadow-lift"
                   style="--reveal-delay:<?= $i * 100 ?>ms">

            <div class="media media-zoom relative aspect-[4/5]" <?= admc_image('panel_team', $m['id'] ?? null) ?>>
              <img src="<?= $m['image'] ?>" alt="<?= htmlspecialchars($m['name']) ?>" loading="lazy">
              <span class="absolute inset-0 bg-gradient-to-t from-ink/80 via-transparent to-transparent opacity-0 transition-opacity duration-500 group-hover:opacity-100"></span>

              <?php if ($socials): ?>
                <!-- Social links show only once filled in (input_linkedin / input_x / input_email). -->
                <div class="absolute inset-x-5 bottom-5 flex translate-y-3 gap-2 opacity-0 transition-all duration-500 ease-out-expo group-hover:translate-y-0 group-hover:opacity-100">
                  <?php foreach ($socials as $s => $href): ?>
                    <a href="<?= htmlspecialchars($href) ?>" aria-label="<?= $s ?>" <?= $s === 'mail' ? '' : 'target="_blank" rel="noopener noreferrer"' ?>
                       class="grid h-9 w-9 place-items-center rounded-full bg-white/20 text-white backdrop-blur-sm transition-colors hover:bg-white hover:text-ink">
                      <?= $s === 'mail' ? icon('mail', 'h-4 w-4') : social_icon($s) ?>
                    </a>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>
            </div>

            <div class="p-6" <?= admc_edit('panel_team', $m['id'] ?? null) ?>>
              <h3 class="font-display text-lg font-semibold text-ink"><?= htmlspecialchars($m['name']) ?></h3>
              <p class="mt-1 text-sm font-medium text-teal-700"><?= htmlspecialchars($m['role']) ?></p>
            </div>
          </article>
        <?php endforeach; ?>
      </div>

    <?php else: ?>
      <!-- Group with no individual profiles: a recruitment panel instead -->
      <div class="reveal mt-10 overflow-hidden rounded-[2rem] bg-teal-grad shadow-glow">
        <div class="grid items-center gap-10 p-10 md:grid-cols-2 md:p-14">
          <div <?= admc_edit('settings_team_recruit', $recruit['id']) ?>>
            <h3 class="font-display text-display-sm text-white"><?= admc_lines($recruit['input_heading']) ?></h3>
            <p class="mt-4 leading-relaxed text-white/75">
              <?= admc_plain($recruit['text_intro']) ?>
            </p>
            <a href="/volunteer" class="btn-ember mt-8">
              <?= htmlspecialchars($recruit['input_button']) ?> <?= icon('arrow', 'h-4 w-4') ?>
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
