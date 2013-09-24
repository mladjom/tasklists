$(document).ready(function(){
   
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

		
				// Define a on click event that will open the dialog to add a new todo list.
				// We use on instead of just binding the click event because we will be 
				// dynamically adding new Add To Do buttons with each new tab.
				$(".UpdateToDo").on("click", function (e) {
						// call our variable that defines our Add To-Do Dialog and 
						updateToDo.dialog('open');
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

  $("#form-login").validate({

    errorElement: "span",

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

    errorPlacement: function(error, element) {
      error.appendTo(element.parent());
    }

  });

  $("#form-signup").validate({

    errorElement: "span",

    rules: {

      username: {
        required: true,
        minlength: 5,
        maxlength:25,
        lettersonly: true,
    		remote: {
      		url: "http://todo.divinedeveloper.com/site/register_username_exists",
      		type: "post",
      		data: {
        		username: function(){ return $("#username").val(); }
      		}
    		}
      },
			email: {
   			required: true,
    		email: true,
    		remote: {
      		url: "http://todo.divinedeveloper.com/site/register_email_exists",
      		type: "post",
      		data: {
        		email: function(){ return $("#email").val(); }
      		}
    		}
  		},
  
      password: {
        required: true,
        minlength: 6,
        maxlength:12
      },
      cpassword: {
        equalTo: "#password"
      }
    },

    messages: {

      username: {
        required: "Username is required.",
        minlength: 'min lenght',
        maxlength:'max lenght',
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
			
    errorPlacement: function(error, element) {
      error.appendTo(element.parent());
    }

  });

		
		
}); // Closing $(document).ready()

