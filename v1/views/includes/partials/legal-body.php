<?php
/**
 * Body of a legal page (privacy policy, terms of use).
 *
 * Set before including: $legal (a settings_* row) and $legalEdit (its
 * admc_edit attributes). text_notice is the review banner; leave it empty in
 * ADMC once the text is approved and the banner disappears.
 */
?>
<section class="section bg-white">
  <div class="container">
    <div class="mx-auto max-w-3xl" <?= $legalEdit ?>>
      <?php if (trim(strip_tags((string) $legal['text_notice'])) !== ''): ?>
        <div class="reveal rounded-2xl border border-ember-200 bg-ember-50 p-6">
          <p class="text-sm font-medium text-ember-800">
            <?= admc_plain($legal['text_notice']) ?>
          </p>
        </div>
      <?php endif; ?>

      <div class="prose-brand mt-10 reveal" style="--reveal-delay:100ms">
        <?php if (trim((string) $legal['input_last_updated']) !== ''): ?>
          <p>Last updated <?= htmlspecialchars($legal['input_last_updated']) ?>.</p>
        <?php endif; ?>

        <?= admc_rich($legal['text_content']) ?>
      </div>
    </div>
  </div>
</section>
