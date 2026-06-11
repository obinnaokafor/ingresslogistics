<?php
require_once __DIR__ . '/config.php';
$closing_flat = $closing_flat ?? false;
?>
<section class="closing-cta<?= $closing_flat ? ' is-flat' : '' ?>" aria-label="Get a quote">
  <div class="dot-overlay" aria-hidden="true"></div>
  <div class="container">
    <div class="closing-copy">
      <p class="ds-display ds-kinetic closing-title">Not just a moving company.<br>A Red Carpet Experience.</p>
      <p class="closing-sub">Tell us what you're moving and we'll send a clear, no-obligation quote — usually within a few hours.</p>
    </div>
    <div class="closing-actions">
      <a href="quote.php" class="btn btn--primary btn--lg">Get your free quote <?= il_icon('arrow-right', 18) ?></a>
      <a href="<?= SITE_PHONE_HREF ?>" class="btn btn--lg btn--on-dark"><?= il_icon('phone', 17) ?> Call us</a>
    </div>
  </div>
</section>
