<?php
$page_title = 'Volunteer';
$page_meta  = "Volunteers are a vital part of our mission. Give your time, skills and passion to extend our reach.";
include APP_PATH . "/views/includes/header.php";

$hero_section   = 'settings_volunteer_hero';
$hero_crumb     = $navLabels['input_volunteer'];
$hero_text      = $volunteer_intro;
$hero_text_admc = admc_edit('settings_website_info', $site_id);
include APP_PATH . "/views/includes/partials/page-hero.php";

$why    = admc_section('settings_volunteer_why');
$roles  = admc_section('settings_volunteer_roles');
$signup = admc_section('settings_volunteer_signup');
$give   = admc_section('settings_volunteer_donate');

$whyEdit    = admc_edit('settings_volunteer_why', $why['id']);
$rolesEdit  = admc_edit('settings_volunteer_roles', $roles['id']);
$signupEdit = admc_edit('settings_volunteer_signup', $signup['id']);
?>

<!-- ===== Why volunteer ================================================ -->
<section class="section bg-white">
  <div class="container">
    <div class="grid items-center gap-12 lg:grid-cols-2">

      <div class="relative">
        <div class="reveal reveal-left media aspect-[4/5] rounded-[2.5rem] shadow-lift media-zoom" <?= admc_image('settings_volunteer_why', $why['id']) ?>>
          <img src="<?= htmlspecialchars(admc_src($why)) ?>" alt="Volunteers preparing for outreach">
        </div>
        <div class="reveal absolute -bottom-8 -right-4 rounded-3xl border border-ink-line bg-white p-6 shadow-lift sm:-right-8"
             style="--reveal-delay:220ms" <?= $whyEdit ?>>
          <div class="flex items-center gap-4">
            <span class="icon-tile bg-ember-50 text-ember-500"><?= icon('users', 'h-6 w-6') ?></span>
            <div>
              <p class="font-display text-3xl font-bold leading-none text-ink">
                <span data-count="<?= (int) $why['input_stat_value'] ?>">0</span><span class="text-ember-500"><?= htmlspecialchars($why['input_stat_suffix']) ?></span>
              </p>
              <p class="mt-1.5 text-xs font-medium uppercase tracking-wider text-ink-muted"><?= htmlspecialchars($why['input_stat_label']) ?></p>
            </div>
          </div>
        </div>
        <div class="pointer-events-none absolute -left-10 -top-10 h-40 w-40 rounded-full bg-teal-300/30 blur-3xl"></div>
      </div>

      <div class="lg:pl-4">
        <span class="eyebrow reveal" <?= $whyEdit ?>><?= htmlspecialchars($why['input_eyebrow']) ?></span>
        <h2 class="mt-6 text-display-md reveal" style="--reveal-delay:80ms" <?= $whyEdit ?>>
          <?= admc_lines($why['input_heading']) ?>
        </h2>
        <p class="mt-6 leading-relaxed text-ink-soft reveal" style="--reveal-delay:160ms" <?= admc_edit('settings_website_info', $site_id) ?>>
          <?= admc_plain($volunteer_intro) ?>
        </p>

        <div class="mt-10 space-y-4" <?= admc_list('panel_volunteer_benefits') ?>>
          <?php foreach ($volunteer_benefits as $i => $b): ?>
            <div class="reveal flex items-start gap-4 rounded-2xl border border-ink-line bg-white p-5 transition-all duration-500 ease-out-expo hover:-translate-y-0.5 hover:border-teal-200 hover:shadow-card"
                 style="--reveal-delay:<?= 200 + $i * 80 ?>ms" <?= admc_edit('panel_volunteer_benefits', $b['id'] ?? null) ?>>
              <span class="mt-0.5 grid h-9 w-9 shrink-0 place-items-center rounded-xl bg-teal-50 text-teal-600">
                <?= icon('check', 'h-4 w-4') ?>
              </span>
              <div>
                <p class="font-semibold text-ink"><?= htmlspecialchars($b['title']) ?></p>
                <p class="mt-1 text-sm leading-relaxed text-ink-soft"><?= admc_plain($b['body']) ?></p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ===== Opportunities ================================================ -->
