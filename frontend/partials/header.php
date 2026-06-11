<?php
require_once __DIR__ . '/config.php';
$page = $page ?? '';
$home = ($page === 'home') ? '' : 'index.php';

/* Service line pages — used in the dropdown + mobile menu. */
$service_links = [
  ['label' => 'Home Removals',          'href' => 'home-removals.php', 'key' => 'removals',     'icon' => 'truck'],
  ['label' => 'Storage Solutions',      'href' => 'storage.php',       'key' => 'storage',      'icon' => 'package'],
  ['label' => 'Waste Removal',          'href' => 'waste-removal.php', 'key' => 'waste',        'icon' => 'truck'],
  ['label' => 'Decluttering & Reorg',   'href' => 'decluttering.php',  'key' => 'decluttering', 'icon' => 'home'],
];
$on_service = in_array($page, ['removals', 'storage', 'waste', 'decluttering', 'services'], true);
?>
<header class="site-header" id="siteHeader">
  <div class="container">
    <a href="index.php" class="brand" aria-label="<?= SITE_NAME ?> — home">
      <img src="assets/img/logo-primary-trim.png" alt="<?= SITE_NAME ?>" width="150" height="38">
    </a>

    <nav class="site-nav" aria-label="Primary">
      <a href="index.php"<?= $page === 'home' ? ' class="is-active" aria-current="page"' : '' ?>>Home</a>

      <div class="nav-dropdown<?= $on_service ? ' is-active' : '' ?>">
        <a href="services.php" class="nav-dropdown-toggle" aria-haspopup="true" aria-expanded="false">
          Services <?= il_icon('chevron-down', 16) ?>
        </a>
        <div class="nav-menu" role="menu">
          <a href="services.php" role="menuitem">All services</a>
          <?php foreach ($service_links as $s): ?>
            <a href="<?= $s['href'] ?>" role="menuitem"<?= $page === $s['key'] ? ' class="is-active"' : '' ?>>
              <?= il_icon($s['icon'], 17) ?><span><?= $s['label'] ?></span>
            </a>
          <?php endforeach; ?>
        </div>
      </div>

      <a href="<?= $home ?>#how">How it works</a>
      <a href="<?= $home ?>#about">About</a>
      <a href="contact.php"<?= $page === 'contact' ? ' class="is-active" aria-current="page"' : '' ?>>Contact</a>
    </nav>

    <div class="header-cta">
      <a href="quote.php" class="btn btn--primary">Get a Quote <?= il_icon('arrow-right', 17) ?></a>
    </div>

    <button class="burger" id="burger" aria-label="Open menu" aria-expanded="false" aria-controls="mobileMenu">
      <?= il_icon('menu', 26) ?>
    </button>
  </div>

  <div class="mobile-menu" id="mobileMenu">
    <a href="index.php">Home</a>
    <span class="mobile-group-label">Services</span>
    <a href="services.php" class="mobile-sub">All services</a>
    <?php foreach ($service_links as $s): ?>
      <a href="<?= $s['href'] ?>" class="mobile-sub"><?= $s['label'] ?></a>
    <?php endforeach; ?>
    <a href="<?= $home ?>#how">How it works</a>
    <a href="<?= $home ?>#about">About</a>
    <a href="contact.php">Contact</a>
    <a href="quote.php" class="btn btn--primary btn--full">Get a Quote</a>
  </div>
</header>
