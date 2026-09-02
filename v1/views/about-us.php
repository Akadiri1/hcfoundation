<?php
$page_title = 'About Us';
$page_meta  = "HC Foundation is a humanitarian-focused organization committed to improving lives through service, compassion, and action.";
include APP_PATH . "/views/includes/header.php";

$hero_eyebrow = 'About Us';
$hero_title   = 'Who <span class="text-gradient">We Are</span>';
$hero_text    = 'A humanitarian-focused organization committed to improving lives through service, compassion, and action.';
include APP_PATH . "/views/includes/partials/page-hero.php";
?>

<!-- ===== Story ======================================================== -->
<section class="section bg-white">
  <div class="container">
    <div class="grid items-start gap-12 lg:grid-cols-12">

      <div class="lg:col-span-5">
        <div class="lg:sticky lg:top-32">
          <div class="reveal reveal-left media aspect-[4/5] rounded-[2.5rem] shadow-lift media-zoom">
            <img src="<?= $img('photo-1517486808906-6ca8b3f04846', 900, 1120) ?>" alt="Working with the community">
          </div>
          <div class="reveal mt-6 rounded-3xl border border-ink-line bg-ink-wash p-7" style="--reveal-delay:180ms">
            <span class="text-ember-500"><?= icon('quote', 'h-7 w-7') ?></span>
            <p class="mt-4 font-display text-lg font-medium leading-relaxed text-ink">
              We work with communities to identify needs and deliver support that is
              both meaningful and sustainable.
            </p>
          </div>
        </div>
      </div>

      <div class="lg:col-span-6 lg:col-start-7">
        <span class="eyebrow reveal">Our Story</span>
        <h2 class="mt-6 text-display-md reveal" style="--reveal-delay:80ms">
          Responsibility to those we serve
        </h2>

        <div class="prose-brand mt-7 reveal" style="--reveal-delay:160ms">
          <p><?= htmlspecialchars($about_who) ?></p>
          <p><?= htmlspecialchars($about_approach) ?></p>
          <p>
            That responsibility shapes how we plan, how we spend, and how we report.
            Every programme begins with listening, and every outcome is traceable back
            to the people it was meant to serve.
          </p>
        </div>

        <!-- Vision / Mission -->
        <div class="mt-12 grid gap-5 sm:grid-cols-2">
          <div class="reveal relative overflow-hidden rounded-3xl bg-teal-grad p-8 text-white shadow-glow" style="--reveal-delay:240ms">
            <span class="pointer-events-none absolute -right-8 -top-8 h-32 w-32 rounded-full bg-white/10"></span>
            <span class="relative grid h-12 w-12 place-items-center rounded-2xl bg-white/15">
              <?= icon('star', 'h-6 w-6') ?>
            </span>
            <h3 class="relative mt-5 font-display text-xl font-bold">Our Vision</h3>
            <p class="relative mt-3 leading-relaxed text-white/80"><?= htmlspecialchars($vision) ?></p>
          </div>

          <div class="reveal relative overflow-hidden rounded-3xl bg-ember-grad p-8 text-white shadow-ember" style="--reveal-delay:320ms">
            <span class="pointer-events-none absolute -right-8 -top-8 h-32 w-32 rounded-full bg-white/10"></span>
            <span class="relative grid h-12 w-12 place-items-center rounded-2xl bg-white/15">
              <?= icon('growth', 'h-6 w-6') ?>
            </span>
            <h3 class="relative mt-5 font-display text-xl font-bold">Our Mission</h3>
            <p class="relative mt-3 leading-relaxed text-white/85"><?= htmlspecialchars($mission) ?></p>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ===== Core values ================================================== -->
<section class="section bg-ink-wash">
  <div class="container">

    <div class="mx-auto max-w-2xl text-center">
      <span class="eyebrow eyebrow-center reveal">Our Core Values</span>
      <h2 class="mt-6 text-display-lg reveal" style="--reveal-delay:80ms">
        What we hold ourselves to
      </h2>
    </div>

    <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-5">
      <?php foreach ($core_values as $i => $v): ?>
        <div class="card-hover card-rule reveal text-center" style="--reveal-delay:<?= $i * 80 ?>ms">
          <span class="icon-tile mx-auto <?= $i % 2 ? 'bg-ember-50 text-ember-500' : 'bg-teal-50 text-teal-600' ?>">
            <?= icon($v['icon'], 'h-7 w-7') ?>
          </span>
          <h3 class="mt-5 font-display text-lg font-semibold text-ink"><?= htmlspecialchars($v['title']) ?></h3>
          <p class="mt-2.5 text-sm leading-relaxed text-ink-soft"><?= htmlspecialchars($v['body']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<!-- ===== Impact band ================================================== -->
<section class="relative overflow-hidden bg-teal-950 py-12 md:py-16">
  <div class="absolute inset-0 fan-glow-deep"></div>
  <div class="container relative">
    <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
      <?php foreach ($impact_stats as $i => $stat): ?>
        <div class="reveal text-center" style="--reveal-delay:<?= $i * 90 ?>ms">
          <p class="font-display text-[3rem] font-bold leading-none text-white">
            <span data-count="<?= $stat['value'] ?>">0</span><span class="text-ember-400"><?= $stat['suffix'] ?></span>
          </p>
          <p class="mt-3 font-semibold text-white"><?= htmlspecialchars($stat['label']) ?></p>
          <p class="mt-1 text-sm text-white/55"><?= htmlspecialchars($stat['note']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ===== Approach ===================================================== -->
<section class="section bg-white">
  <div class="container">
    <div class="grid gap-10 lg:grid-cols-12">

      <div class="lg:col-span-5">
        <span class="eyebrow reveal">How We Work</span>
        <h2 class="mt-6 text-display-md reveal" style="--reveal-delay:80ms">
          Listen first. Deliver second. Report always.
        </h2>
        <p class="mt-6 leading-relaxed text-ink-soft reveal" style="--reveal-delay:160ms">
          The same three steps run through every initiative we take on, whether it
          reaches four families or four hundred.
        </p>
      </div>

      <div class="lg:col-span-6 lg:col-start-7">
        <ol class="space-y-4">
          <?php foreach ([
            ['Identify the need',   'We start in the community, not in a strategy document. Needs are surfaced by the people living them.'],
            ['Deliver the support', 'Programmes are designed around what was actually heard, and sized to what can be sustained.'],
            ['Account for it',      'Outcomes are recorded and reported. Every contribution can be traced to a result.'],
          ] as $i => [$title, $body]): ?>
            <li class="card-hover reveal flex items-start gap-6" style="--reveal-delay:<?= $i * 110 ?>ms">
              <span class="font-display text-4xl font-bold leading-none text-ink-line">0<?= $i + 1 ?></span>
              <span>
                <h3 class="font-display text-xl font-semibold text-ink"><?= $title ?></h3>
                <p class="mt-2 leading-relaxed text-ink-soft"><?= $body ?></p>
              </span>
            </li>
          <?php endforeach; ?>
        </ol>
      </div>

    </div>
  </div>
</section>

<?php include APP_PATH . "/views/includes/footer.php"; ?>
