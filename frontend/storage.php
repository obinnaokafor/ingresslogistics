<?php
$page        = 'storage';
$title       = 'Storage Kent & London | Secure Household & Business Storage';
$description = 'Secure short-term and long-term storage units in Kent and London for households, businesses and students. Flexible terms, fully insured. Enquire today.';
$canonical   = 'https://ingresslogistics.com/storage.php';

require_once __DIR__ . '/partials/config.php';

$hero = [
  'eyebrow'   => 'Storage solutions · Kent & London',
  'h1'        => 'Secure storage in Kent & London',
  'intro'     => "Short-term or long-term, household or business — keep your belongings safe with flexible, fully insured storage. Tell us what you need and we'll sort the rest.",
  'subs_title'=> 'Storage to suit every need',
  'subs_lead' => 'Flexible terms whether you need space for a week or a year.',
];

$subs = [
  ['home', 'Household Storage', 'Free up space at home or keep belongings safe between moves, in secure, dry units.'],
  ['building-2', 'Business Storage', 'Stock, equipment, files and archives stored securely with access when you need it.'],
  ['package', 'Student Storage', 'Affordable storage over the holidays or between terms — perfect for student moves.'],
  ['truck', 'Temporary Storage During Moves', 'A safe place for your things when move-out and move-in dates don\'t quite line up.'],
];

$enquiry = [
  'line'   => 'storage',
  'submit' => 'Request a storage quote',
  'note'   => "We'll never share your details. No obligation to book.",
  'fields' => [
    ['type'=>'select','name'=>'storage_type','label'=>'Storage type','required'=>true,'placeholder'=>'Select storage type',
      'options'=>['Household storage','Business storage','Student storage','Temporary storage during a move']],
    ['type'=>'select','name'=>'duration','label'=>'How long?','placeholder'=>'Select duration',
      'options'=>['A few weeks','1–3 months','3–6 months','6+ months','Not sure yet']],
    ['type'=>'text','name'=>'volume','label'=>'Approx. items / volume','placeholder'=>'e.g. contents of a 2-bed flat','col'=>'full'],
    ['type'=>'date','name'=>'date','label'=>'Preferred start date'],
    ['type'=>'text','name'=>'location','label'=>'Your area / postcode','placeholder'=>'e.g. Gravesend, DA11'],
    ['type'=>'text','name'=>'name','label'=>'Your name','placeholder'=>'Enter your full name','required'=>true,'autocomplete'=>'name'],
    ['type'=>'tel','name'=>'phone','label'=>'Phone number','placeholder'=>'07000 000000','required'=>true,'autocomplete'=>'tel'],
    ['type'=>'email','name'=>'email','label'=>'Email address','placeholder'=>'you@email.com','required'=>true,'col'=>'full','autocomplete'=>'email'],
    ['type'=>'textarea','name'=>'details','label'=>'Anything else?','placeholder'=>'Tell us about what you\'re storing, access needs, etc.','col'=>'full'],
  ],
];
$form_heading_eyebrow = 'Free · no obligation';
$form_heading = 'Enquire about storage';
$form_intro   = 'Give us a few details and we\'ll come back with options and a clear price.';

$page_jsonld = '<script type="application/ld+json">' . json_encode([
  '@context'=>'https://schema.org','@type'=>'Service','serviceType'=>'Storage',
  'provider'=>['@type'=>'MovingCompany','name'=>SITE_NAME],
  'areaServed'=>['Kent','London','Gravesend','United Kingdom'],
  'description'=>'Secure household, business and student storage in Kent and London.','url'=>$canonical,
], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) . '</script>';

require __DIR__ . '/partials/service-page.php';
