<?php
$page        = 'quote';
$title       = 'Get a Free Moving Quote | Ingress Logistics';
$description = 'Get a free, no-obligation quote for your home or office move in minutes. Transparent pricing, 5-star service across the UK. Tell us about your move.';
$canonical   = 'https://ingresslogistics.com/quote.php';

require_once __DIR__ . '/partials/config.php';
require_once __DIR__ . '/partials/icons.php';

$floors   = ['Ground', 'First', 'Second', 'Third', 'Fourth', 'Above Fourth'];
$services = [
  'Top Tier Home Removal', 'Basic Home Removal', 'Single Item Delivery',
  'Office Relocation', 'Man & Van Service', 'Assembly & Disassembly',
];
$selected_service = $_GET['service'] ?? '';
if (!in_array($selected_service, $services, true)) $selected_service = '';

$benefits = [
  ['zap', 'Fast response', 'Most quotes sent back within a few hours during business hours.'],
  ['receipt-text', 'Transparent pricing', 'A clear breakdown with no hidden fees or surprise charges.'],
  ['shield-check', 'Comprehensive cover on every move, big or small.'],
  ['heart-handshake', 'Personal touch', 'Empathy, care and a personal touch on every job.'],
];

require __DIR__ . '/partials/head.php';
?>
<main>
  <section class="quote-hero">
    <div class="container">
      <span class="eyebrow">Free · no obligation</span>
      <h1 class="kinetic">Get your free quote</h1>
      <p>Tell us a few details about your move and we'll send a clear, transparent price — usually within a few hours. No hidden fees, ever.</p>
    </div>
  </section>

  <section class="section section--white">
    <div class="container">
      <div class="quote-grid">

        <!-- ===== Form ===== -->
        <form class="quote-form js-enquiry" id="quoteForm" data-endpoint="<?= htmlspecialchars(QUOTE_ENDPOINT) ?>" enctype="multipart/form-data" novalidate>
          <input type="hidden" name="service_line" value="removals">
          <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(il_csrf()) ?>">
          <div class="hp-field" aria-hidden="true"><label>Company<input type="text" name="company" tabindex="-1" autocomplete="off"></label></div>
          <div class="form-group">
            <div class="form-group-head"><span class="step-badge">1</span><h2>Your route</h2></div>
            <div class="form-grid">
              <div class="field">
                <label for="pickup">Pickup location</label>
                <input type="text" id="pickup" name="pickup" placeholder="Enter pickup address" autocomplete="off" data-places required>
              </div>
              <div class="field field--select">
                <label for="pickup_floor">Pickup floor</label>
                <div class="select-wrap">
                  <select id="pickup_floor" name="pickup_floor">
                    <option value="">Select floor</option>
                    <?php foreach ($floors as $f): ?><option value="<?= htmlspecialchars($f) ?>"><?= htmlspecialchars($f) ?></option><?php endforeach; ?>
                  </select>
                  <span class="select-chevron"><?= il_icon('chevron-down', 16) ?></span>
                </div>
              </div>
              <div class="field">
                <label for="delivery">Delivery location</label>
                <input type="text" id="delivery" name="delivery" placeholder="Enter delivery address" autocomplete="off" data-places required>
              </div>
              <div class="field field--select">
                <label for="delivery_floor">Delivery floor</label>
                <div class="select-wrap">
                  <select id="delivery_floor" name="delivery_floor">
                    <option value="">Select floor</option>
                    <?php foreach ($floors as $f): ?><option value="<?= htmlspecialchars($f) ?>"><?= htmlspecialchars($f) ?></option><?php endforeach; ?>
                  </select>
                  <span class="select-chevron"><?= il_icon('chevron-down', 16) ?></span>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="form-group-head"><span class="step-badge">2</span><h2>Your move</h2></div>
            <div class="form-grid">
              <div class="field field--select">
                <label for="service">Service type</label>
                <div class="select-wrap">
                  <select id="service" name="service" required>
                    <option value="">Select a service</option>
                    <?php foreach ($services as $s): ?>
                      <option value="<?= htmlspecialchars($s) ?>"<?= $s === $selected_service ? ' selected' : '' ?>><?= htmlspecialchars($s) ?></option>
                    <?php endforeach; ?>
                  </select>
                  <span class="select-chevron"><?= il_icon('chevron-down', 16) ?></span>
                </div>
              </div>
              <div class="field">
                <label for="date">Preferred date</label>
                <input type="date" id="date" name="date">
              </div>
              <div class="field col-span-2">
                <label for="details">Additional details</label>
                <textarea id="details" name="details" rows="4" placeholder="Tell us what you're moving — rough number of rooms or items, anything fragile, parking or lift access…"></textarea>
              </div>
              <div class="field col-span-2">
                <label for="photos">Photos (optional)</label>
                <input type="file" id="photos" name="photos[]" accept="image/jpeg,image/png,image/webp,image/heic" multiple>
                <p class="field-hint">Up to 3 images, 5MB each — helps us quote more accurately.</p>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="form-group-head"><span class="step-badge">3</span><h2>Your details</h2></div>
            <div class="form-grid">
              <div class="field">
                <label for="name">Your name</label>
                <input type="text" id="name" name="name" placeholder="Enter your full name" autocomplete="name" required>
              </div>
              <div class="field">
                <label for="phone">Phone number</label>
                <input type="tel" id="phone" name="phone" placeholder="07000 000000" autocomplete="tel" required>
              </div>
              <div class="field col-span-2">
                <label for="email">Email address</label>
                <input type="email" id="email" name="email" placeholder="you@email.com" autocomplete="email" required>
              </div>
            </div>
          </div>

          <div>
            <button type="submit" class="btn btn--primary btn--lg btn--full" id="quoteSubmit">Get my free quote <?= il_icon('arrow-right', 18) ?></button>
            <p class="form-fineprint">We'll never share your details. No obligation to book.</p>
          </div>
        </form>

        <!-- ===== Aside ===== -->
        <aside class="quote-aside">
          <div class="aside-dark">
            <h3>Why request a quote?</h3>
            <ul>
              <?php foreach ($benefits as [$ic, $h, $p]): ?>
                <li>
                  <span class="ad-icon"><?= il_icon($ic, 20) ?></span>
                  <span><strong><?= htmlspecialchars($h) ?></strong><span class="ad-desc"><?= htmlspecialchars($p) ?></span></span>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>

          <!-- REPLACE BEFORE LAUNCH: placeholder review -->
          <div class="aside-review">
            <?php
              $out = '<span class="stars" aria-hidden="true">';
              for ($i = 0; $i < 5; $i++) $out .= il_icon('star', 16);
              echo $out . '</span>';
            ?>
            <p>"Smooth, careful and right on time. Genuinely the easiest move we've ever had."</p>
            <div class="ar-meta"><strong style="color:var(--text-heading)">Amara O.</strong> · Maidstone, Kent</div>
          </div>

          <div class="aside-call">
            <h3>Prefer to talk it through?</h3>
            <a href="<?= SITE_PHONE_HREF ?>"><?= il_icon('phone', 18) ?><?= SITE_PHONE ?></a>
            <a href="mailto:<?= SITE_EMAIL ?>"><?= il_icon('mail', 18) ?><?= SITE_EMAIL ?></a>
            <span class="ac-hours"><?= il_icon('clock', 16) ?>24/7 support</span>
          </div>
        </aside>

      </div>
    </div>
  </section>

  <?php include __DIR__ . '/partials/trust-strip.php'; ?>
</main>

<?php include __DIR__ . '/partials/enquiry-modal.php'; ?>

<?php require __DIR__ . '/partials/footer.php'; ?>