<section class="section bg-ink-wash">
  <div class="container">

    <div class="mx-auto max-w-2xl text-center" <?= $rolesEdit ?>>
      <span class="eyebrow reveal"><?= htmlspecialchars($roles['input_eyebrow']) ?></span>
      <h2 class="mt-6 text-display-lg reveal" style="--reveal-delay:80ms"><?= admc_lines($roles['input_heading']) ?></h2>
      <p class="mt-6 text-lg leading-relaxed text-ink-soft reveal" style="--reveal-delay:160ms">
        <?= admc_plain($roles['text_intro']) ?>
      </p>
    </div>

    <div class="mt-10 grid gap-6 sm:grid-cols-2" <?= admc_list('panel_volunteer_roles') ?>>
      <?php foreach ($volunteer_roles as $i => $role): ?>
        <article class="card-hover card-rule reveal group flex items-start gap-5" style="--reveal-delay:<?= $i * 90 ?>ms" <?= admc_edit('panel_volunteer_roles', $role['id'] ?? null) ?>>
          <span class="icon-tile <?= $i % 2 ? 'bg-ember-50 text-ember-500' : 'bg-teal-50 text-teal-600' ?>">
            <?= icon($role['icon'], 'h-7 w-7') ?>
          </span>
          <div class="flex-1">
            <h3 class="font-display text-xl font-semibold text-ink"><?= htmlspecialchars($role['title']) ?></h3>
            <p class="mt-2.5 leading-relaxed text-ink-soft"><?= admc_plain($role['body']) ?></p>
            <a href="#apply" class="link-arrow mt-5" <?= $rolesEdit ?>><?= htmlspecialchars($roles['input_apply_link']) ?> <?= icon('arrow', 'h-4 w-4') ?></a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<!-- ===== Application ================================================== -->
<section id="apply" class="section bg-white">
  <div class="container">
    <div class="grid gap-10 lg:grid-cols-12 lg:gap-12">

      <div class="lg:col-span-5">
        <span class="eyebrow reveal" <?= $signupEdit ?>><?= htmlspecialchars($signup['input_eyebrow']) ?></span>
        <h2 class="mt-6 text-display-md reveal" style="--reveal-delay:80ms" <?= $signupEdit ?>>
          <?= admc_lines($signup['input_heading']) ?>
        </h2>
        <p class="mt-6 leading-relaxed text-ink-soft reveal" style="--reveal-delay:160ms" <?= $signupEdit ?>>
          <?= admc_plain($signup['text_intro']) ?>
        </p>

        <div class="mt-10 space-y-5 reveal" style="--reveal-delay:240ms" <?= admc_edit('settings_website_info', $site_id) ?>>
          <?php foreach ([
            ['mail',  $signup['input_email_label'], $site_email, 'mailto:' . $site_email],
            ['phone', $signup['input_call_label'],  $site_phone, 'tel:' . preg_replace('/\s+/', '', $site_phone)],
            ['pin',   $signup['input_visit_label'], $site_address, null],
          ] as [$ic, $label, $value, $href]): ?>
            <div class="flex items-start gap-4">
              <span class="grid h-11 w-11 shrink-0 place-items-center rounded-2xl bg-teal-50 text-teal-600">
                <?= icon($ic, 'h-5 w-5') ?>
              </span>
              <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-ink-muted" <?= $signupEdit ?>><?= htmlspecialchars($label) ?></p>
                <?php if ($href): ?>
                  <a href="<?= $href ?>" class="font-medium text-ink transition-colors hover:text-teal-700"><?= htmlspecialchars($value) ?></a>
                <?php else: ?>
                  <p class="font-medium text-ink"><?= htmlspecialchars($value) ?></p>
                <?php endif; ?>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="lg:col-span-6 lg:col-start-8">
        <form class="reveal reveal-right rounded-[2rem] border border-ink-line bg-white p-8 shadow-card md:p-10" data-form novalidate <?= $signupEdit ?>>
          <div class="grid gap-5 sm:grid-cols-2">

            <label class="block">
              <span class="mb-2 block text-sm font-semibold text-ink"><?= htmlspecialchars($signup['input_name_label']) ?></span>
              <input type="text" name="name" required placeholder="<?= htmlspecialchars($signup['input_name_placeholder']) ?>"
                     class="w-full rounded-btn border border-ink-line bg-ink-wash px-5 py-3.5 text-[0.9375rem] text-ink transition-all duration-300 placeholder:text-ink-muted/70 focus:border-teal-600 focus:bg-white focus:outline-none focus:ring-4 focus:ring-teal-600/10">
            </label>

            <label class="block">
              <span class="mb-2 block text-sm font-semibold text-ink"><?= htmlspecialchars($signup['input_email_field_label']) ?></span>
              <input type="email" name="email" required placeholder="<?= htmlspecialchars($signup['input_email_placeholder']) ?>"
                     class="w-full rounded-btn border border-ink-line bg-ink-wash px-5 py-3.5 text-[0.9375rem] text-ink transition-all duration-300 placeholder:text-ink-muted/70 focus:border-teal-600 focus:bg-white focus:outline-none focus:ring-4 focus:ring-teal-600/10">
            </label>

            <label class="block">
              <span class="mb-2 block text-sm font-semibold text-ink"><?= htmlspecialchars($signup['input_phone_field_label']) ?></span>
              <input type="tel" name="phone" placeholder="<?= htmlspecialchars($signup['input_phone_placeholder']) ?>"
                     class="w-full rounded-btn border border-ink-line bg-ink-wash px-5 py-3.5 text-[0.9375rem] text-ink transition-all duration-300 placeholder:text-ink-muted/70 focus:border-teal-600 focus:bg-white focus:outline-none focus:ring-4 focus:ring-teal-600/10">
            </label>

            <label class="block">
              <span class="mb-2 block text-sm font-semibold text-ink"><?= htmlspecialchars($signup['input_role_label']) ?></span>
              <select name="role"
                      class="w-full appearance-none rounded-btn border border-ink-line bg-ink-wash px-5 py-3.5 text-[0.9375rem] text-ink transition-all duration-300 focus:border-teal-600 focus:bg-white focus:outline-none focus:ring-4 focus:ring-teal-600/10">
                <option value=""><?= htmlspecialchars($signup['input_role_placeholder']) ?></option>
                <?php foreach ($volunteer_roles as $role): ?>
                  <option value="<?= htmlspecialchars($role['title']) ?>"><?= htmlspecialchars($role['title']) ?></option>
                <?php endforeach; ?>
              </select>
            </label>

            <label class="block sm:col-span-2">
              <span class="mb-2 block text-sm font-semibold text-ink"><?= htmlspecialchars($signup['input_message_label']) ?></span>
              <textarea name="message" rows="5" required placeholder="<?= htmlspecialchars($signup['input_message_placeholder']) ?>"
                        class="w-full resize-none rounded-btn border border-ink-line bg-ink-wash px-5 py-3.5 text-[0.9375rem] text-ink transition-all duration-300 placeholder:text-ink-muted/70 focus:border-teal-600 focus:bg-white focus:outline-none focus:ring-4 focus:ring-teal-600/10"></textarea>
            </label>

          </div>

          <button type="submit" class="btn-primary mt-7 w-full">
            <?= htmlspecialchars($signup['input_submit_button']) ?> <?= icon('arrow', 'h-4 w-4') ?>
          </button>

          <p data-form-note class="mt-4 text-sm text-ink-muted">
            <?= htmlspecialchars($signup['input_form_note']) ?>
            <a href="/privacy-policy" class="text-teal-700 underline underline-offset-4"><?= htmlspecialchars($signup['input_privacy_link']) ?></a>.
          </p>
        </form>
      </div>

    </div>
  </div>
