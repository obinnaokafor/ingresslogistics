<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/icons.php';

/**
 * Render a config-driven enquiry form (posts JSON to the SES server).
 * $cfg = [
 *   'line'   => 'storage',                 // service_line value (see server/index.php)
 *   'submit' => 'Request storage info',    // button label
 *   'note'   => 'optional fine print',
 *   'fields' => [
 *     ['type'=>'text','name'=>'name','label'=>'Your name','required'=>true,'col'=>'half'],
 *     ['type'=>'select','name'=>'storage_type','label'=>'Storage type','options'=>[...]],
 *     ['type'=>'textarea','name'=>'details','label'=>'Details','col'=>'full'],
 *     ...
 *   ],
 * ];
 */
function il_enquiry_form(array $cfg) {
  $line   = $cfg['line'] ?? 'contact';
  $submit = $cfg['submit'] ?? 'Send enquiry';
  $note   = $cfg['note'] ?? "We'll never share your details. No obligation.";
  $fields = $cfg['fields'] ?? [];
  ?>
  <form class="quote-form js-enquiry" data-endpoint="<?= htmlspecialchars(QUOTE_ENDPOINT) ?>" novalidate>
    <input type="hidden" name="service_line" value="<?= htmlspecialchars($line) ?>">
    <div class="form-grid">
      <?php foreach ($fields as $f):
        $type  = $f['type'] ?? 'text';
        $name  = $f['name'];
        $id    = $f['id'] ?? $name;
        $label = $f['label'] ?? ucfirst($name);
        $req   = !empty($f['required']);
        $ph    = $f['placeholder'] ?? '';
        $col   = ($f['col'] ?? 'half') === 'full' ? ' col-span-2' : '';
        $extra = '';
        if (!empty($f['places'])) $extra .= ' data-places autocomplete="off"';
        if (!empty($f['autocomplete'])) $extra .= ' autocomplete="' . htmlspecialchars($f['autocomplete']) . '"';
      ?>
        <?php if ($type === 'select'): ?>
          <div class="field field--select<?= $col ?>">
            <label for="<?= $id ?>"><?= htmlspecialchars($label) ?></label>
            <div class="select-wrap">
              <select id="<?= $id ?>" name="<?= htmlspecialchars($name) ?>"<?= $req ? ' required' : '' ?>>
                <option value=""><?= htmlspecialchars($ph ?: 'Select…') ?></option>
                <?php foreach (($f['options'] ?? []) as $opt): ?>
                  <option value="<?= htmlspecialchars($opt) ?>"><?= htmlspecialchars($opt) ?></option>
                <?php endforeach; ?>
              </select>
              <span class="select-chevron"><?= il_icon('chevron-down', 16) ?></span>
            </div>
          </div>
        <?php elseif ($type === 'textarea'): ?>
          <div class="field<?= $col ?>">
            <label for="<?= $id ?>"><?= htmlspecialchars($label) ?></label>
            <textarea id="<?= $id ?>" name="<?= htmlspecialchars($name) ?>" rows="<?= (int)($f['rows'] ?? 4) ?>" placeholder="<?= htmlspecialchars($ph) ?>"<?= $req ? ' required' : '' ?>></textarea>
          </div>
        <?php else: ?>
          <div class="field<?= $col ?>">
            <label for="<?= $id ?>"><?= htmlspecialchars($label) ?></label>
            <input type="<?= htmlspecialchars($type) ?>" id="<?= $id ?>" name="<?= htmlspecialchars($name) ?>" placeholder="<?= htmlspecialchars($ph) ?>"<?= $req ? ' required' : '' ?><?= $extra ?>>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
    <div>
      <button type="submit" class="btn btn--primary btn--lg btn--full"><?= htmlspecialchars($submit) ?> <?= il_icon('arrow-right', 18) ?></button>
      <p class="form-fineprint"><?= htmlspecialchars($note) ?></p>
    </div>
  </form>
  <?php
}
