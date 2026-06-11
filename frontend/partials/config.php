<?php
/* Site-wide constants. Single source of truth for contact details + URLs. */
if (!defined('SITE_URL')) {
  define('SITE_URL', 'https://ingresslogistics.com/');           // trailing slash
  define('SITE_NAME', 'Ingress Logistics Limited');
  define('SITE_PHONE', '+44 740 403 9458');
  define('SITE_PHONE_HREF', 'tel:+447404039458');
  define('SITE_EMAIL', 'support@ingresslogistics.com');
  /* Same-origin enquiry handler (no CORS). Root-relative so it works
     identically on localhost and production — no editing before deploy. */
  define('QUOTE_ENDPOINT', '/api/enquiry.php');
}

/* Session + CSRF token (used to protect the enquiry forms).
   Must run before any output — config.php is included at the top of every page. */
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
if (empty($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
if (!function_exists('il_csrf')) {
  function il_csrf(): string { return $_SESSION['csrf_token'] ?? ''; }
}