</section>

<!-- ===== Donate =======================================================
     Bottom padding only. The application form above is also bg-white and
     already contributes its own 80px, so a full .section here stacked two
     paddings into 160px of blank white before the card. -->
<section class="bg-white pb-12 md:pb-16 lg:pb-20">
  <div class="container">
    <div class="relative overflow-hidden rounded-4xl bg-ember-grad px-7 py-12 md:px-14 md:py-14">

      <div class="pointer-events-none absolute -right-20 -top-24 h-72 w-72 rounded-full bg-white/15 blur-3xl animate-float-slow"></div>
      <div class="pointer-events-none absolute -bottom-28 -left-16 h-72 w-72 rounded-full bg-ember-700/25 blur-3xl"></div>

      <div class="relative grid gap-9 lg:grid-cols-12 lg:items-center lg:gap-10">

        <div class="lg:col-span-7" <?= admc_edit('settings_volunteer_donate', $give['id']) ?>>
          <span class="eyebrow eyebrow-light reveal"><?= htmlspecialchars($give['input_eyebrow']) ?></span>
          <h2 class="mt-5 text-display-sm text-white reveal" style="--reveal-delay:80ms">
            <?= admc_lines($give['input_heading']) ?>
          </h2>
          <p class="mt-4 max-w-xl leading-relaxed text-white/85 reveal" style="--reveal-delay:160ms">
            <?= admc_plain($give['text_intro']) ?>
          </p>
        </div>

        <div class="reveal lg:col-span-5 lg:justify-self-end" style="--reveal-delay:240ms" <?= admc_edit('settings_website_info', $site_id) ?>>
          <a href="<?= htmlspecialchars($donate['url']) ?>"
             target="_blank" rel="noopener noreferrer"
             class="btn-white btn-lg w-full sm:w-auto">
            <?= icon($donate['icon'], 'h-5 w-5') ?> <?= htmlspecialchars($donate['label']) ?>
          </a>
          <p class="mt-3.5 max-w-xs text-sm leading-snug text-white/70">
            <?= htmlspecialchars($donate['note']) ?>
          </p>
        </div>

      </div>
    </div>
  </div>
</section>

<?php include APP_PATH . "/views/includes/footer.php"; ?>
