<?php
  $options = array(
    1 => 'High',
    2 => 'Medium',
    3 => 'Low'
  );
  
  for($i = 1; $i <= 31; $i++) {
    $day[$i] = $i;
  }
  
  for($i = 1; $i <= 12; $i++) {
    $month[$i] = $i;
  }
  
  $this_year = date('Y');
  for($i = $this_year; $i <= $this_year+20; $i++) {
    $year[$i] = $i;
  }
?>

<div id="contact">
  <h1>ToDo</h1>
  <?php if(validation_errors()): ?>
    <p><?= validation_errors() ?></p>
  <?php endif; ?>
  <?php $attributes = array('id' => 'form-add-edit'); ?>
  <?= form_open('app/edit_validation', $attributes) ?>
    <?= form_hidden('id', $edit_form->lid) ?>
    <?= form_hidden('uri', $uri) ?>
    <p>Task:
      <?php $title = array('id' => 'title', 'name' => 'title'); ?>
      <?= form_textarea($title, $edit_form->title) ?>
    </p>
    <p>
      Priority:
      <?= form_dropdown('priority', $options, $edit_form->priority_id) ?>
    </p>
    <p>Deadline:
      <?= form_dropdown('day', $day, $form_day) ?>
      <?= form_dropdown('month', $month, $form_month) ?>
      <?= form_dropdown('year', $year, $form_year) ?>
    </p>
    <?= form_submit('submit', 'Submit') ?>
  <?= form_close() ?>
</div>