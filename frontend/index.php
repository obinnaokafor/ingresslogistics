<?php
$page        = 'home';
$title       = 'Ingress Logistics — Move Anything, Anywhere | UK Removals';
$description = 'Home & office removals across the UK from our base in Kent. Unbeatable prices, 5-star service, no hidden fees. Get your free quote today.';
$canonical   = 'https://ingresslogistics.com/';

require_once __DIR__ . '/partials/config.php';
require_once __DIR__ . '/partials/icons.php';

function il_stars($n = 5) {
  $out = '<span class="stars" aria-hidden="true">';
  for ($i = 0; $i < $n; $i++) $out .= il_icon('star', 16);
  return $out . '</span>';
}

$service_categories = [
  ['truck', 'Home Removals & Relocations', 'Professional house moves, apartment relocations, office moves and packing services.', 'home-removals.php'],
  ['package', 'Storage Solutions', 'Secure short-term and long-term storage for households, businesses and students.', 'storage.php'],
  ['truck', 'Waste Removal', 'Fast, affordable waste collection, rubbish clearance and house clearances.', 'waste-removal.php'],
  ['home', 'Decluttering & Reorganisation', 'Helping you create organised, functional and stress-free living spaces.', 'decluttering.php'],
];

$steps = [
  ['clipboard-list', 'Tell us about your move', "Share pickup, destination and what you're moving. Takes two minutes — no obligation, no hidden fees."],
  ['calendar-check', 'We plan & confirm', 'You get a clear, transparent quote and a date that suits you. We bring the boxes, materials and the right team.'],
  ['truck', 'Red carpet move day', 'We pack, lift, transport and place everything with care — on time, treated like a VIP.'],
];

$why_points = [
  ['Red carpet experience', 'Every client treated like a VIP, from a single item to a full office.'],
  ['Empathy & integrity', "A personal touch in an industry that's often rushed and transactional."],
  ['Reliable & punctual', 'On time, every time — we respect your schedule and your move day.'],
  ['Extra care', 'Fragile and valuable items handled as if they were our own.'],
  ['Transparent pricing', 'A clear quote with no surprises — just honesty.'],
];
$stats = [['200+', 'moves completed'], ['5.0★', 'average rating'], ['24/7', 'support']];

$testimonials = [
  ['Excellent communication and delivery 👏🏽 👌. From 1st enquiry call to delivery. I fully recommend and will definitely use their services going forward', 'Emma Ajibola', '', ''],
  ['I cannot recommend Ingress Logistics highly enough. From the very first conversation, Rita is absolutely adorable. So personable, considerate and genuinely attentive to our situation. Moving can seem like juggling glass, but they handled everything with calm assurance and real care.', 'Cynthia Johnson', '', 'Home Removal'],
  ['We use Victor to help move the inventory of our home staging business. He’s very reliable, helpful and great value for money. We would highly recommend!', 'Emily C.', '', ''],
];

$values = ['Excellence', 'Trust', 'Care', 'Innovation', 'Empowerment'];

$faqs = [
  ['What areas do you cover?', "We're based in Kent but proudly serve clients across the UK. Whether you're moving locally or long-distance, we've got you covered."],
  ['How do I get a quote?', 'Simple — click "Get a free quote", fill in a few details, and we\'ll provide a clear, transparent price with no hidden fees.'],
  ['Do you provide packing materials?', 'Yes. We offer high-quality boxes, bubble wrap and other materials, and can handle all the packing for you with our Top Tier service.'],
  // ['Will my belongings be insured?', 'Absolutely. Your items are fully insured while in our care — extra peace of mind on moving day.'],
  ['Can you handle fragile or valuable items?', 'Yes. From antiques to pianos, our team has the training and equipment to safely handle delicate, oversized or valuable items.'],
  ['What makes Ingress Logistics different?', "We're not just movers — we're your moving partners. We bring professionalism, empathy and a personal touch to every job."],
];

