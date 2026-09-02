<?php
$page_title = 'Volunteer';
$page_meta  = "Volunteers are a vital part of our mission. Give your time, skills and passion to extend our reach.";
include APP_PATH . "/views/includes/header.php";

$hero_eyebrow = 'Volunteer';
$hero_title   = 'Volunteer with <span class="text-gradient">HC Foundation</span>';
$hero_text    = $volunteer_intro;
include APP_PATH . "/views/includes/partials/page-hero.php";
?>

<!-- ===== Why volunteer ================================================ -->
<section class="section bg-white">
  <div class="container">
    <div class="grid items-center gap-16 lg:grid-cols-2">

      <div class="relative">
        <div class="reveal reveal-left media aspect-[4/5] rounded-[2.5rem] shadow-lift media-zoom">
          <img src="<?= $img('photo-1531482615713-2afd69097998', 900, 1120) ?>" alt="Volunteers preparing for outreach">
        </div>
        <div class="reveal absolute -bottom-8 -right-4 rounded-3xl border border-ink-line bg-white p-6 shadow-lift sm:-right-8"
             style="--reveal-delay:220ms">
          <div class="flex items-center gap-4">
            <span class="icon-tile bg-ember-50 text-ember-500"><?= icon('users', 'h-6 w-6') ?></span>
            <div>
              <p class="font-display text-3xl font-bold leading-none text-ink">
                <span data-count="300">0</span><span class="text-ember-500">+</span>
              </p>
              <p class="mt-1.5 text-xs font-medium uppercase tracking-wider text-ink-muted">Active volunteers</p>
            </div>
          </div>
        </div>
        <div class="pointer-events-none absolute -left-10 -top-10 h-40 w-40 rounded-full bg-teal-300/30 blur-3xl"></div>
      </div>

      <div class="lg:pl-4">
        <span class="eyebrow reveal">Why Volunteer with Us?</span>
        <h2 class="mt-6 text-display-md reveal" style="--reveal-delay:80ms">
          Your time is the resource we cannot buy
        </h2>
        <p class="mt-6 leading-relaxed text-ink-soft reveal" style="--reveal-delay:160ms">
          <?= htmlspecialchars($volunteer_intro) ?>
        </p>

        <div class="mt-10 space-y-4">
          <?php foreach ($volunteer_benefits as $i => $b): ?>
            <div class="reveal flex items-start gap-4 rounded-2xl border border-ink-line bg-white p-5 transition-all duration-500 ease-out-expo hover:-translate-y-0.5 hover:border-teal-200 hover:shadow-card"
                 style="--reveal-delay:<?= 200 + $i * 80 ?>ms">
              <span class="mt-0.5 grid h-9 w-9 shrink-0 place-items-center rounded-xl bg-teal-50 text-teal-600">
                <?= icon('check', 'h-4 w-4') ?>
              </span>
              <div>
                <p class="font-semibold text-ink"><?= htmlspecialchars($b['title']) ?></p>
                <p class="mt-1 text-sm leading-relaxed text-ink-soft"><?= htmlspecialchars($b['body']) ?></p>
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

    <div class="mx-auto max-w-2xl text-center">
      <span class="eyebrow eyebrow-center reveal">Volunteer Opportunities</span>
      <h2 class="mt-6 text-display-lg reveal" style="--reveal-delay:80ms">Where you could fit</h2>
      <p class="mt-6 text-lg leading-relaxed text-ink-soft reveal" style="--reveal-delay:160ms">
        Four ways to contribute. Tell us which sounds like you and we will take it from there.
      </p>
    </div>

    <div class="mt-16 grid gap-6 sm:grid-cols-2">
      <?php foreach ($volunteer_roles as $i => $role): ?>
        <article class="card-hover card-rule reveal group flex items-start gap-5" style="--reveal-delay:<?= $i * 90 ?>ms">
          <span class="icon-tile <?= $i % 2 ? 'bg-ember-50 text-ember-500' : 'bg-teal-50 text-teal-600' ?>">
            <?= icon($role['icon'], 'h-7 w-7') ?>
          </span>
          <div class="flex-1">
            <h3 class="font-display text-xl font-semibold text-ink"><?= htmlspecialchars($role['title']) ?></h3>
            <p class="mt-2.5 leading-relaxed text-ink-soft"><?= htmlspecialchars($role['body']) ?></p>
            <a href="#apply" class="link-arrow mt-5">Apply for this <?= icon('arrow', 'h-4 w-4') ?></a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<!-- ===== Application ================================================== -->
