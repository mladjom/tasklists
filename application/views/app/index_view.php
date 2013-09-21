<?php $this->load->view("template/sidebar"); ?>
<div class="col-lg-10 col-sm-11" id="content">
  <table border="1">
    <tr>
      <th>By User</th>
      <th>Title</th>
      <th>Priority</th>
      <th>Date Added</th>
      <th>Date to complete</th>
      <th>Done?</th>
      <th>&nbsp;</th>
    </tr>
    <?php foreach ($all_list as $list): ?>
      <?php for($i = 0; $i < count($list['username']); $i++ ):?>
        <tr>
          <td><?= $list['username'][$i] ?></td>
          <td><?= $list['title'][$i] ?></td>
          <td><?= $list['priority'][$i] ?></td>
          <td><?= $list['date_added'][$i] ?></td>
          <td><?= $list['date_complete'][$i] ?></td>
          <?php if($list['status'][$i] == 0): ?>
            <?php if ($this->session->userdata('id') == $list['user_id'][$i]): ?>
          <td><?= anchor('app/check/' . $list['list_id'][$i] . '/0/' . $this->uri->segment(3)  , 'Undone') ?></td>
            <?php else: ?>
              <td>Undone</td>
            <?php endif; ?>
          <?php else: ?>
            <?php if ($this->session->userdata('id') == $list['user_id'][$i]): ?>
              <td><?= anchor('app/check/' . $list['list_id'][$i] . '/1/' . $this->uri->segment(3) , 'Done') ?></td>
           
					 													<?php echo anchor("todo/complete/$todo->id", '<i class="icon-check-empty"></i>', 'class="completed"'); ?>

					 
					  <?php else: ?>
              <td>Done</td>
            <?php endif; ?>
          <?php endif; ?>
          <?php if ($this->session->userdata('id') == $list['user_id'][$i]): ?>
              <td>
                <?= anchor('app/edit_task/' . $list['list_id'][$i] . '/' . $this->uri->segment(3), 'Edit') ?>
                <?= anchor('app/remove_task/' . $list['list_id'][$i] . '/' . $this->uri->segment(3), 'Delete') ?>
              </td>
          <?php else: ?>
            <td>&nbsp;</td>
          <?php endif; ?>
        </tr>
      <?php endfor; ?>
    <?php endforeach; ?>
    <?= $pages ?>
  </table>
</div>