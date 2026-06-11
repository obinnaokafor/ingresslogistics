<?php
$page        = 'contact';
$title       = 'Contact Us | Ingress Logistics — Kent & London';
$description = 'Get in touch with Ingress Logistics for removals, storage, waste clearance or decluttering across Kent and London. Call, email or send an enquiry — 24/7 support.';
$canonical   = 'https://ingresslogistics.com/contact.php';

require_once __DIR__ . '/partials/config.php';
require_once __DIR__ . '/partials/icons.php';
require_once __DIR__ . '/partials/enquiry-form.php';

$enquiry = [
  'line'   => 'contact',
  'submit' => 'Send enquiry',
  'note'   => "We'll get back to you as soon as we can — usually within a few hours.",
  'fields' => [
    ['type'=>'select','name'=>'service','label'=>'What can we help with?','required'=>true,'placeholder'=>'Select a service',
      'options'=>['Home removals','Storage','Waste removal','Decluttering','Something else']],
    ['type'=>'text','name'=>'location','label'=>'Your area / postcode','placeholder'=>'e.g. Gravesend, DA11'],
    ['type'=>'text','name'=>'name','label'=>'Your name','placeholder'=>'Enter your full name','required'=>true,'autocomplete'=>'name'],
    ['type'=>'tel','name'=>'phone','label'=>'Phone number','placeholder'=>'07000 000000','required'=>true,'autocomplete'=>'tel'],
    ['type'=>'email','name'=>'email','label'=>'Email address','placeholder'=>'you@email.com','required'=>true,'col'=>'full','autocomplete'=>'email'],
    ['type'=>'textarea','name'=>'message','label'=>'Your message','placeholder'=>'Tell us a little about what you need…','required'=>true,'col'=>'full'],
  ],
];

require __DIR__ . '/partials/head.php';
?>
<main>
  <section class="quote-hero">
    <div class="container">
      <span class="eyebrow">Get in touch</span>
      <h1 class="kinetic">Contact Ingress Logistics</h1>
      <p>Questions, quotes or bookings for removals, storage, waste clearance or decluttering across Kent &amp; London — we're here to help, 24/7.</p>
    </div>
  </section>

  <section class="section section--white">
    <div class="container">
      <div class="quote-grid">
        <div>
          <div class="section-heading is-left">
            <span class="eyebrow">Send a message</span>
            <h2>How can we help?</h2>
            <p class="lead">Fill in the form and we'll be in touch shortly — or call us right now.</p>
          </div>
          <div style="margin-top: var(--space-6)"><?php il_enquiry_form($enquiry); ?></div>
        </div>

        <aside class="quote-aside">
          <div class="aside-call">
            <h3>Talk to us directly</h3>
            <a href="<?= SITE_PHONE_HREF ?>"><?= il_icon('phone', 18) ?><?= SITE_PHONE ?></a>
            <a href="mailto:<?= SITE_EMAIL ?>"><?= il_icon('mail', 18) ?><?= SITE_EMAIL ?></a>
            <span class="ac-hours"><?= il_icon('map-pin', 16) ?>Based in Kent · serving Kent &amp; London</span>
            <span class="ac-hours"><?= il_icon('clock', 16) ?>24/7 support</span>
          </div>

          <!-- Google Maps embed.
               TO FINISH: replace the q= value below with your verified Google Business
               Profile address or Place ID (Maps > Share > Embed a map) for directions + local SEO. -->
          <div class="map-embed">
            <iframe
              title="Ingress Logistics service area — Kent &amp; London"
              src="https://www.google.com/maps?q=Gravesend,+Kent,+United+Kingdom&output=embed"
              loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>

          <!-- Trustindex reviews slot -->
          <?php include __DIR__ . '/partials/reviews.php'; ?>
        </aside>
      </div>
    </div>
  </section>
</main>

<?php
include __DIR__ . '/partials/closing-cta.php';
include __DIR__ . '/partials/enquiry-modal.php';
require __DIR__ . '/partials/footer.php';
