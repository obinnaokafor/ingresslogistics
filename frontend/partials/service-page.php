<?php
/**
 * Shared template for a single service line (storage / waste / decluttering).
 * The including page sets: $page, $title, $description, $canonical, $page_jsonld,
 * and the content arrays: $hero (eyebrow,h1,intro), $subs ([icon,name,desc]),
 * $enquiry (config for il_enquiry_form), $form_heading, $form_intro.
 */
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/icons.php';
require_once __DIR__ . '/enquiry-form.php';

require __DIR__ . '/head.php';
?>
<main>
  <section class="services-hero">
    <div class="container">
      <span class="eyebrow"><?= htmlspecialchars($hero['eyebrow']) ?></span>
      <h1 class="kinetic"><?= htmlspecialchars($hero['h1']) ?></h1>
      <p><?= htmlspecialchars($hero['intro']) ?></p>
      <div class="hero-actions">
        <a href="#enquire" class="btn btn--primary btn--lg">Enquire now <?= il_icon('arrow-right', 18) ?></a>
        <a href="<?= SITE_PHONE_HREF ?>" class="btn btn--secondary btn--lg"><?= il_icon('phone', 17) ?> Call <?= SITE_PHONE ?></a>
      </div>
    </div>
  </section>

  <section class="section section--white">
    <div class="container">
      <div class="section-heading">
        <span class="eyebrow">What we offer</span>
        <h2><?= htmlspecialchars($hero['subs_title'] ?? 'Our services') ?></h2>
        <?php if (!empty($hero['subs_lead'])): ?><p class="lead"><?= htmlspecialchars($hero['subs_lead']) ?></p><?php endif; ?>
      </div>
      <div class="grid grid--cards mt-8">
        <?php foreach ($subs as [$ic, $name, $desc]): ?>
          <div class="reassure-card">
            <div class="step-icon"><?= il_icon($ic, 24) ?></div>
            <h3><?= htmlspecialchars($name) ?></h3>
            <p><?= htmlspecialchars($desc) ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section id="enquire" class="section section--page">
    <div class="container">
      <div class="quote-grid">
        <div>
          <div class="section-heading is-left">
            <span class="eyebrow"><?= htmlspecialchars($form_heading_eyebrow ?? 'Get in touch') ?></span>
            <h2><?= htmlspecialchars($form_heading ?? 'Request a free quote') ?></h2>
            <?php if (!empty($form_intro)): ?><p class="lead"><?= htmlspecialchars($form_intro) ?></p><?php endif; ?>
          </div>
          <div style="margin-top: var(--space-6)">
            <?php il_enquiry_form($enquiry); ?>
          </div>
        </div>

        <aside class="quote-aside">
          <div class="aside-call">
            <h3>Prefer to talk it through?</h3>
            <a href="<?= SITE_PHONE_HREF ?>"><?= il_icon('phone', 18) ?><?= SITE_PHONE ?></a>
            <a href="mailto:<?= SITE_EMAIL ?>"><?= il_icon('mail', 18) ?><?= SITE_EMAIL ?></a>
            <span class="ac-hours"><?= il_icon('clock', 16) ?>24/7 support · Kent &amp; London</span>
          </div>
          <div class="aside-dark">
            <h3>Why choose us?</h3>
            <ul>
              <!-- <li><span class="ad-icon"><?= il_icon('shield-check', 20) ?></span><span><strong>Fully insured</strong><span class="ad-desc">Comprehensive cover on every job, big or small.</span></span></li> -->
              <li><span class="ad-icon"><?= il_icon('badge-pound-sterling', 20) ?></span><span><strong>No hidden fees</strong><span class="ad-desc">A clear, transparent quote with no surprises.</span></span></li>
              <li><span class="ad-icon"><?= il_icon('heart-handshake', 20) ?></span><span><strong>Personal touch</strong><span class="ad-desc">Empathy, care and a personal touch every time.</span></span></li>
            </ul>
          </div>
          <!-- Trustindex reviews slot -->
          <?php include __DIR__ . '/reviews.php'; ?>
        </aside>
      </div>
    </div>
  </section>
</main>

<?php
include __DIR__ . '/closing-cta.php';
include __DIR__ . '/enquiry-modal.php';
require __DIR__ . '/footer.php';
