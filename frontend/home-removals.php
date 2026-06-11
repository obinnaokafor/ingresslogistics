<?php
$page        = 'removals';
$title       = 'Home Removals Kent & London | House Movers — Ingress Logistics';
$description = 'Professional home removals across Kent and London. House moves, apartment relocations, office moves and packing — fully insured, no hidden fees. Free quote.';
$canonical   = 'https://ingresslogistics.com/home-removals.php';

require_once __DIR__ . '/partials/config.php';
require_once __DIR__ . '/partials/icons.php';

$services = [
  ['truck', 'Top Tier Home Removal', 'Most popular', 'Our full white-glove service — we arrive with everything and handle the whole move, room to room.',
    ['Packing materials & boxes', 'Full packing & unpacking', 'Loading, transport & placement', 'Fully insured']],
  ['home', 'Basic Home Removal', null, 'You pack, we do the heavy lifting. Ideal when you want to save by boxing up yourself.',
    ['Careful loading & transport', 'Furniture placement', 'Trained, friendly movers', 'Fully insured']],
  ['user-round-cog', 'Man & Van Service', 'Best value', 'A budget-friendly driver-and-van option where you lend a hand loading and unloading.',
    ['Driver & van', 'Help loading & unloading', 'Flexible timing', 'Fully insured']],
  ['package', 'Single Item Delivery', null, 'Just bought a sofa, fridge or wardrobe? We collect and deliver it straight to your door.',
    ['Collection & delivery', 'Careful handling', 'Doorstep placement', 'Fully insured']],
  ['wrench', 'Assembly & Disassembly', null, 'Flat-pack and furniture taken apart at pickup and rebuilt at your new place.',
    ['Disassembly at pickup', 'Reassembly at destination', 'Tools & expertise', 'Fixings carefully managed']],
  ['building-2', 'Office Relocation', null, 'Move your business with minimal downtime — planned around your schedule.',
    ['Out-of-hours moves', 'IT & equipment care', 'Labelled & organised', 'Set-up at the new site']],
];

$always = [
  ['shield-check', 'Fully insured', 'Comprehensive cover on every move, big or small.'],
  ['badge-pound-sterling', 'No hidden fees', 'A clear, transparent quote — the price we agree is the price you pay.'],
  ['heart-handshake', 'Extra care', 'Fragile and valuable items handled as if they were our own.'],
  ['clock', 'On time, every time', 'We respect your schedule and turn up when we say we will.'],
];

$page_jsonld = '<script type="application/ld+json">' . json_encode([
  '@context' => 'https://schema.org', '@type' => 'Service',
  'serviceType' => 'Home removals', 'provider' => ['@type' => 'MovingCompany', 'name' => SITE_NAME],
  'areaServed' => ['Kent', 'London', 'Gravesend', 'United Kingdom'],
  'description' => 'Professional home and office removals, packing and relocation services across Kent and London.',
  'url' => $canonical,
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>'
. '<script type="application/ld+json">' . json_encode([
  '@context' => 'https://schema.org', '@type' => 'BreadcrumbList',
  'itemListElement' => [
    ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => SITE_URL],
    ['@type' => 'ListItem', 'position' => 2, 'name' => 'Services', 'item' => SITE_URL . 'services.php'],
    ['@type' => 'ListItem', 'position' => 3, 'name' => 'Home Removals', 'item' => $canonical],
  ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';

require __DIR__ . '/partials/head.php';
?>
<main>
  <section class="services-hero">
    <div class="container">
      <span class="eyebrow">Home removals · Kent &amp; London</span>
      <h1 class="kinetic">Home removals in Kent &amp; London, the red carpet way</h1>
      <p>House moves, apartment relocations, office moves and packing — from a single item to a full home. Choose the level of service that fits your move, all fully insured with no hidden fees.</p>
      <div class="hero-actions">
        <a href="quote.php" class="btn btn--primary btn--lg">Get your free quote <?= il_icon('arrow-right', 18) ?></a>
        <a href="<?= SITE_PHONE_HREF ?>" class="btn btn--secondary btn--lg"><?= il_icon('phone', 17) ?> Call now</a>
      </div>
    </div>
  </section>

  <section class="section section--white">
    <div class="container">
      <div class="grid grid--cards-wide">
        <?php foreach ($services as [$ic, $t, $tag, $d, $included]): ?>
          <article class="service-detail">
            <div class="service-detail-top">
              <div class="service-detail-icon"><?= il_icon($ic, 28) ?></div>
              <?php if ($tag): ?><span class="badge badge--blue-subtle"><?= htmlspecialchars($tag) ?></span><?php endif; ?>
            </div>
            <div>
              <h2 style="font-size:var(--text-lg)"><?= htmlspecialchars($t) ?></h2>
              <p><?= htmlspecialchars($d) ?></p>
            </div>
            <div class="divider"></div>
            <ul>
              <?php foreach ($included as $it): ?>
                <li><span class="check-dot"><?= il_icon('check', 12) ?></span><?= htmlspecialchars($it) ?></li>
              <?php endforeach; ?>
            </ul>
            <a href="quote.php?service=<?= urlencode($t) ?>" class="btn btn--outline btn--full">Get a quote <?= il_icon('arrow-right', 17) ?></a>
          </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="section section--page">
    <div class="container">
      <div class="section-heading">
        <span class="eyebrow">With every move</span>
        <h2>What's always included</h2>
        <p class="lead">No matter which option you choose, these come as standard.</p>
      </div>
      <div class="grid grid--cards-sm mt-8">
        <?php foreach ($always as [$ic, $h, $p]): ?>
          <div class="reassure-card">
            <div class="step-icon"><?= il_icon($ic, 24) ?></div>
            <h3><?= htmlspecialchars($h) ?></h3>
            <p><?= htmlspecialchars($p) ?></p>
          </div>
        <?php endforeach; ?>
      </div>
      <p class="always-note">Every quote is tailored to your move — distance, volume and access all factored in, with no surprises. Serving Kent, London and across the UK.</p>
    </div>
  </section>
</main>

<?php
include __DIR__ . '/partials/closing-cta.php';
require __DIR__ . '/partials/footer.php';