<section id="apply" class="section bg-white">
  <div class="container">
    <div class="grid gap-14 lg:grid-cols-12 lg:gap-16">

      <div class="lg:col-span-5">
        <span class="eyebrow reveal">Sign Up</span>
        <h2 class="mt-6 text-display-md reveal" style="--reveal-delay:80ms">
          Tell us how you would like to help
        </h2>
        <p class="mt-6 leading-relaxed text-ink-soft reveal" style="--reveal-delay:160ms">
          Fill in the form and a member of the team will be in touch within two
          working days to talk through where you might fit.
        </p>

        <div class="mt-10 space-y-5 reveal" style="--reveal-delay:240ms">
          <?php foreach ([
            ['mail',  'Email us',  $site_email, 'mailto:' . $site_email],
            ['phone', 'Call us',   $site_phone, 'tel:' . preg_replace('/\s+/', '', $site_phone)],
            ['pin',   'Visit us',  $site_address, null],
          ] as [$ic, $label, $value, $href]): ?>
            <div class="flex items-start gap-4">
              <span class="grid h-11 w-11 shrink-0 place-items-center rounded-2xl bg-teal-50 text-teal-600">
                <?= icon($ic, 'h-5 w-5') ?>
              </span>
              <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-ink-muted"><?= $label ?></p>
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
        <form class="reveal reveal-right rounded-[2rem] border border-ink-line bg-white p-8 shadow-card md:p-10" data-form novalidate>
          <div class="grid gap-5 sm:grid-cols-2">

            <label class="block">
              <span class="mb-2 block text-sm font-semibold text-ink">Full name</span>
              <input type="text" name="name" required placeholder="Your full name"
                     class="w-full rounded-2xl border border-ink-line bg-ink-wash px-5 py-3.5 text-[0.9375rem] text-ink transition-all duration-300 placeholder:text-ink-muted/70 focus:border-teal-600 focus:bg-white focus:outline-none focus:ring-4 focus:ring-teal-600/10">
            </label>

            <label class="block">
              <span class="mb-2 block text-sm font-semibold text-ink">Email address</span>
              <input type="email" name="email" required placeholder="you@example.com"
                     class="w-full rounded-2xl border border-ink-line bg-ink-wash px-5 py-3.5 text-[0.9375rem] text-ink transition-all duration-300 placeholder:text-ink-muted/70 focus:border-teal-600 focus:bg-white focus:outline-none focus:ring-4 focus:ring-teal-600/10">
            </label>

            <label class="block">
              <span class="mb-2 block text-sm font-semibold text-ink">Phone number</span>
              <input type="tel" name="phone" placeholder="+234 …"
                     class="w-full rounded-2xl border border-ink-line bg-ink-wash px-5 py-3.5 text-[0.9375rem] text-ink transition-all duration-300 placeholder:text-ink-muted/70 focus:border-teal-600 focus:bg-white focus:outline-none focus:ring-4 focus:ring-teal-600/10">
            </label>

            <label class="block">
              <span class="mb-2 block text-sm font-semibold text-ink">Preferred role</span>
              <select name="role"
                      class="w-full appearance-none rounded-2xl border border-ink-line bg-ink-wash px-5 py-3.5 text-[0.9375rem] text-ink transition-all duration-300 focus:border-teal-600 focus:bg-white focus:outline-none focus:ring-4 focus:ring-teal-600/10">
                <option value="">Select an area</option>
                <?php foreach ($volunteer_roles as $role): ?>
                  <option value="<?= htmlspecialchars($role['title']) ?>"><?= htmlspecialchars($role['title']) ?></option>
                <?php endforeach; ?>
              </select>
            </label>

            <label class="block sm:col-span-2">
              <span class="mb-2 block text-sm font-semibold text-ink">Why do you want to volunteer?</span>
              <textarea name="message" rows="5" required placeholder="Tell us a little about yourself and what you would like to contribute."
                        class="w-full resize-none rounded-2xl border border-ink-line bg-ink-wash px-5 py-3.5 text-[0.9375rem] text-ink transition-all duration-300 placeholder:text-ink-muted/70 focus:border-teal-600 focus:bg-white focus:outline-none focus:ring-4 focus:ring-teal-600/10"></textarea>
            </label>

          </div>

          <button type="submit" class="btn-primary mt-7 w-full">
            Submit application <?= icon('arrow', 'h-4 w-4') ?>
          </button>

          <p data-form-note class="mt-4 text-sm text-ink-muted">
            We will never share your details. Read our
            <a href="/privacy-policy" class="text-teal-700 underline underline-offset-4">privacy policy</a>.
          </p>
        </form>
      </div>

    </div>
  </div>
</section>

<?php include APP_PATH . "/views/includes/footer.php"; ?>
