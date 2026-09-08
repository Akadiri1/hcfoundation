<?php
$page_title = 'Privacy Policy';
$page_meta  = "How HC Foundation collects, uses and protects your personal information.";
include APP_PATH . "/views/includes/header.php";

$hero_eyebrow = 'Legal';
$hero_title   = 'Privacy <span class="text-gradient">Policy</span>';
$hero_text    = 'How we collect, use and protect the information you share with us.';
include APP_PATH . "/views/includes/partials/page-hero.php";
?>

<section class="section bg-white">
  <div class="container">
    <div class="mx-auto max-w-3xl">
      <div class="reveal rounded-2xl border border-ember-200 bg-ember-50 p-6">
        <p class="text-sm font-medium text-ember-800">
          Placeholder text. This policy must be reviewed and approved before launch.
          The site collects names, email addresses and phone numbers through two forms,
          which brings it under NDPR.
        </p>
      </div>

      <div class="prose-brand mt-10 reveal" style="--reveal-delay:100ms">
        <p>Last updated <?= date('F Y') ?>.</p>

        <h2>What we collect</h2>
        <p>
          When you contact us or apply to volunteer, we collect the details you choose
          to give us: your name, email address, phone number and the content of your
          message. We do not collect payment information.
        </p>

        <h2>How we use it</h2>
        <ul>
          <li>To respond to your enquiry or volunteer application</li>
          <li>To keep you updated about the work you asked to hear about</li>
          <li>To meet our record-keeping and reporting obligations</li>
        </ul>

        <h2>Who we share it with</h2>
        <p>
          We do not sell your information, and we do not share it with third parties for
          marketing. We share it only where required by law, or with service providers
          who process it on our behalf under equivalent obligations.
        </p>

        <h2>How long we keep it</h2>
        <p>
          We keep enquiry and volunteer records for as long as needed for the purpose
          they were given, and then delete them.
        </p>

        <h2>Your rights</h2>
        <p>
          You may ask us for a copy of the information we hold about you, ask us to
          correct it, or ask us to delete it. Write to
          <a href="mailto:<?= htmlspecialchars($site_email) ?>"><?= htmlspecialchars($site_email) ?></a>
          and we will respond within a reasonable period.
        </p>

        <h2>Cookies</h2>
        <p>
          This site uses only the cookies needed to keep it working. We will update this
          section if analytics or embedded media are added.
        </p>

        <h2>Contact</h2>
        <p>
          Questions about this policy can go to
          <a href="mailto:<?= htmlspecialchars($site_email) ?>"><?= htmlspecialchars($site_email) ?></a>
          or <?= htmlspecialchars($site_address) ?>.
        </p>
      </div>
    </div>
  </div>
</section>

<?php include APP_PATH . "/views/includes/footer.php"; ?>
