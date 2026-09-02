</main>

<!-- ===== Pre-footer CTA =============================================== -->
<section class="relative overflow-hidden bg-teal-950">
  <div class="absolute inset-0 fan-glow-deep"></div>
  <div class="absolute inset-0 grid-lines opacity-[0.35]"></div>
  <div class="pointer-events-none absolute -right-24 -top-24 h-96 w-96 rounded-full bg-ember-500/20 blur-3xl animate-float-slow"></div>
  <div class="pointer-events-none absolute -bottom-32 -left-20 h-96 w-96 rounded-full bg-teal-400/20 blur-3xl"></div>

  <div class="container relative section-tight">
    <div class="mx-auto max-w-3xl text-center">
      <span class="eyebrow eyebrow-light eyebrow-center reveal">Get Involved</span>
      <h2 class="mt-6 text-display-lg text-white reveal" style="--reveal-delay:80ms">
        There is a place for you<br class="hidden sm:block"> in the work we do.
      </h2>
      <p class="mx-auto mt-6 max-w-xl text-lg leading-relaxed text-white/70 reveal" style="--reveal-delay:160ms">
        Whether through volunteering, partnerships, or advocacy — your time and skill
        extend how far this work can reach.
      </p>
      <div class="mt-10 flex flex-wrap justify-center gap-4 reveal" style="--reveal-delay:240ms">
        <a href="/volunteer" class="btn-ember btn-lg">
          Become a volunteer <?= icon('arrow', 'h-4 w-4') ?>
        </a>
        <a href="/contact-us" class="btn-ghost-light btn-lg">Partner with us</a>
      </div>
    </div>
  </div>
</section>

<!-- ===== Footer ======================================================= -->
<footer class="bg-ink text-white/70">
  <div class="container">

    <div class="grid gap-14 py-16 lg:grid-cols-12 lg:gap-10 lg:py-20">

      <div class="lg:col-span-4">
        <?= logo_lockup('light') ?>
        <p class="mt-6 max-w-sm leading-relaxed">
          <?= htmlspecialchars($site_tagline) ?>
          A humanitarian organisation working with communities to deliver support
          that is meaningful and sustainable.
        </p>

        <div class="mt-7 flex gap-2.5">
          <?php foreach ($socialLinks as $s): ?>
            <a href="<?= $s['url'] ?>" aria-label="<?= $s['name'] ?>"
               class="grid h-10 w-10 place-items-center rounded-full border border-white/15 transition-all duration-300 hover:-translate-y-0.5 hover:border-ember-500 hover:bg-ember-500 hover:text-white">
              <?= social_icon($s['icon']) ?>
            </a>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Three even columns spanning to the right edge -->
      <div class="grid gap-10 sm:grid-cols-3 lg:col-span-7 lg:col-start-6">

        <div>
          <h3 class="font-display text-sm font-semibold uppercase tracking-[0.14em] text-white">Explore</h3>
          <ul class="mt-6 space-y-3.5 text-[0.9375rem]">
            <?php foreach ([
              'Home' => '/home', 'About' => '/about-us', 'Initiatives' => '/initiatives', 'Volunteer' => '/volunteer',
            ] as $label => $href): ?>
              <li><a href="<?= $href ?>" class="transition-colors duration-300 hover:text-white"><?= $label ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>

        <div>
          <h3 class="font-display text-sm font-semibold uppercase tracking-[0.14em] text-white">More</h3>
          <ul class="mt-6 space-y-3.5 text-[0.9375rem]">
            <?php foreach ([
              'Our Team' => '/team', 'Gallery' => '/gallery', 'Blog' => '/blog', 'Contact' => '/contact-us',
            ] as $label => $href): ?>
              <li><a href="<?= $href ?>" class="transition-colors duration-300 hover:text-white"><?= $label ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>

        <div>
          <h3 class="font-display text-sm font-semibold uppercase tracking-[0.14em] text-white">Get in touch</h3>
          <ul class="mt-6 space-y-4 text-[0.9375rem]">
            <li>
              <a href="mailto:<?= htmlspecialchars($site_email) ?>" class="flex items-start gap-3 transition-colors duration-300 hover:text-white">
                <span class="mt-0.5 text-ember-400"><?= icon('mail', 'h-[18px] w-[18px]') ?></span>
                <?= htmlspecialchars($site_email) ?>
              </a>
            </li>
            <li>
              <a href="tel:<?= preg_replace('/\s+/', '', $site_phone) ?>" class="flex items-start gap-3 transition-colors duration-300 hover:text-white">
                <span class="mt-0.5 text-ember-400"><?= icon('phone', 'h-[18px] w-[18px]') ?></span>
                <?= htmlspecialchars($site_phone) ?>
              </a>
            </li>
            <li class="flex items-start gap-3">
              <span class="mt-0.5 text-ember-400"><?= icon('pin', 'h-[18px] w-[18px]') ?></span>
              <?= htmlspecialchars($site_address) ?>
            </li>
          </ul>
        </div>

      </div><!-- /column group -->

    </div>

    <div class="flex flex-col-reverse items-center justify-between gap-4 border-t border-white/10 py-7 text-sm sm:flex-row">
      <p>&copy; <?= date('Y') ?> <?= htmlspecialchars($site_name) ?>. All rights reserved.</p>
      <div class="flex items-center gap-6">
        <a href="/privacy-policy" class="transition-colors duration-300 hover:text-white">Privacy Policy</a>
        <a href="/terms-of-use" class="transition-colors duration-300 hover:text-white">Terms of Use</a>
      </div>
    </div>

  </div>
</footer>

<!-- Back to top -->
<button type="button" data-to-top
        class="fixed bottom-7 right-7 z-40 grid h-12 w-12 translate-y-4 place-items-center rounded-full bg-teal-600 text-white opacity-0 shadow-glow transition-all duration-500 ease-out-expo hover:bg-teal-700"
        aria-label="Back to top">
  <?= icon('arrow', 'h-5 w-5 -rotate-90') ?>
</button>

<script src="/assets/js/app.js" defer></script>
</body>
</html>
