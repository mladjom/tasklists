		</div><!-- end: row -->
	</div><!-- end: container -->		
	<footer>
			<p>
				<span class="pull-left">&copy; 2013 <a href="http://www.divinedeloper.com/">Divine Developer</a></span>
				<span class="pull-right text-right hidden-phone">Powered by: CodeIgniter, Bootstrap and Jquery</span>
			</p>
		</footer>
<script type='text/javascript' language='javascript'>
$(window).load(function() {

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
												url: '<?php echo base_url().'todo/add';?>',
												data: $('form').serialize(),
												type: "POST",
												success: function (html) {
		
												li = $('<li/>');
												li.append("<span class='todo-actions'><a class='active' href='http://todo.divinedeveloper.com/todo/complete/" + id + "'><i class='icon-check-empty'></i></a></span>");
												li.append("<span class='title'>" + title + "</span>");
												li.append("<span class='description'>" + description + "</span>");
												li.append("<a class='btn btn-success btn-xs updateToDo' href='http://todo.divinedeveloper.com/todo/update/" + id + "'>update</a>");
												li.append("<a class='btn btn-danger btn-xs delete' href='http://todo.divinedeveloper.com/todo/delete/" + id + "'>delete</a>");
												$('ul#active').append(li);
		    								//window.location.reload(true);
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
				$("body").on("click", ".AddToDo", function(e){
						// call our variable that defines our Add To-Do Dialog and 
						addToDo.dialog('open');
				});


				var updateToDo = $("#UpdateToDoItem").dialog({
						// Set the dialog to be a modal meaning all other elements on the page will be disabled.
						modal: true,
		
						// Set autoOpen to False as we don't want the dialog opening on page load.
						autoOpen: false,
		
						// Define the dialogs buttons
						buttons: {
		
								// Button for adding a to-do item
								"Update to do item": function () {
		
										var title = $("#title").val(),
												description = $("#description").val();
		
										$.ajax({
												url: 'update',
												data: $('form').serialize(),
												type: "POST",
												success: function (html) {
		
		
												}
										})
		
		
										// Close the dialog
										$(this).dialog("close");
		
								},
		
								// Button for cancelling adding a new to-do item
								"Cancel": function () {
		
										// close the dialog
										$(this).dialog("close");
		
				
								}
						}
				});	

				$("body").on("click", ".UpdateToDo", function(e){
						// call our variable that defines our Update To-Do Dialog and 
			
						updateToDo.dialog('open');
						e.preventDefault();

				});				
				
				
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
		
						$('#dialog-confirm').dialog('open');
						e.preventDefault();
		
				});


  $("#form-login").validate({

    errorElement: "span",
		errorClass:"alert-danger",

    rules: {

      username: {
        required: true,
        minlength: 5,
        maxlength:25
      },
      password: {
        required: true,
        minlength: 6,
        maxlength:12
      }
    },
    messages: {

      username: {
        required: "Username is required."
      },

      password: {
        required: "Please provide a password.",
        minlength: "Your password must be at least 5 characters long",
        maxlength: "Password can not be more than 25 characters"
      }
      

    },

    errorPlacement: function(error, element, errorClass) {
      error.appendTo(element.parent());
    }

  });
$("#form-signup").validate({

errorElement: "span",
errorClass:"alert-danger",

rules: {

    username: {
        required: true,
        minlength: 5,
        maxlength: 25,
        remote: {
            url: "<?php echo base_url().'site/register_username_exists';?>",
            type: "post",
            data: {
                username: function () {
                    return $("#username").val();
                }
            }
        }
    },
    email: {
        required: true,
        email: true,
        remote: {
            url: "<?php echo base_url().'site/register_email_exists';?>",
            type: "post",
            data: {
                email: function () {
                    return $("#email").val();
                }
            }
        }
    },

    password: {
        required: true,
        minlength: 6,
        maxlength: 12
    },
    cpassword: {
        equalTo: "#password"
    }
},

messages: {

    username: {
        required: "Username is required.",
        minlength: 'min lenght',
        maxlength: 'max lenght',
        lettersonly: 'and even this',
        remote: 'Username already exist. Log in to your existing account.'

    },

    password: {
        required: "Please provide a password.",
        minlength: "Your password must be at least 6 characters long",
        maxlength: "Password can not be more than 12 characters"
    },

    cpassword: {
        equalTo: "Password is not matching!"
    },

    email: {
        required: 'Email address is required',
        email: 'Please enter a valid email address',
        remote: 'Email already used. Log in to your existing account.'
    }
},

errorPlacement: function (error, element, errorClass) {
    error.appendTo(element.parent());
}

});


}); // Closing $(document).ready()
</script>
<style>
#dialog-confirm, #AddToDoItem, #UpdateToDoItem {
    display: none;
}
#loader { display: none; padding-top: 10px; position:relative; bottom: 50%; left: 45%;}
#loader2 { display: none; padding-top: 10px; position:relative; bottom: 50%; left: 45%;}
</style>
<div id="UpdateToDoItem" title="Update To Do Item">
	<p>Use the form below to update a to do item.</p>
</div>	
<div id="AddToDoItem" title="Add To Do Item">
	<p>Use the form below to add a to do item to the list.</p>
	<?php $this->load->view('todo/add'); ?>
</div>		
<div id="dialog-confirm" title="Deleting this item?">
<p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>Are you sure?</p>
</div>
</body>
</html>