/* FAQPage structured data */
$faq_entities = array_map(function ($f) {
  return [
    '@type' => 'Question',
    'name' => $f[0],
    'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f[1]],
  ];
}, $faqs);
$page_jsonld = '<script type="application/ld+json">'
  . json_encode(['@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => $faq_entities], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
  . '</script>';

require __DIR__ . '/partials/head.php';
?>
<main>

  <!-- ===================== HERO (split) ===================== -->
  <section class="hero">
    <div class="hero-glow" aria-hidden="true"></div>
    <div class="hero-split">
      <div class="hero-copy">
        <span class="eyebrow">Kent &amp; London · move, store &amp; clear</span>
        <h1 class="kinetic">Reliable home removals, storage &amp; waste clearance across Kent &amp; Greater London</h1>
        <p class="hero-sub"><strong>Move Anything, Anywhere.</strong> Professional removals, secure storage, waste clearance and decluttering — unbeatable prices, 5-star service, every job treated to the red carpet experience.</p>
        <div class="hero-actions">
          <a href="quote.php" class="btn btn--primary btn--lg">Get a quote <?= il_icon('arrow-right', 18) ?></a>
          <a href="<?= SITE_PHONE_HREF ?>" class="btn btn--secondary btn--lg"><?= il_icon('phone', 17) ?> Call now</a>
        </div>
        <!-- REPLACE BEFORE LAUNCH: placeholder rating -->
        <!-- <div class="hero-rating">
          <?= il_stars() ?>
          <span class="rating-score">5/5</span>
          <span class="rating-meta">from 100+ happy movers</span>
        </div> -->
      </div>

      <div class="hero-media">
        <!-- <div class="placeholder"><span><?= il_icon('truck', 14) ?>moving team · van loading</span></div> -->
         <img src="/images/about-image.jpeg" alt="Home Image" class="hero-image" />
        <!-- REPLACE BEFORE LAUNCH: placeholder review -->
        <!-- <div class="float-card float-insured">
          <span class="fc-icon"><?= il_icon('shield-check', 22) ?></span>
          <span>
            <span class="fc-title">Fully insured</span>
            <span class="fc-sub">Cover on every move</span>
          </span>
        </div> -->
        <div class="float-card float-review">
          <div class="fc-head"><?= il_stars() ?><span class="score">5.0</span></div>
          <p>"Reliable, always friendly and nothing is too much trouble." — <strong>Nicola, Kent</strong></p>
        </div>
      </div>
    </div>

    <div class="hero-bullets-wrap">
      <div class="hero-bullets">
        <?php foreach (['No hidden fees', 'On time, every time'] as $b): ?>
          <span class="bullet"><span class="bullet-dot"><?= il_icon('check', 13) ?></span><?= $b ?></span>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <?php include __DIR__ . '/partials/trust-strip.php'; ?>

  <!-- ===================== SERVICES PREVIEW ===================== -->
  <section id="services" class="section section--white">
    <div class="container">
      <div class="section-heading">
        <span class="eyebrow">What we do</span>
        <h2>One team for every job</h2>
        <p class="lead">From a full home removal to secure storage, waste clearance and decluttering — all across Kent &amp; London, all with the red carpet treatment.</p>
      </div>
      <div class="grid grid--cards mt-8">
        <?php foreach ($service_categories as [$ic, $t, $d, $href]): ?>
          <a class="service-card" href="<?= $href ?>">
            <span class="service-icon"><?= il_icon($ic, 28) ?></span>
            <h3><?= htmlspecialchars($t) ?></h3>
            <p><?= htmlspecialchars($d) ?></p>
          </a>
        <?php endforeach; ?>
      </div>
      <div class="center-row mt-8">
        <a href="services.php" class="btn btn--outline btn--lg">View all services <?= il_icon('arrow-right', 18) ?></a>
      </div>
    </div>
  </section>

  <!-- ===================== HOW IT WORKS ===================== -->
  <section id="how" class="section section--page">
    <div class="container">
      <div class="section-heading">
        <span class="eyebrow">Simple &amp; stress-free</span>
        <h2>How it works</h2>
        <p class="lead">Three easy steps from first enquiry to the keys in your new door.</p>
      </div>
      <div class="grid step-cards mt-8" style="grid-template-columns: repeat(3, 1fr);">
        <?php foreach ($steps as $i => [$ic, $t, $d]): ?>
          <div class="step-card">
            <div class="step-num"><?= str_pad($i + 1, 2, '0', STR_PAD_LEFT) ?></div>
            <div class="step-icon"><?= il_icon($ic, 28) ?></div>
            <h3><?= htmlspecialchars($t) ?></h3>
            <p><?= htmlspecialchars($d) ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- ===================== WHY US (dark) ===================== -->
  <section id="why" class="section section--dark">
    <div class="container">
      <div class="split-2">
        <div>
          <div class="section-heading section-heading--ondark is-left">
            <span class="eyebrow eyebrow--ondark">The difference</span>
            <h2>Why choose Ingress Logistics?</h2>
          </div>
          <p class="whyus-intro">We're more than just movers. We treat your belongings — and your peace of mind — with the utmost care, from house moves to office relocations, delicate antiques to bulky furniture.</p>
          <p class="whyus-intro whyus-intro--muted">We bring empathy and integrity to every job. With us, you'll never feel like just another booking.</p>
          <!-- REPLACE BEFORE LAUNCH: placeholder stats -->
          <div class="stat-grid">
            <?php foreach ($stats as [$n, $l]): ?>
              <div class="stat"><div class="stat-num"><?= $n ?></div><div class="stat-label"><?= $l ?></div></div>
            <?php endforeach; ?>
          </div>
        </div>
        <ul class="why-points">
          <?php foreach ($why_points as [$h, $p]): ?>
            <li>
              <span class="why-check"><?= il_icon('check', 18) ?></span>
              <span><strong><?= htmlspecialchars($h) ?></strong><span class="why-desc"><?= htmlspecialchars($p) ?></span></span>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </section>

  <!-- ===================== TESTIMONIALS ===================== -->
  <!-- REPLACE BEFORE LAUNCH: placeholder testimonials -->
  <section class="section section--white">
    <div class="container">
      <div class="section-heading">
        <span class="eyebrow">Loved by movers</span>
        <h2>What our customers say</h2>
        <p class="lead">Real words from real moves across Kent and the UK.</p>
      </div>
      <div class="grid grid--cards mt-8">
        <?php foreach ($testimonials as [$q, $name, $loc, $svc]): ?>
          <figure class="testimonial">
            <?= il_stars() ?>
            <blockquote>"<?= htmlspecialchars($q) ?>"</blockquote>
            <figcaption>
              <span class="avatar"><?= htmlspecialchars($name[0]) ?></span>
              <span>
                <span class="t-name"><?= htmlspecialchars($name) ?></span>
                <span class="t-meta"><?= htmlspecialchars($loc) ?> · <?= htmlspecialchars($svc) ?></span>
              </span>
            </figcaption>
          </figure>
        <?php endforeach; ?>
      </div>
      <!-- Live Google reviews appear here once Trustindex is connected -->
      <div class="mt-8"><?php include __DIR__ . '/partials/reviews.php'; ?></div>
    </div>
  </section>

  <!-- ===================== ABOUT TEASER ===================== -->
  <section id="about" class="section section--page">
    <div class="container">
      <div class="about-grid">
        <div class="about-media">
          <div class="about-image">
            <img src="/images/home-image1.jpg" alt="About Image" />
          </div>
          <div class="about-float">
            <span class="fc-icon"><?= il_icon('heart-handshake', 24) ?></span>
            <div>
              <div class="fc-title">Proudly independent</div>
              <div class="fc-sub">Born in Kent, built on care</div>
            </div>
          </div>
        </div>
        <div class="about-body">
          <span class="eyebrow">Our story</span>
          <h2 class="kinetic">Moving should feel exciting, not stressful</h2>
          <p class="about-lead">At Ingress Logistics, moving isn't just about boxes and vans — it's about people, trust and new beginnings. Our founder saw how overwhelming moving could be for families, professionals and businesses, and set out to change that by combining efficiency, professionalism and a touch of luxury.</p>
          <div class="mv-grid">
            <div class="mv-card"><h3>Our mission</h3><p>To make moving seamless, stress-free and special — every service delivered with a red carpet touch.</p></div>
            <div class="mv-card"><h3>Our vision</h3><p>To redefine moving in the UK as the most trusted, reliable and customer-focused logistics company.</p></div>
          </div>
          <div class="value-chips">
            <?php foreach ($values as $v): ?>
              <span class="value-chip"><span class="dot"></span><?= htmlspecialchars($v) ?></span>
            <?php endforeach; ?>
          </div>
          <a href="quote.php" class="btn btn--primary btn--lg">Start your move <?= il_icon('arrow-right', 18) ?></a>
        </div>
      </div>
    </div>
  </section>

  <!-- ===================== FAQ ===================== -->
  <section id="faq" class="section section--white">
    <div class="container">
      <div class="faq-grid">
        <div class="faq-aside">
          <span class="eyebrow">Good to know</span>
          <h2>Frequently asked questions</h2>
          <p>Can't find what you're looking for? Our team is happy to help — just give us a call or drop us a line.</p>
          <div class="contact-links">
            <a class="contact-link" href="<?= SITE_PHONE_HREF ?>"><?= il_icon('phone', 18) ?><?= SITE_PHONE ?></a>
            <a class="contact-link" href="mailto:<?= SITE_EMAIL ?>"><?= il_icon('mail', 18) ?><?= SITE_EMAIL ?></a>
          </div>
        </div>
        <div class="faq-list">
          <?php foreach ($faqs as $i => [$q, $a]): ?>
            <div class="faq-item<?= $i === 0 ? ' is-open' : '' ?>">
              <button class="faq-q" aria-expanded="<?= $i === 0 ? 'true' : 'false' ?>">
                <span><?= htmlspecialchars($q) ?></span>
                <span class="faq-chevron"><?= il_icon('chevron-down', 18) ?></span>
              </button>
              <div class="faq-a"><?= htmlspecialchars($a) ?></div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

</main>

<?php
include __DIR__ . '/partials/closing-cta.php';
require __DIR__ . '/partials/footer.php';
