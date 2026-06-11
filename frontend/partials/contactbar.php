<?php require_once __DIR__ . '/config.php'; ?>
<div class="contactbar">
  <div class="container">
    <span class="contactbar-left">
      <?= il_icon('map-pin', 15) ?>
      Based in Kent · serving Kent, London &amp; the UK
    </span>
    <div class="contactbar-right">
      <a href="mailto:<?= SITE_EMAIL ?>"><?= il_icon('mail', 15) ?><?= SITE_EMAIL ?></a>
      <a href="<?= SITE_PHONE_HREF ?>" class="is-strong"><?= il_icon('phone', 15) ?><?= SITE_PHONE ?></a>
    </div>
  </div>
</div>
