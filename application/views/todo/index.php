<div class="container">
	<div class="row">
		<div class="col-lg-10 col-sm-11" id="content">
			<?php if ($flash_message): ?>
			<div class="alert alert-success">
				<button data-dismiss="alert" class="close" type="button">×</button>
				<?php echo $flash_message ; ?>
			</div>
			<?php endif ; ?>
<table id="taskList" class="taskList">
 <tbody />  
</table>
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
										<div id="loader"><img src="<?php echo base_url("assets/img/spinner-mini.gif");?>" alt="loading..."></div>
									</ul>
								</div>	
							</div><!-- end: box-content -->									
							<div class="box-content">
								<button class="AddToDo btn btn-primary">Add new</button>
								<?php //$this->load->view('todo/add'); ?>
							</div>		

							<?php else: ?>
							<div class="box-content">
								<div class="alert alert-warning">
									<button data-dismiss="alert" class="close" type="button">×</button>
									<h4 class="alert-heading">Warning!</h4>
									<p>Best check yo self, you haven no tasks. Let's add some</p>
								</div>
								<div class="box-content">
									<div class="todo">
										<ul class="todo-list" id="active">
										</ul>
									</div>
								</div>
								<div class="container">
								<button class="AddToDo btn btn-primary">Add new</button>
								<?php //$this->load->view('todo/add'); ?>
								</div>
							</div>								
						<?php endif; ?>					
					</div>
				</div>

				<div class="col-lg-6 col-md-6">
					<div class="box">
						<div class="box-header-green">
							<h2><i class="icon-check"></i>Completed List</h2>
						</div>
						<?php if($completed_todos): ?>
							<div class="box-content">
								<div class="todo">
									<ul class="todo-list" id="completed">
										<div id="loader2"><img src="<?php echo base_url("assets/img/spinner-mini.gif");?>" alt="loading..."></div>
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
