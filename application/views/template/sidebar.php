<div class="col-lg-2 col-sm-1" id="sidebar-left">
	<div class="sidebar-nav navbar-collapse">
 				<?php if($todo_lists): ?>
				<ul class="nav nav-tabs nav-stacked main-menu">
					<?php foreach($todo_lists as $lists): ?>
					<li>
						<?php echo anchor('todo/lists/$todo->id', '<i class="icon-align-justify"></i> '.$lists->list_name, array('title' => $lists->list_name)); ?>
					</li>
    			<?php endforeach; ?>
				</ul>	
				<?php else: ?>
					No lists
				<?php endif; ?>
			</div>
			<?php $this->load->view('todo/add_list'); ?>
</div>