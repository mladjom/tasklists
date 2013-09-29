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
			
    $('body').on('click', 'a.getlist', function (e) {
        var url = $(this).attr('href');
        $.get(url, function (data) {
            $("#content").html(data);
            //alert( "Load was performed." );
        });
        e.preventDefault();
    });
    //Update a to do item
    $("body").on("click", ".UpdateToDo", function (e) {
        id = $(this).attr('href');

        var $this = $(this);
        if ($this.attr('editing') != '1') {
            $this.text('save').attr('editing', 1);
            $(this).parent().find('.editable').each(function () {
                var data_id = $(this).attr('data-id');
                var input = $('<input data-id="' + data_id + '" class="editing" />').val($(this).text());
                $(this).replaceWith(input);
            });
        } else {
            $this.text('edit').removeAttr('editing');
            $(this).parent().find('input.editing').each(function () {
                var data_id = $(this).attr('data-id');
                var span = $('<span data-id="' + data_id + '" class="editable" />').text($(this).val());
                $(this).replaceWith(span);
            });

            var title = $(this).parent().find('[data-id="title"]').text();
						
						var description = $(this).parent().find('[data-id="description"]').text();

            //console.log( title + description ) ; 	    

            $.ajax({
                url: id,
                type: "POST",
                data: {
                    'title': title,
                    'description': description
                },
                success: function () {}
            })

        }

        e.preventDefault();
    });
    //Update list
    $("body").on("click", ".updateList", function (e) {
        id = $(this).attr('href');
				var $this = $(this);
        if ($this.attr('editing') != '1') {
            $this.text('save').attr('editing', 1);
						$(this).parent().find('.editable').each(function () {
	         			datalink =	$(this).parent().attr('href');
								$(this).parent().removeAttr('href');
    				 		$(this).parent().removeClass('getlist');
								var data_id = $(this).attr('data-id');
								var input = $('<input data-id="' + data_id + '" class="editing" />').val($(this).text());
                $(this).replaceWith(input);
            });
        } else {
            $this.text('edit').removeAttr('editing');
            $(this).parent().find('input.editing').each(function () {
    				 		$(this).parent().addClass('getlist');
								$(this).parent().attr("href", datalink);
								var data_id = $(this).attr('data-id');
                var span = $('<span data-id="' + data_id + '" class="editable" />').text($(this).val());
                $(this).replaceWith(span);
						});

            var list_name = $(this).parent().find('[data-id="list_name"]').text();

            console.log( list_name ) ; 	    
            console.log( datalink ) ; 	    

            $.ajax({
                url: id,
                type: "POST",
                data: {
                    'list_name': list_name,
                },
                success: function () {}
            })

        }

        e.preventDefault();
    });
			
			$("body").on("click", ".active", function(e){
				id = $(this).attr('href');
				$.ajax({
						url: id,
						type: "POST",
						success: function (html) {
							var url= '<?php echo base_url().'todo/front';?>';
							$('#content').load(url);
						},
						complete: function(){
							//alert('Completed.');                
						}
				})

				e.preventDefault();
			});


			$("body").on("click", ".activeList", function(e){
				id = $(this).attr('href');
				listsid = $(".listsid").attr('href');

				$.ajax({
						url: id,
						type: "POST",
						success: function (html) {
							$('#content').load(listsid);
						},
						complete: function(){

							//alert('Completed.');                
						}
				})

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
				
				
				
				var addList = $("#addListDialog").dialog({

						// Set the dialog to be a modal meaning all other elements on the page will be disabled.
						modal: true,
		
						// Set autoOpen to False as we don't want the dialog opening on page load.
						autoOpen: false,
		
						// Define the dialogs buttons
						buttons: {
		
								// Button for adding a to-do item
								"Add new list": function () {
		
		
										$.ajax({
												url: '<?php echo base_url().'todo/add_list';?>',
												data: $('form').serialize(),
												type: "POST",
												success: function (html) {
													var url= '<?php echo base_url().'todo/sidebar';?>';
													$('#sidebar-left').load(url);
												},
												complete: function(){
          								//alert('Completed.');                
												}
										})
		
		
										// Close the dialog
										$(this).dialog("close");
										// Clear the fields in the dialog
										$("#list_name").val("");
								},
		
								// Button for cancelling adding a new to-do item
								"Cancel": function () {
		
										// close the dialog
										$(this).dialog("close");
		
										// Clear the field in the dialog
										$("#list_name").val("");
								}
						}
				});
		$("body").on("click", ".addList", function (e) {
				// call our variable that defines our Add To-Do Dialog and 
				addList.dialog('open');
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

		$("ul").on("click", ".deleteList", function (e) {
		
				id = $(this).attr('href');
				del_id = $(this).parent().attr("class");
		
				$('#DeleteConfirm').dialog('open');
				e.preventDefault();
		
		});


}); // Closing $(document).ready()
</script>
<style>
#DeleteConfirm, #AddToDoItem, #addListTodoItem, #addListDialog{
    display: none;
}
#loader { display: none; padding-top: 10px; position:relative; bottom: 50%; left: 45%;}
#loader2 { display: none; padding-top: 10px; position:relative; bottom: 50%; left: 45%;}
</style>
<div id="addListDialog" title="Add New List">
	<p>Use the form below to add a new list.</p>
	<?php $this->load->view('todo/add_list'); ?>
</div>
<div id="AddToDoItem" title="Add To Do Item">
	<p>Use the form below to add a to do item to the list.</p>
	<?php $this->load->view('todo/add'); ?>
</div>	
<div id="DeleteConfirm" title="Deleting this item?">
<p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>Are you sure?</p>
</div>


</body>
</html>


