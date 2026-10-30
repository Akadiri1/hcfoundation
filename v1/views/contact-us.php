<?php
$page_title = 'Contact';
$page_meta  = "Get in touch with HC Foundation. We would love to hear from you.";
include APP_PATH . "/views/includes/header.php";

$hero_section = 'settings_contact_hero';
$hero_crumb   = $navLabels['input_contact'];
include APP_PATH . "/views/includes/partials/page-hero.php";

$contact     = admc_section('settings_contact_page');
$contactEdit = admc_edit('settings_contact_page', $contact['id']);
$siteEdit    = admc_edit('settings_website_info', $site_id);
?>

<!-- ===== Contact cards + form ========================================= -->
<section class="section bg-white">
  <div class="container">

    <div class="grid gap-6 md:grid-cols-3">
      <?php foreach ([
        ['mail',  $contact['input_email_label'],   $site_email,   'mailto:' . $site_email,                         $contact['input_email_note']],
        ['phone', $contact['input_phone_label'],   $site_phone,   'tel:' . preg_replace('/\s+/', '', $site_phone), $contact['input_phone_note']],
        ['pin',   $contact['input_address_label'], $site_address, null,                                             $contact['input_address_note']],
      ] as $i => [$ic, $label, $value, $href, $note]): ?>
        <div class="card-hover card-rule reveal" style="--reveal-delay:<?= $i * 90 ?>ms">
          <span class="icon-tile <?= $i === 1 ? 'bg-ember-50 text-ember-500' : 'bg-teal-50 text-teal-600' ?>">
            <?= icon($ic, 'h-7 w-7') ?>
          </span>
          <h2 class="mt-5 font-display text-lg font-semibold text-ink" <?= $contactEdit ?>><?= htmlspecialchars($label) ?></h2>
          <?php if ($href): ?>
            <a href="<?= $href ?>" class="mt-2 block text-[0.9375rem] font-medium text-teal-700 transition-colors hover:text-ember-500" <?= $siteEdit ?>>
              <?= htmlspecialchars($value) ?>
            </a>
          <?php else: ?>
            <p class="mt-2 text-[0.9375rem] font-medium text-ink" <?= $siteEdit ?>><?= htmlspecialchars($value) ?></p>
          <?php endif; ?>
          <p class="mt-3 text-sm text-ink-muted" <?= $contactEdit ?>><?= htmlspecialchars($note) ?></p>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="mt-10 grid gap-10 lg:grid-cols-12 lg:gap-12">

      <!-- Form -->
      <div class="lg:col-span-7">
        <span class="eyebrow reveal" <?= $contactEdit ?>><?= htmlspecialchars($contact['input_form_eyebrow']) ?></span>
        <h2 class="mt-6 text-display-md reveal" style="--reveal-delay:80ms" <?= $contactEdit ?>>
          <?= admc_lines($contact['input_form_heading']) ?>
        </h2>

        <form class="reveal mt-10 rounded-[2rem] border border-ink-line bg-white p-8 shadow-card md:p-10"
              style="--reveal-delay:160ms" data-form novalidate <?= $contactEdit ?>>
          <div class="grid gap-5 sm:grid-cols-2">

            <label class="block">
              <span class="mb-2 block text-sm font-semibold text-ink"><?= htmlspecialchars($contact['input_name_label']) ?></span>
              <input type="text" name="name" required placeholder="<?= htmlspecialchars($contact['input_name_placeholder']) ?>"
                     class="w-full rounded-btn border border-ink-line bg-ink-wash px-5 py-3.5 text-[0.9375rem] text-ink transition-all duration-300 placeholder:text-ink-muted/70 focus:border-teal-600 focus:bg-white focus:outline-none focus:ring-4 focus:ring-teal-600/10">
            </label>

            <label class="block">
              <span class="mb-2 block text-sm font-semibold text-ink"><?= htmlspecialchars($contact['input_email_field_label']) ?></span>
              <input type="email" name="email" required placeholder="<?= htmlspecialchars($contact['input_email_placeholder']) ?>"
                     class="w-full rounded-btn border border-ink-line bg-ink-wash px-5 py-3.5 text-[0.9375rem] text-ink transition-all duration-300 placeholder:text-ink-muted/70 focus:border-teal-600 focus:bg-white focus:outline-none focus:ring-4 focus:ring-teal-600/10">
            </label>

            <label class="block sm:col-span-2">
              <span class="mb-2 block text-sm font-semibold text-ink"><?= htmlspecialchars($contact['input_subject_label']) ?></span>
              <input type="text" name="subject" required placeholder="<?= htmlspecialchars($contact['input_subject_placeholder']) ?>"
                     class="w-full rounded-btn border border-ink-line bg-ink-wash px-5 py-3.5 text-[0.9375rem] text-ink transition-all duration-300 placeholder:text-ink-muted/70 focus:border-teal-600 focus:bg-white focus:outline-none focus:ring-4 focus:ring-teal-600/10">
            </label>

            <label class="block sm:col-span-2">
              <span class="mb-2 block text-sm font-semibold text-ink"><?= htmlspecialchars($contact['input_message_label']) ?></span>
              <textarea name="message" rows="6" required placeholder="<?= htmlspecialchars($contact['input_message_placeholder']) ?>"
                        class="w-full resize-none rounded-btn border border-ink-line bg-ink-wash px-5 py-3.5 text-[0.9375rem] text-ink transition-all duration-300 placeholder:text-ink-muted/70 focus:border-teal-600 focus:bg-white focus:outline-none focus:ring-4 focus:ring-teal-600/10"></textarea>
            </label>

          </div>

          <button type="submit" class="btn-primary mt-7 w-full sm:w-auto">
            <?= htmlspecialchars($contact['input_submit_button']) ?> <?= icon('arrow', 'h-4 w-4') ?>
          </button>

          <p data-form-note class="mt-4 text-sm text-ink-muted">
            <?= htmlspecialchars($contact['input_form_note']) ?>
            <a href="/privacy-policy" class="text-teal-700 underline underline-offset-4"><?= htmlspecialchars($contact['input_privacy_link']) ?></a>.
          </p>
        </form>
      </div>

      <!-- FAQ -->
      <div class="lg:col-span-5">
        <span class="eyebrow reveal" <?= $contactEdit ?>><?= htmlspecialchars($contact['input_faq_eyebrow']) ?></span>
        <h2 class="mt-6 text-display-md reveal" style="--reveal-delay:80ms" <?= $contactEdit ?>><?= admc_lines($contact['input_faq_heading']) ?></h2>

        <div class="mt-10 space-y-3" data-accordion <?= admc_list('panel_faqs') ?>>
          <?php foreach ($faqs as $i => $f): ?>
            <div data-acc-item
                 <?= admc_edit('panel_faqs', $f['id'] ?? null) ?>
                 class="reveal overflow-hidden rounded-2xl border border-ink-line bg-white transition-all duration-400 [&.is-open]:border-teal-200 [&.is-open]:shadow-card"
                 style="--reveal-delay:<?= 140 + $i * 80 ?>ms">

              <button type="button" data-acc-trigger aria-expanded="false"
                      class="group flex w-full items-center justify-between gap-5 px-6 py-5 text-left">
                <span class="font-display text-[1.0625rem] font-semibold text-ink"><?= htmlspecialchars($f['q']) ?></span>
                <span class="grid h-8 w-8 shrink-0 place-items-center rounded-full bg-ink-wash text-teal-600 transition-all duration-400 group-aria-expanded:bg-teal-600 group-aria-expanded:text-white group-aria-expanded:rotate-180">
                  <?= icon('chevron', 'h-4 w-4') ?>
                </span>
              </button>

              <div data-acc-panel class="max-h-0 overflow-hidden transition-[max-height] duration-500 ease-out-expo">
                <p class="px-6 pb-6 leading-relaxed text-ink-soft"><?= admc_plain($f['a']) ?></p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <div class="reveal mt-8 rounded-3xl bg-teal-grad p-8 text-white shadow-glow">
          <div <?= $contactEdit ?>>
            <h3 class="font-display text-xl font-bold"><?= admc_lines($contact['input_call_heading']) ?></h3>
            <p class="mt-3 leading-relaxed text-white/80">
              <?= admc_plain($contact['text_call_intro']) ?>
            </p>
          </div>
          <a href="tel:<?= preg_replace('/\s+/', '', $site_phone) ?>"
             class="btn mt-6 bg-white text-teal-700 hover:bg-white/90" <?= $siteEdit ?>>
            <?= icon('phone', 'h-4 w-4') ?> <?= htmlspecialchars($site_phone) ?>
          </a>
        </div>
      </div>

    </div>
  </div>
</section>

<?php include APP_PATH . "/views/includes/footer.php"; ?>
