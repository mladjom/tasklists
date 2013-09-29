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
										<div id="loader"><img src="<?php echo base_url("assets/img/spinner-mini.gif");?>" alt="loading..."></div>
									</ul>
								</div>	
							</div><!-- end: box-content -->									
							<div class="box-content">
								<button class="addToDo btn btn-primary">Add new</button>
								<?php //$this->load->view('todo/add'); ?>
							</div>		
<?php /*?>							<?php else: ?>
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
							</div><?php */?>								
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
<?php /*?>						<?php else: ?>
						<div class="box-content">
							<div class="alert alert-warning">
								<button data-dismiss="alert" class="close" type="button">×</button>
								<h4 class="alert-heading">Warning!</h4>
								<p>Best check yo self, you haven't completed anything yet.</p>
							</div>
						</div><?php */?>
						<?php endif ;?>	
					</div><!-- end: box -->	
				</div><!-- end: col -->
			</div>	

<script type='text/javascript' language='javascript'>
$(document).ready(function() {

$.getJSON('<?php echo base_url().'todo/allTodos';?>', function(data) {
 	
	$("#loader").css("display", "block");
  $.each(data, function(i, item){
    if(item.status === "1"){
    	li = $('<li/>');
    	li.append("<span class='todo-actions'><a class='active' href='http://todo.divinedeveloper.com/todo/complete/" + item.id + "'><i class='icon-check-empty'></i></a></span>");
			li.append("<span class='editable title' data-id='title'>" + item.title + "</span> ");
			li.append("<span class='editable description' data-id='description'>" + item.description + "</span>");
			li.append("<a class='btn btn-success btn-xs UpdateToDo' href='http://todo.divinedeveloper.com/todo/update/" + item.id + "'>edit</a>");
			li.append("<a class='btn btn-danger btn-xs delete' href='http://todo.divinedeveloper.com/todo/delete/" + item.id + "'>delete</a>");
			li.addClass(item.id);
    	$('ul#active').append(li);
			
    }
  });

  $.each(data, function(i, item){
    if(item.status === "0"){
    	li = $('<li/>');
    	li.append("<span class='todo-actions'><a class='active' href='http://todo.divinedeveloper.com/todo/active/" + item.id + "'><i class='icon-check'></i></a></span>");
			li.append("<span class='title'>" + item.title + "</span> ");
			li.append("<span class='description'>" + item.description + "</span>");
			li.append("<a class='btn btn-danger btn-xs delete' href='http://todo.divinedeveloper.com/todo/delete/" + item.id + "'>delete</a>");
			li.addClass(item.id);
    	$('ul#completed').append(li);
			
    }

 	$("#loader").css("display", "none");
  });
});

		var id;
		var del_id;
		
		 // Configuring the delete confirmation dialog
		$("#DeleteConfirm").dialog({
				resizable: false,
				autoOpen: false,
				modal: true,
				buttons: {
		
						'Yes': function () {
		
								$.ajax({
										url: id,
										type: "POST",
										success: function () {
												$('#DeleteConfirm').dialog('close');
										}
								})
								$(this).dialog("close");
		
								del_id = del_id;
								$('li.' + del_id).fadeOut(function () {
										$(this).remove();
								});
						},
		
						'No': function () {
								$(this).dialog("close");
						}
		
				}
		
		});
		$("ul").on("click", ".delete", function (e) {
		
				id = $(this).attr('href');
				del_id = $(this).parent().attr("class");
		
				$('#DeleteConfirm').dialog('open');
				e.preventDefault();
		
		});


				var addToDo = $("#AddToDoItem").dialog({

						// Set the dialog to be a modal meaning all other elements on the page will be disabled.
						modal: true,
		
						// Set autoOpen to False as we don't want the dialog opening on page load.
						autoOpen: false,
		
						// Define the dialogs buttons
						buttons: {
		
								// Button for adding a to-do item
								"Add to do item": function () {
		
										var title = $("#title").val(),
												description = $("#description").val();
		
										$.ajax({
												url: '<?php echo base_url().'todo/add';?>',
												data: $('form').serialize(),
												type: "POST",
												success: function (html) {
													var url= '<?php echo base_url().'todo/front';?>';
													$('#content').load(url);
												},
												complete: function(){
          								//alert('Completed.');                
												}
										})
		
		
										// Close the dialog
										$(this).dialog("close");
										// Clear the fields in the dialog
										$("#title, #description").val("");
								},
		
								// Button for cancelling adding a new to-do item
								"Cancel": function () {
		
										// close the dialog
										$(this).dialog("close");
		
										// Clear the field in the dialog
										$("#title, #description").val("");
								}
						}
				});

		 // Define a on click event that will open the dialog to add a new todo list.
		 // We use on instead of just binding the click event because we will be 
		 // dynamically adding new Add To Do buttons with each new tab.
		$("body").on("click", ".addToDo", function (e) {
				// call our variable that defines our Add To-Do Dialog and 
				addToDo.dialog('open');
		});


}); // Closing $(document).ready()

</script>	
	
