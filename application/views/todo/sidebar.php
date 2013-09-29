	<div class="sidebar-nav navbar-collapse">
 				<?php if($user_lists): ?>
				<ul class="nav nav-tabs nav-stacked main-menu">
					<?php foreach($user_lists as $lists): ?>
					<li class="list_<?php echo $lists->list_id ?>">
						<?php echo anchor("todo/lists/$lists->list_id", '<i class="icon-align-justify"></i> <span class="editable" data-id="list_name">'.$lists->list_name.'</span>', array('title' => $lists->list_name, 'class' => 'getlist') ); ?>
						<?php echo anchor("todo/delete_list/$lists->list_id", 'X' , 'class="notifier deleteList"'); ?> 
						<?php echo anchor("todo/update_list/$lists->list_id", 'edit' , 'class="notifier2 updateList"'); ?> 

					</li>
    			<?php endforeach; ?>
				</ul>	
				<?php else: ?>
				<div class="alert alert-warning">
					<button data-dismiss="alert" class="close" type="button">×</button>
					<h4 class="alert-heading">Warning!</h4>
					<p>Best check yo self, you have no lists. Let's add some!</p>
				</div>
				<?php endif; ?>
			</div>
			<button class="addList btn btn-primary">Add new list</button>