<?php
$trust_items = [
  // ['shield-check', 'Fully insured'],
  ['star', '5-star rated'],
  ['heart-handshake', 'Personal touch'],
  ['badge-pound-sterling', 'No hidden fees'],
  ['clock', '24/7 support'],
  ['truck', 'UK-wide'],
];
?>
<div class="trust-strip">
  <div class="container">
    <?php foreach ($trust_items as [$ic, $label]): ?>
      <span class="trust-item"><?= il_icon($ic, 20) ?><?= $label ?></span>
    <?php endforeach; ?>
  </div>
</div>
