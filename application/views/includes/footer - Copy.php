		</div><!-- end: row -->
	</div><!-- end: container -->		
	<footer>
			<p>
				<span class="pull-left">&copy; 2013 <a href="http://www.divinedeloper.com/">Divine Developer</a></span>
				<span class="pull-right text-right hidden-phone">Powered by: CodeIgniter, Bootstrap and Jquery</span>
			</p>
		</footer>
		<!-- Placed at the end of the document so the pages load faster -->
		<!-- page scripts -->		
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>		
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
		<script type='text/javascript' src='<?php echo base_url("assets/js/vendor/modernizr-2.6.2.min.js");?>'></script>
		<script type='text/javascript' src='<?php echo base_url("assets/js/plugins.js");?>'></script>	
		<script type='text/javascript' src='<?php echo base_url("assets/js/main.js");?>'></script>
		<script type="text/javascript">
		$(document).ready(function () {
		
				var id;
				var del_id;
		
				// Configuring the delete confirmation dialog
				$("#dialog-confirm").dialog({
						resizable: false,
						height: 140,
						autoOpen: false,
						modal: true,
						buttons: {
		
								'Yes': function () {
		
										$.ajax({
												url: id,
												type: "POST",
												success: function () {
														$('#dialog-confirm').dialog('close');
												}
										})
										del_id = del_id;
										$('li#' + del_id).fadeOut(function () {
												$(this).remove();
										});
								},
		
								'No': function () {
										$(this).dialog('close');
								}
		
						}
		
				});
		
				$(".delete").on("click", function (e) {
						id = $(this).attr('href');
						del_id = $(this).parent().attr("id");
		
						$('#dialog-confirm').dialog('open');
						e.preventDefault();
		
				});
		
		
				//Add a to do item
				// Define the dialog for adding a new todo item.  Assign it to a variable so 
				// that it can be reused easily.
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
												url: 'add',
												data: $('form').serialize(),
												type: "POST",
												success: function (html) {
		
														$("ul#active").append("<li>" +
																"<td>" + title + "</td>" +
																"<td>" + description + "</td>" +
																"</li>");
		
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
				$(".AddToDo").on("click", function () {
						// call our variable that defines our Add To-Do Dialog and 
						addToDo.dialog('open');
				});
		
		
/*				$('#add').submit(function () {
		
						$.ajax({
								url: 'add',
								data: $('form').serialize(),
								type: "POST",
								success: function (add) {}
						})
						return false;
				})*/
		
		
		}); // Closing $(document).ready()
		
		</script>
  </body>
</html>
