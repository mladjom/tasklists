<div class="container">
	<div class="row">
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

		<div class="col-lg-10 col-sm-11" id="content">
			<?php if ($flash_message): ?>
			<div class="alert alert-success">
				<button data-dismiss="alert" class="close" type="button">×</button>
				<?php echo $flash_message ; ?>
			</div>
			<?php endif ; ?>
			<div class="row">
				<div class="col-lg-6 col-md-6">
					<div class="box">
						<div class="box-header">
							<h2><i class="icon-cog"></i>To Do List</h2>
						
						</div>
						<?php  
						
						//echo '<pre>';print_r($active_todos); echo '</pre>';
						//echo '<pre>';print_r($this->session->all_userdata());echo '</pre>';
		 				//echo '<pre>';print$this->session->userdata('id');echo '</pre>';
		 				//echo '<pre>';print_r($all_todos); echo '</pre>';
		 
		 				if($active_todos):?>
							<div class="box-content">
								<div class="todo">
									<ul class="todo-list">
										<?php foreach($active_todos as $todo): ?>
											<li>
												<span class="todo-actions">
													<?php echo anchor("todo/complete/$todo->id", '<i class="icon-check-empty"></i>', 'class="completed"'); ?>
												</span>
												<span class="title"><?php echo $todo->title ?></span> <span class="desc"><?php echo $todo->description ?></span> 
												<?php echo anchor("todo/update/$todo->id", 'update' , 'class="btn btn-success btn-xs"'); ?> 
												<?php echo anchor("todo/delete/$todo->id", 'delete' , 'class="btn btn-danger btn-xs"'); ?> 
											</li>
										<?php endforeach; ?>
									</ul>
								</div>	
							</div><!-- end: box-content -->									
							<div class="box-content">
								<div class="container">
									<?php $this->load->view('todo/add'); ?>
								</div>									
							</div>		
							<?php else: ?>
							<div class="box-content">
								<div class="alert alert-warning">
									<button data-dismiss="alert" class="close" type="button">×</button>
									<h4 class="alert-heading">Warning!</h4>
									<p>Best check yo self, you haven no tasks. Let's add some</p>
								</div>
								<div class="container">
								<?php $this->load->view('todo/add'); ?>
								</div>
							</div>								
						<?php endif; ?>					
					</div>
				</div>

				<div class="col-lg-6 col-md-6">
					<div class="box">
						<div class="box-header">
							<h2><i class="icon-check"></i>Completed List</h2>
						</div>
						<?php if($completed_todos): ?>
							<div class="box-content">
								<div class="todo">
									<ul class="todo-list">
										<?php foreach($completed_todos as $todo): ?>
											<li>
												<span class="todo-actions">
													<?php echo anchor("todo/incomplete/$todo->id", '<i class="icon-check"></i>', ''); ?>
												</span>							
												<span class="title"><?php echo $todo->title ?></span> <span class="desc"><?php echo $todo->description ?></span> 
												<?php echo anchor("todo/delete/$todo->id", 'delete' , 'class="btn btn-danger btn-xs"'); ?> 
											</li>
										<?php endforeach ;?>
									</ul>				
								</div>	
							</div><!-- end: box-content -->	
						<?php else: ?>
						<div class="box-content">
							<div class="alert alert-warning">
								<button data-dismiss="alert" class="close" type="button">×</button>
								<h4 class="alert-heading">Warning!</h4>
								<p>Best check yo self, you haven't completed anything yet.</p>
							</div>
						</div>
						<?php endif ;?>	
					</div><!-- end: box -->	
				</div><!-- end: col -->
			</div>	
		</div>
	</div><!-- end: row -->
</div><!-- end: container -->
