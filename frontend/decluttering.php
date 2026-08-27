<?php
$page        = 'decluttering';
$title       = 'Decluttering Services Kent & London | Home Organisation';
$description = 'Professional decluttering and home reorganisation services in Kent and London — wardrobes, kitchens, downsizing and moving preparation. Stress-free spaces.';
$canonical   = 'https://ingresslogistics.com/decluttering.php';

require_once __DIR__ . '/partials/config.php';

$hero = [
  'eyebrow'   => 'Decluttering & reorganisation · Kent & London',
  'h1'        => 'Professional decluttering & home organisation',
  'intro'     => "Helping homeowners across Kent and London create organised, functional and stress-free living spaces — whether you're tidying a wardrobe, downsizing, or getting ready to move.",
  'subs_title'=> 'How we help',
  'subs_lead' => 'Practical, judgement-free help to get your space working for you.',
];

$subs = [
  ['home', 'Wardrobe Organisation', 'Sort, declutter and organise your wardrobe so getting ready is effortless.'],
  ['package', 'Kitchen Organisation', 'Functional, tidy kitchens with everything in its place.'],
  ['truck', 'Moving Preparation', 'Declutter before a move so you only pack and pay to move what you love.'],
  ['heart-handshake', 'Downsizing Support', 'Gentle, practical help deciding what to keep when moving to a smaller home.'],
  ['building-2', 'Home Reorganisation', 'A full reset of any room or whole home for calmer, more functional living.'],
];

$enquiry = [
  'line'   => 'decluttering',
  'submit' => 'Book a decluttering session',
  'note'   => "Judgement-free, confidential, and at your pace.",
  'fields' => [
    ['type'=>'select','name'=>'area','label'=>'What would you like help with?','required'=>true,'placeholder'=>'Select a focus',
      'options'=>['Wardrobe organisation','Kitchen organisation','Whole-home reorganisation','Moving preparation','Downsizing support']],
    ['type'=>'select','name'=>'property_size','label'=>'Property size','placeholder'=>'Select size',
      'options'=>['Studio / 1-bed','2-bed','3-bed','4+ bed','Business / office']],
    ['type'=>'date','name'=>'date','label'=>'Preferred date'],
    ['type'=>'text','name'=>'location','label'=>'Your area / postcode','placeholder'=>'e.g. Gravesend, DA11'],
    ['type'=>'text','name'=>'name','label'=>'Your name','placeholder'=>'Enter your full name','required'=>true,'autocomplete'=>'name'],
    ['type'=>'tel','name'=>'phone','label'=>'Phone number','placeholder'=>'07000 000000','required'=>true,'autocomplete'=>'tel'],
    ['type'=>'email','name'=>'email','label'=>'Email address','placeholder'=>'you@email.com','required'=>true,'col'=>'full','autocomplete'=>'email'],
    ['type'=>'textarea','name'=>'details','label'=>'Tell us about your space','placeholder'=>'What rooms or areas, your goals, any deadlines (like a move date)…','col'=>'full'],
    ['type'=>'file','name'=>'photos','label'=>'Photos (optional)','col'=>'full','accept'=>'image/jpeg,image/png,image/webp,image/heic','note'=>'Up to 3 images, 5MB each — helps us understand your space.'],
  ],
];
$form_heading_eyebrow = 'Free · no obligation';
$form_heading = 'Book a decluttering session';
$form_intro   = 'Tell us about your space and goals and we\'ll suggest the best way to help.';

$page_jsonld = '<script type="application/ld+json">' . json_encode([
  '@context'=>'https://schema.org','@type'=>'Service','serviceType'=>'Decluttering and home organisation',
  'provider'=>['@type'=>'MovingCompany','name'=>SITE_NAME],
  'areaServed'=>['Kent','London','Gravesend','United Kingdom'],
  'description'=>'Professional decluttering, home organisation and downsizing support in Kent and London.','url'=>$canonical,
], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) . '</script>';

require __DIR__ . '/partials/service-page.php';
