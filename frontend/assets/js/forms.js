/* ============================================================
   Ingress Logistics — generic enquiry forms
   Handles any <form class="js-enquiry">:
   - required-field check, JSON POST to data-endpoint, success modal
   - Google Places (UK) autocomplete on any input[data-places]
   - sets min date on date inputs
   Progressive enhancement — forms still submit nothing-breaking without JS.
   ============================================================ */
(function () {
  'use strict';

  var MAPS_KEY = 'AIzaSyApleTL9bwRaPVuAeamU0bC0vBph7ok79k';

  // PLACEHOLDER lead value for Google Ads optimisation — set this to a realistic
  // average value per enquiry (e.g. average job profit) before relying on it.
  var LEAD_VALUE = 50;
  var LEAD_CURRENCY = 'GBP';

  // Image upload limits (mirrored server-side in api/enquiry.php).
  var MAX_FILES = 3;
  var MAX_FILE_MB = 5;
  var ALLOWED_TYPES = ['image/jpeg', 'image/png', 'image/webp', 'image/heic'];

  function validateFiles(files) {
    if (files.length > MAX_FILES) return false;
    for (var i = 0; i < files.length; i++) {
      var f = files[i];
      if (f.size > MAX_FILE_MB * 1024 * 1024) return false;
      // HEIC sometimes reports an empty type in browsers — allow by extension too.
      if (ALLOWED_TYPES.indexOf(f.type) === -1 && !/\.(jpe?g|png|webp|heic)$/i.test(f.name)) return false;
    }
    return true;
  }

  function showModal(message, isError, title) {
    var m = document.getElementById('enquiryModal');
    if (!m) return;
    var box = document.getElementById('enquiryBox');
    var t = document.getElementById('enquiryTitle');
    var msg = document.getElementById('enquiryMessage');
    if (box) box.classList.toggle('is-error', !!isError);
    if (t) t.textContent = title || (isError ? 'Something went wrong' : 'Enquiry received!');
    if (msg && message) msg.textContent = message;
    m.classList.add('is-open');
  }
  function hideModal() {
    var m = document.getElementById('enquiryModal');
    if (m) m.classList.remove('is-open');
  }

  function wire(form) {
    var endpoint = form.dataset.endpoint || '/api/enquiry.php';
    var btn = form.querySelector('[type="submit"]');
    var label = btn ? btn.innerHTML : '';

    form.addEventListener('submit', function (e) {
      e.preventDefault();

      var missing = false;
      form.querySelectorAll('[required]').forEach(function (el) {
        if (!String(el.value || '').trim()) missing = true;
      });
      if (missing) { showModal('Please fill in all required fields before submitting.', true, 'Check the form'); return; }

      var fd = new FormData(form);
      // Plain object of the non-file fields — used for validation, gtag and the modal.
      var data = {};
      fd.forEach(function (v, k) { if (!(v instanceof File)) data[k] = v; });

      // Image-bearing forms POST multipart so files ride along; others stay JSON.
      var fileInput = form.querySelector('input[type="file"]');
      var hasFiles = fileInput && fileInput.files && fileInput.files.length;
      if (hasFiles && !validateFiles(fileInput.files)) {
        showModal('Please attach up to ' + MAX_FILES + ' images (JPG, PNG, WEBP or HEIC), each under ' + MAX_FILE_MB + 'MB.', true, 'Check your photos');
        return;
      }

      if (btn) { btn.disabled = true; btn.textContent = 'Submitting…'; }

      fetch(endpoint, hasFiles ? {
        method: 'POST',
        body: fd
      } : {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
      })
        .then(function (r) { if (!r.ok) throw new Error('HTTP ' + r.status); return r.text(); })
        .then(function () {
          // GA4 / Google Ads conversion: fire on a successful enquiry submission.
          if (typeof window.gtag === 'function') {
            window.gtag('event', 'generate_lead', {
              value: LEAD_VALUE,
              currency: LEAD_CURRENCY,
              service_line: data.service_line || '',
              service: data.service || '',
              form_id: form.id || ''
            });
          }
          showModal('Thank you, ' + (data.name || '') + '! Your enquiry has been received. We\'ll be in touch soon.', false);
          form.reset();
        })
        .catch(function (err) {
          console.error('Enquiry submit error:', err);
          showModal('Sorry, there was an error submitting your enquiry. Please try again, or call us directly.', true);
        })
        .finally(function () {
          if (btn) { btn.disabled = false; btn.innerHTML = label; }
        });
    });
  }

  window.initMap = function () {
    if (!window.google || !google.maps || !google.maps.places) return;
    var opts = {
      componentRestrictions: { country: 'gb' },
      fields: ['address_components', 'geometry', 'name'],
      types: ['geocode']
    };
    document.querySelectorAll('input[data-places]').forEach(function (el) {
      new google.maps.places.Autocomplete(el, opts);
    });
  };

  function loadMaps() {
    if (document.getElementById('gmaps-script')) return;
    var s = document.createElement('script');
    s.id = 'gmaps-script';
    s.async = true;
    s.src = 'https://maps.googleapis.com/maps/api/js?key=' + MAPS_KEY +
            '&loading=async&libraries=places&callback=initMap';
    document.head.appendChild(s);
  }

  function init() {
    var forms = document.querySelectorAll('form.js-enquiry');
    if (!forms.length) return;
    forms.forEach(wire);

    document.querySelectorAll('input[type="date"]').forEach(function (el) {
      if (!el.min) el.min = new Date().toISOString().split('T')[0];
    });

    var close = document.getElementById('enquiryClose');
    if (close) close.addEventListener('click', hideModal);
    var m = document.getElementById('enquiryModal');
    if (m) m.addEventListener('click', function (e) { if (e.target === m) hideModal(); });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') hideModal(); });

    if (document.querySelector('input[data-places]')) loadMaps();
  }

  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', init);
  else init();
})();
