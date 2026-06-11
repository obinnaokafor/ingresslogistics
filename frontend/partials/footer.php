<?php
require_once __DIR__ . '/config.php';

$foot_cols = [
  ['Services', [
    ['Home removals', 'home-removals.php'], ['Storage solutions', 'storage.php'],
    ['Waste removal', 'waste-removal.php'], ['Decluttering', 'decluttering.php'],
  ]],
  ['Company', [
    ['About us', 'index.php#about'], ['Why choose us', 'index.php#why'],
    ['How it works', 'index.php#how'], ['FAQ', 'index.php#faq'], ['Contact', 'contact.php'],
  ]],
  ['Get started', [
    ['Get a free quote', 'quote.php'], ['Call us', SITE_PHONE_HREF],
    ['Email us', 'mailto:' . SITE_EMAIL],
  ]],
];

/* Brand social glyphs (inline; Lucide dropped brand marks) */
$social = [
  'instagram' => '<rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4.2"/><circle cx="17.3" cy="6.7" r="1.1" fill="currentColor" stroke="none"/>',
  'facebook'  => '<path fill="currentColor" stroke="none" d="M13.5 21v-7.5h2.5l.4-3h-2.9V8.6c0-.87.27-1.46 1.5-1.46H16.5V4.46c-.28-.04-1.23-.12-2.34-.12-2.3 0-3.88 1.4-3.88 3.99V10.5H7.8v3h2.48V21z"/>',
  'linkedin'  => '<path fill="currentColor" stroke="none" d="M4.6 3.5a2.1 2.1 0 1 1-.01 4.2 2.1 2.1 0 0 1 .01-4.2zM2.7 9h3.8v11.5H2.7zM9 9h3.65v1.57h.05c.51-.92 1.75-1.9 3.6-1.9 3.85 0 4.56 2.43 4.56 5.6v6.23h-3.8v-5.52c0-1.32-.02-3.01-1.9-3.01-1.9 0-2.19 1.43-2.19 2.91v5.62H9z"/>',
];
$year = date('Y');
?>
<footer class="site-footer">
  <div class="container">
    <div class="foot-grid">
      <div class="foot-about">
        <img src="assets/img/logo-white-trim.png" alt="<?= SITE_NAME ?>" width="135" height="34">
        <p>Removals, storage, waste clearance &amp; decluttering across Kent, London and the UK — delivered with care, honesty, and a red carpet touch.</p>
        <div class="foot-social">
          <?php foreach ($social as $name => $path): ?>
            <a href="#" aria-label="<?= ucfirst($name) ?>">
              <svg class="il-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><?= $path ?></svg>
            </a>
          <?php endforeach; ?>
        </div>
      </div>
      <?php foreach ($foot_cols as [$heading, $items]): ?>
        <div class="foot-col">
          <h3><?= $heading ?></h3>
          <ul>
            <?php foreach ($items as [$label, $href]): ?>
              <li><a href="<?= htmlspecialchars($href) ?>"><?= $label ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="foot-bottom">
      <span>&copy; <?= $year ?> <?= SITE_NAME ?>. All rights reserved.</span>
      <span class="foot-legal">
        <a href="#">Privacy</a>
        <a href="#">Terms</a>
      </span>
    </div>
  </div>
</footer>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "MovingCompany",
  "name": "<?= SITE_NAME ?>",
  "url": "<?= SITE_URL ?>",
  "image": "<?= SITE_URL ?>assets/img/logo-primary.png",
  "logo": "<?= SITE_URL ?>assets/img/logo-primary.png",
  "telephone": "<?= SITE_PHONE ?>",
  "email": "<?= SITE_EMAIL ?>",
  "priceRange": "££",
  "address": {
    "@type": "PostalAddress",
    "addressRegion": "Kent",
    "addressCountry": "GB"
  },
  "areaServed": ["Kent", "London", "Gravesend", "United Kingdom"],
  "openingHoursSpecification": {
    "@type": "OpeningHoursSpecification",
    "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"],
    "opens": "00:00",
    "closes": "23:59"
  },
  "slogan": "Move Anything, Anywhere. A Red Carpet Experience."
}
</script>
<?php if (!empty($page_jsonld)) echo $page_jsonld; ?>
</body>
</html>
