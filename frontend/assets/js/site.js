/* ============================================================
   Ingress Logistics — global behavior (all pages)
   Progressive enhancement only — content never depends on JS.
   - header shadow on scroll
   - mobile menu toggle
   - FAQ accordion (single-open)
   ============================================================ */
(function () {
  'use strict';

  function init() {
    /* Sticky header shadow */
    var header = document.getElementById('siteHeader');
    if (header) {
      var onScroll = function () {
        header.classList.toggle('is-scrolled', window.scrollY > 8);
      };
      window.addEventListener('scroll', onScroll, { passive: true });
      onScroll();
    }

    /* Mobile menu */
    var burger = document.getElementById('burger');
    var menu = document.getElementById('mobileMenu');
    if (burger && menu) {
      burger.addEventListener('click', function () {
        var open = menu.classList.toggle('is-open');
        burger.setAttribute('aria-expanded', open ? 'true' : 'false');
      });
      menu.addEventListener('click', function (e) {
        if (e.target.closest('a')) {
          menu.classList.remove('is-open');
          burger.setAttribute('aria-expanded', 'false');
        }
      });
    }

    /* FAQ accordion — single item open at a time */
    var items = Array.prototype.slice.call(document.querySelectorAll('.faq-item'));
    items.forEach(function (item) {
      var btn = item.querySelector('.faq-q');
      if (!btn) return;
      btn.addEventListener('click', function () {
        var isOpen = item.classList.contains('is-open');
        items.forEach(function (other) {
          other.classList.remove('is-open');
          var ob = other.querySelector('.faq-q');
          if (ob) ob.setAttribute('aria-expanded', 'false');
        });
        if (!isOpen) {
          item.classList.add('is-open');
          btn.setAttribute('aria-expanded', 'true');
        }
      });
    });
  }

  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', init);
  else init();
})();
