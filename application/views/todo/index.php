<?php		

?>
<div class="container">
	<div class="row">
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
					
						//echo '<pre>';print_r($user_lists); echo '</pre>';
						//echo '<pre>';print_r($this->session->all_userdata());echo '</pre>';
		 				//echo '<pre>'; print $this->session->userdata('id');echo '</pre>';
		 				//echo '<pre>';print_r($all_todos); echo '</pre>';
		 
		 				if($active_todos):?>
							<div class="box-content">
								<div class="todo">
									<ul class="todo-list" id="active">
										<?php foreach($active_todos as $todo): ?>
											<li id="<?php echo $todo->id ?>">
												<span class="todo-actions">
													<?php echo anchor("todo/complete/$todo->id", '<i class="icon-check-empty"></i>', 'class="completed"'); ?>
												</span>
												<span class="title"><?php echo $todo->title ?></span> <span class="desc"><?php echo $todo->description ?></span> 
												<?php echo anchor("todo/update/$todo->id", 'update' , 'class="btn btn-success btn-xs UpdateToDo"'); ?> 
												<?php echo anchor("todo/delete/$todo->id", 'delete' , 'class="btn btn-danger btn-xs delete"'); ?> 
											</li>
										<?php endforeach; ?>
									</ul>
								</div>	
							</div><!-- end: box-content -->									
							<div class="box-content">
								<button class="AddToDo btn btn-primary">Add new</button>
								<?php $this->load->view('todo/add'); ?>
							</div>		

							<?php else: ?>
							<div class="box-content">
								<div class="alert alert-warning">
									<button data-dismiss="alert" class="close" type="button">×</button>
									<h4 class="alert-heading">Warning!</h4>
									<p>Best check yo self, you haven no tasks. Let's add some</p>
								</div>
								<div class="container">
								<button class="AddToDo btn btn-primary">Add new</button>
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
<style>
#dialog-confirm, #AddToDoItem, #UpdateToDoItem {
    display: none;
}
</style>
<div id="UpdateToDoItem" title="Update To Do Item">
	<p>Use the form below to update a to do item.</p>
	<?php //$this->load->view('todo/update'); ?>
</div>	
<div id="AddToDoItem" title="Add To Do Item">
	<p>Use the form below to add a to do item to the list.</p>
	<?php $this->load->view('todo/add'); ?>
</div>		

<div id="dialog-confirm" title="Deleting this item?">
<p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>Are you sure?</p>
</div>