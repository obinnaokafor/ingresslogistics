<?php
/* Document head + top chrome (contact bar + header).
   Pages set $title, $description, $canonical, $og_image, $page before requiring this. */
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/icons.php';

$title       = $title       ?? 'Ingress Logistics — Move Anything, Anywhere';
$description = $description ?? 'Professional home & office removals across the UK with unbeatable prices and 5-star service. Get your free, no-obligation quote today.';
$canonical   = $canonical   ?? SITE_URL;
$og_image    = $og_image    ?? SITE_URL . 'assets/img/logo-primary.png';
$page        = $page        ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-HEDDP3X03B"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-HEDDP3X03B');
  </script>

  <title><?= htmlspecialchars($title) ?></title>
  <meta name="description" content="<?= htmlspecialchars($description) ?>">
  <link rel="canonical" href="<?= htmlspecialchars($canonical) ?>">
  <meta name="robots" content="index,follow">
  <meta name="author" content="<?= SITE_NAME ?>">
  <meta name="theme-color" content="#D01840">

  <!-- Open Graph / Twitter -->
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="<?= SITE_NAME ?>">
  <meta property="og:title" content="<?= htmlspecialchars($title) ?>">
  <meta property="og:description" content="<?= htmlspecialchars($description) ?>">
  <meta property="og:url" content="<?= htmlspecialchars($canonical) ?>">
  <meta property="og:image" content="<?= htmlspecialchars($og_image) ?>">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= htmlspecialchars($title) ?>">
  <meta name="twitter:description" content="<?= htmlspecialchars($description) ?>">
  <meta name="twitter:image" content="<?= htmlspecialchars($og_image) ?>">

  <link rel="icon" href="assets/img/logo-primary-trim.png" type="image/png">

  <!-- Fonts: preconnect + non-render-blocking load -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,500;0,600;0,700;0,800;1,700;1,800&family=Mulish:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap">

  <!-- Design-system tokens + site styles -->
  <link rel="stylesheet" href="assets/css/tokens/colors.css">
  <link rel="stylesheet" href="assets/css/tokens/typography.css">
  <link rel="stylesheet" href="assets/css/tokens/spacing.css">
  <link rel="stylesheet" href="assets/css/tokens/base.css">
  <link rel="stylesheet" href="assets/css/site.css">

  <script src="assets/js/site.js" defer></script>
</head>
<body>
<?php include __DIR__ . '/contactbar.php'; ?>
<?php include __DIR__ . '/header.php'; ?>
