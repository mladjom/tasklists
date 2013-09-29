<?php	echo '<a class="listsid" href="';echo base_url().'todo/lists/';echo $current_list->list_id; echo '"></a>'; ?>

<?php						
	//echo '<pre>';print_r($current_list); echo '</pre>';
	//echo '<pre>';print_r($active_list_todos); echo '</pre>';
	//echo '<pre>';print_r($completed_list_todos); echo '</pre>';
 ?>
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
									</ul>
								</div>	
							</div><!-- end: box-content -->									
							<div class="box-content">
								<button class="addListTodo btn btn-primary">Add new</button>
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
								<button class="addListTodo btn btn-primary">Add new</button>
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
<script type='text/javascript' language='javascript'>
$(document).ready(function() {

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
										del_id = del_id;
										$('li.' + del_id).fadeOut(function () {
												$(this).remove();
										});
								},
		
								'No': function () {
										$(this).dialog('close');
								}
		
						}
		
				});

					$("ul").on("click", ".delete", function(e){
				
						id = $(this).attr('href');
						del_id = $(this).parent().attr("class");
		
						$('#DeleteConfirm').dialog('open');
						e.preventDefault();
		
				});

		var addListTodo = $("#addListTodoItem");
		addListTodo.dialog({
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
													var url= 'lists/<?php echo $current_list->list_id; ?>';
													$('#content').load(url);
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

				
				$(".box-content").on("click", ".addListTodo", function(e){
						// call our variable that defines our Add To-Do Dialog and 
						addListTodo.dialog('close');

						addListTodo.dialog('open');

				});	

$(function(){
		$.getJSON('<?php echo base_url().'todo/allTodos';?>', function(data) {
			
			$("#loader").css("display", "block");
			$.each(data, function(i, item){
				if(item.lists_id === "<?php echo $current_list->list_id; ?>" && item.status === "1"){
					li = $('<li/>');
					li.append("<span class='todo-actions'><a class='activeList' href='http://todo.divinedeveloper.com/todo/complete/" + item.id + "'><i class='icon-check-empty'></i></a></span>");
					li.append("<span class='editable title' data-id='title'>" + item.title + "</span> ");
					li.append("<span class='editable description' data-id='description'>" + item.description + "</span>");
					li.append("<a class='btn btn-success btn-xs UpdateToDo' href='http://todo.divinedeveloper.com/todo/update/" + item.id + "'>edit</a>");
					li.append("<a class='btn btn-danger btn-xs delete' href='http://todo.divinedeveloper.com/todo/delete/" + item.id + "'>delete</a>");
					li.addClass(item.id);
					$('ul#active').append(li);
					
				}
			});
		
			$.each(data, function(i, item){
				if(item.lists_id === "<?php echo $current_list->list_id; ?>" && item.status === "0"){
					li = $('<li/>');
					li.append("<span class='todo-actions'><a class='activeList' href='http://todo.divinedeveloper.com/todo/active/" + item.id + "'><i class='icon-check'></i></a></span>");
					li.append("<span class='title'>" + item.title + "</span> ");
					li.append("<span class='description'>" + item.description + "</span>");
					li.append("<a class='btn btn-danger btn-xs delete' href='http://todo.divinedeveloper.com/todo/delete/" + item.id + "'>delete</a>");
					li.addClass(item.id);
					$('ul#completed').append(li);
					
				}
		
			$("#loader").css("display", "none");
			});
		
		});
});

		$("ul").on("click", ".deleteList", function (e) {
		
				id = $(this).attr('href');
				del_id = $(this).parent().attr("class");
		
				$('#DeleteConfirm').dialog('open');
				e.preventDefault();
		
		});



}); // Closing $(document).ready()
</script>
<style>
#loader { display: none; padding-top: 10px; position:relative; bottom: 50%; left: 45%;}
#loader2 { display: none; padding-top: 10px; position:relative; bottom: 50%; left: 45%;}
</style>
<div id="addListTodoItem" title="Add To Do Item">
	<p>Use the form below to add a to do item to the list.</p>
	<?php $this->load->view('todo/add_list_todo'); ?>
</div>
