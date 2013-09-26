<?php						
	//echo '<pre>';print_r($current_list); echo '</pre>';
	//echo '<pre>';print_r($active_list_todos); echo '</pre>';
	//echo '<pre>';print_r($completed_list_todos); echo '</pre>';
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
		 				if($active_list_todos):?>
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
						<?php if($completed_list_todos): ?>
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
<script type='text/javascript' language='javascript'>
$(window).load(function() {
$.getJSON('<?php echo base_url().'todo/allTodos';?>', function(data) {
 	$("#loader").css("display", "block");
  $.each(data, function(i, item){
    if(item.lists_id === "<?php echo $current_list->list_id; ?>" && item.status === "1"){
    	li = $('<li/>');
    	li.append("<span class='todo-actions'><a class='active' href='http://todo.divinedeveloper.com/todo/complete/" + item.id + "'><i class='icon-check-empty'></i></a></span>");
			li.append("<span class='title'>" + item.title + "</span>");
			li.append("<span class='description'>" + item.description + "</span>");
			li.append("<a class='btn btn-success btn-xs UpdateToDo' href='http://todo.divinedeveloper.com/todo/update/" + item.id + "'>update</a>");
			li.append("<a class='btn btn-danger btn-xs delete' href='http://todo.divinedeveloper.com/todo/delete/" + item.id + "'>delete</a>");
			li.addClass(item.id);
    	$('ul#active').append(li);
			
    }
  });

  $.each(data, function(i, item){
    if(item.lists_id === "<?php echo $current_list->list_id; ?>" && item.status === "0"){
    	li = $('<li/>');
    	li.append("<span class='todo-actions'><a class='active' href='http://todo.divinedeveloper.com/todo/complete/" + item.id + "'><i class='icon-check'></i></a></span>");
			li.append("<span class='title'>" + item.title + "</span>");
			li.append("<span class='description'>" + item.description + "</span>");
			li.append("<a class='btn btn-danger btn-xs delete' href='http://todo.divinedeveloper.com/todo/delete/" + item.id + "'>delete</a>");
			li.addClass(item.id);
    	$('ul#completed').append(li);
			
    }


 	$("#loader").css("display", "none");
  });
});


}); // Closing $(document).ready()

</script>