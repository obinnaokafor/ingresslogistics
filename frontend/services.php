<?php
$page        = 'services';
$title       = 'Our Services — Removals, Storage, Waste & Decluttering | Kent & London';
$description = 'Home removals, secure storage, waste clearance and professional decluttering across Kent and London. One trusted team.';
$canonical   = 'https://ingresslogistics.com/services.php';

require_once __DIR__ . '/partials/config.php';
require_once __DIR__ . '/partials/icons.php';

$lines = [
  ['truck', 'Home Removals & Relocations', 'Professional house moves, apartment relocations, office moves and packing services.',
    ['Top tier & basic home removal', 'Man & van', 'Single item delivery', 'Office relocation'], 'home-removals.php'],
  ['package', 'Storage Solutions', 'Secure short-term and long-term storage for households and businesses.',
    ['Household storage', 'Business storage', 'Student storage', 'Temporary storage during moves'], 'storage.php'],
  ['truck', 'Waste Removal', 'Fast and affordable waste collection and disposal services.',
    ['Household & garden waste', 'Furniture disposal', 'Garage clearances', 'Construction waste'], 'waste-removal.php'],
  ['home', 'Decluttering & Home Reorganisation', 'Helping homeowners create organised, functional and stress-free living spaces.',
    ['Wardrobe & kitchen organisation', 'Moving preparation', 'Downsizing support', 'Home reorganisation'], 'decluttering.php'],
];

require __DIR__ . '/partials/head.php';
?>
<main>
  <section class="services-hero">
    <div class="container">
      <span class="eyebrow">Our services · Kent &amp; London</span>
      <h1 class="kinetic">Everything you need to move, store &amp; clear</h1>
      <p>From a full home removal to secure storage, waste clearance and professional decluttering — one trusted team, every job treated to the red carpet experience.</p>
      <div class="hero-actions">
        <a href="quote.php" class="btn btn--primary btn--lg">Get your free quote <?= il_icon('arrow-right', 18) ?></a>
        <a href="<?= SITE_PHONE_HREF ?>" class="btn btn--secondary btn--lg"><?= il_icon('phone', 17) ?> Call now</a>
      </div>
    </div>
  </section>

  <section class="section section--white">
    <div class="container">
      <div class="grid grid--cards-wide">
        <?php foreach ($lines as [$ic, $title_, $desc, $subs, $href]): ?>
          <article class="service-detail">
            <div class="service-detail-top">
              <div class="service-detail-icon"><?= il_icon($ic, 28) ?></div>
            </div>
            <div>
              <h2 style="font-size:var(--text-lg)"><?= htmlspecialchars($title_) ?></h2>
              <p><?= htmlspecialchars($desc) ?></p>
            </div>
            <div class="divider"></div>
            <ul>
              <?php foreach ($subs as $s): ?>
                <li><span class="check-dot"><?= il_icon('check', 12) ?></span><?= htmlspecialchars($s) ?></li>
              <?php endforeach; ?>
            </ul>
            <a href="<?= $href ?>" class="btn btn--outline btn--full">Explore <?= il_icon('arrow-right', 17) ?></a>
          </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
</main>

<?php
include __DIR__ . '/partials/closing-cta.php';
require __DIR__ . '/partials/footer.php';
