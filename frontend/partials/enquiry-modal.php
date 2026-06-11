<?php /* Shared success modal — include once on any page that has an enquiry form. */ ?>
<div class="modal-overlay" id="enquiryModal" role="dialog" aria-modal="true" aria-labelledby="enquiryTitle">
  <div class="modal" id="enquiryBox">
    <div class="modal-icon modal-icon--success"><?= il_icon('check', 32) ?></div>
    <div class="modal-icon modal-icon--error"><?= il_icon('x', 32) ?></div>
    <h2 id="enquiryTitle">Enquiry received!</h2>
    <p id="enquiryMessage">Thank you — we've got your details and we'll be in touch soon. Keep an eye on your inbox and phone.</p>
    <button class="btn btn--primary btn--lg btn--full" id="enquiryClose">Close</button>
  </div>
</div>
<script defer src="assets/js/forms.js"></script>
