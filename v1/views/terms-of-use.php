<?php
$page_title = 'Terms of Use';
$page_meta  = "The terms that apply when you use the HC Foundation website.";
include APP_PATH . "/views/includes/header.php";

$hero_eyebrow = 'Legal';
$hero_title   = 'Terms of <span class="text-gradient">Use</span>';
$hero_text    = 'The terms that apply when you use this website.';
include APP_PATH . "/views/includes/partials/page-hero.php";
?>

<section class="section bg-white">
  <div class="container">
    <div class="mx-auto max-w-3xl">
      <div class="reveal rounded-2xl border border-ember-200 bg-ember-50 p-6">
        <p class="text-sm font-medium text-ember-800">
          Placeholder text. These terms must be reviewed and approved before launch.
        </p>
      </div>

      <div class="prose-brand mt-10 reveal" style="--reveal-delay:100ms">
        <p>Last updated <?= date('F Y') ?>.</p>

        <h2>Using this site</h2>
        <p>
          By using this website you agree to these terms. If you do not agree with them,
          please do not use the site.
        </p>

        <h2>Our content</h2>
        <p>
          The text, images, logos and design on this site belong to
          <?= htmlspecialchars($site_name) ?> unless stated otherwise. You may read and
          share our content with attribution, but you may not republish it as your own
          or use it commercially without written permission.
        </p>

        <h2>Your submissions</h2>
        <p>
          When you send us a message or a volunteer application, you confirm that the
          information you give is accurate and that you have the right to share it.
        </p>

        <h2>Accuracy</h2>
        <p>
          We keep this site as accurate and current as we can, but we do not guarantee
          that every page is complete or error-free at all times.
        </p>

        <h2>External links</h2>
        <p>
          Where we link to other websites, we are not responsible for their content or
          their privacy practices.
        </p>

        <h2>Changes</h2>
        <p>
          We may update these terms. The date above shows when they were last revised.
        </p>

        <h2>Contact</h2>
        <p>
          Questions can go to
          <a href="mailto:<?= htmlspecialchars($site_email) ?>"><?= htmlspecialchars($site_email) ?></a>.
        </p>
      </div>
    </div>
  </div>
</section>

<?php include APP_PATH . "/views/includes/footer.php"; ?>
