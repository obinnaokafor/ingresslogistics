<?php
/* Site-wide constants. Single source of truth for contact details + URLs. */
if (!defined('SITE_URL')) {
  define('SITE_URL', 'https://ingresslogistics.com/');           // trailing slash
  define('SITE_NAME', 'Ingress Logistics Limited');
  define('SITE_PHONE', '+44 740 403 9458');
  define('SITE_PHONE_HREF', 'tel:+447404039458');
  define('SITE_EMAIL', 'support@ingresslogistics.com');
  /* Endpoint the quote form POSTs to (AWS SES emailer). */
  define('QUOTE_ENDPOINT', 'https://server.ingresslogistics.com');
}
