<div class="col-lg-2 col-sm-1" id="sidebar-left">
	<div class="sidebar-nav navbar-collapse">
 				<?php if($user_lists): ?>
				<ul class="nav nav-tabs nav-stacked main-menu">
					<?php foreach($user_lists as $lists): ?>
					<li>
						<?php echo anchor("todo/lists/$lists->list_id", '<i class="icon-align-justify"></i> '.$lists->list_name.$lists->list_id, array('title' => $lists->list_name)); ?>
						<?php echo anchor("todo/delete_list/$lists->list_id", 'delete '.$lists->list_id , 'class="btn btn-danger btn-xs"'); ?> 

					</li>
    			<?php endforeach; ?>
				</ul>	
				<?php else: ?>
					No lists
				<?php endif; ?>
			</div>
			<?php $this->load->view('todo/add_list'); ?>
</div>