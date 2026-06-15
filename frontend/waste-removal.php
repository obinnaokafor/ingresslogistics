<?php
$page        = 'waste';
$title       = 'Waste Removal Kent & London | Rubbish & House Clearance';
$description = 'Fast, affordable waste removal and rubbish clearance in Kent and London — household, garden, furniture, garage and construction waste. Book a collection.';
$canonical   = 'https://ingresslogistics.com/waste-removal.php';

require_once __DIR__ . '/partials/config.php';

$hero = [
  'eyebrow'   => 'Waste removal · Kent & London',
  'h1'        => 'Waste removal & rubbish clearance in Kent & London',
  'intro'     => "Fast and affordable waste collection and disposal — from a few bags to a full garage clearance. We load, clear and dispose of it responsibly so you don't have to.",
  'subs_title'=> 'What we clear',
  'subs_lead' => 'If it needs clearing, we can help — responsibly disposed of and recycled where possible.',
];

$subs = [
  ['home', 'Household Waste', 'General household clutter and rubbish removed quickly and cleanly.'],
  ['truck', 'Garden Waste', 'Green waste, soil, branches and clippings cleared and disposed of.'],
  ['package', 'Furniture Disposal', 'Old sofas, beds, wardrobes and appliances taken away and recycled where possible.'],
  ['building-2', 'Garage & Loft Clearances', 'Full garage, loft and shed clearances — we do the lifting and hauling.'],
  ['wrench', 'Construction Waste', 'Rubble, offcuts and post-renovation debris cleared from your site.'],
];

$enquiry = [
  'line'   => 'waste',
  'submit' => 'Book a waste collection',
  'note'   => "We'll confirm a price before any work begins.",
  'fields' => [
    ['type'=>'select','name'=>'waste_type','label'=>'Type of waste','required'=>true,'placeholder'=>'Select waste type',
      'options'=>['Household waste','Garden waste','Furniture disposal','Garage/loft clearance','Construction waste']],
    ['type'=>'text','name'=>'amount','label'=>'Approx. amount','placeholder'=>'e.g. a few bags, a van load, a full garage'],
    ['type'=>'select','name'=>'access','label'=>'Access','placeholder'=>'Select access',
      'options'=>['Easy / ground floor','Stairs / upper floor','Limited parking','Not sure']],
    ['type'=>'text','name'=>'location','label'=>'Collection postcode','placeholder'=>'e.g. DA11'],
    ['type'=>'date','name'=>'date','label'=>'Preferred date'],
    ['type'=>'text','name'=>'name','label'=>'Your name','placeholder'=>'Enter your full name','required'=>true,'autocomplete'=>'name'],
    ['type'=>'tel','name'=>'phone','label'=>'Phone number','placeholder'=>'07000 000000','required'=>true,'autocomplete'=>'tel'],
    ['type'=>'email','name'=>'email','label'=>'Email address','placeholder'=>'you@email.com','required'=>true,'col'=>'full','autocomplete'=>'email'],
    ['type'=>'textarea','name'=>'details','label'=>'Describe the items','placeholder'=>'Tell us what needs clearing — rough list of items, anything heavy or awkward, etc.','col'=>'full'],
    ['type'=>'file','name'=>'photos','label'=>'Photos (optional)','col'=>'full','accept'=>'image/jpeg,image/png,image/webp,image/heic','note'=>'Up to 3 images, 5MB each — helps us quote more accurately.'],
  ],
];
$form_heading_eyebrow = 'Fast response';
$form_heading = 'Book your waste collection';
$form_intro   = 'Tell us what needs clearing and we\'ll send a clear, affordable price — often the same day.';

$page_jsonld = '<script type="application/ld+json">' . json_encode([
  '@context'=>'https://schema.org','@type'=>'Service','serviceType'=>'Waste removal and rubbish clearance',
  'provider'=>['@type'=>'MovingCompany','name'=>SITE_NAME],
  'areaServed'=>['Kent','London','Gravesend','United Kingdom'],
  'description'=>'Waste collection, rubbish clearance and house clearance in Kent and London.','url'=>$canonical,
], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) . '</script>';

require __DIR__ . '/partials/service-page.php';
