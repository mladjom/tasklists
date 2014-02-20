<?php
	$page_title = lang('home');	// Title used throughout page
	
	echo doctype(config_item('doctype'));
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title><?php echo config_item('site_title').config_item('title_splitter').$page_title; ?></title>
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url().config_item('theme_dir'); ?>css/combo.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url().config_item('theme_dir'); ?>css/style.css.php" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url().config_item('theme_dir'); ?>js/jquery-ui/css/ui-lightness/jquery-ui-1.7.2.custom.css" />
	<link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico" />
</head>
<body>

<!-- The div id below is based on YUI Grids -->
<div id="doc2">

		<!-- START: hd -->
		<?php
			$hd = array('page_title'=>$page_title);
			$this->load->view('section/hd', $hd);
		?>
		<!-- END: hd -->
		
		<!-- START: bd -->
		<div id="bd">
			
			<div id="bd-content">
								
				<!-- START: tasklist-grid: holds all of our tasklists -->
				<ul id="tasklist-grid">
					<li class="tasklist tasklist-grid-controls">
						<a href="#" class="add-tasklist">+ <span class="small"><?php echo lang('add_tasklist'); ?></span></a>
					</li>
					
					<!-- START: tasklist templates -->
					<!-- tasklist templates are used to create new tasklists and to perform add/edit actions on tasks -->
					<li class="tasklist tasklist-template">
						<h3><a href="#"><?php echo lang('default_tasklist_name'); ?></a></h3>
						<div class="tasklist-controls">
							<span class="num-tasks fade">0&#47;0</span>
							<form method="post" action="<?php echo site_url('tasklist/edit'); ?>">
								<input type="hidden" name="tasklist_id" class="tasklist-id" value="" />
								<span><button type="submit" name="edit_tasklist" class="edit-tasklist">&#35;</button></span>
							</form>
							<form method="post" action="<?php echo site_url('tasklist/delete'); ?>>
								<input type="hidden" name="tasklist_id" class="tasklist-id" value="" />
								<span><button type="submit" name="delete_tasklist" class="delete-tasklist">&times;</button></span>
							</form>
						</div>
						<div class="tasklist-editor">
							<form method="post" action="<?php echo site_url('tasklist/update'); ?>">
								<label for="tasklist_title"><?php echo lang('list_name'); ?>:</label>
								<input type="text" name="tasklist_title" class="tasklist-title" value="" />
								<input type="hidden" name="tasklist_id" class="tasklist-id" value="" />
								<span><button type="submit" name="save_tasklist" class="save-tasklist"><?php echo lang('save'); ?></button></span>
							</form>
						</div>
						<ul>
							<li class="task edit-task-template">
								<form method="post" action="<?php echo site_url('task/update'); ?>">
									<label for="task_title"><?php echo lang('edit_task'); ?>:</label>
									<input type="text" name="task_title" class="task-title" value="" />
									<input type="hidden" name="task_id" class="task-id" value="" />
									<span><button type="submit" name="save_task" class="save-task"><?php echo lang('save'); ?></button></span>
								</form>
							</li>
							<li class="task add-task-template">
								<form method="post" action="<?php echo site_url('task/add'); ?>">
									<label for="task_title"><?php echo lang('add_task'); ?>:</label>
									<input type="text" name="task_title" class="task-title" value="" />
									<span><button type="submit" name="save_task" class="save-task"><?php echo lang('save'); ?></button></span>
								</form>
							</li>
							<li class="task task-template">
								<div class="task-controls-1"><input type="checkbox" class="task-checkbox" /></div>
								<div class="task-body"><?php echo lang('default_task_name'); ?></div>
								<div class="task-controls-2">
									<form method="post">
										<input type="hidden" name="task_id" class="task-id" value="" />
										<span><button type="submit" name="edit_task" class="edit-task">&#35;</button></span>
									</form>
									<form method="post">
										<input type="hidden" name="task_id" class="taskt-id" value="" />
										<span><button type="submit" name="delete_task" class="delete-task">&times;</button></span>
									</form>
								</div>
							</li>
							<li class="task add-task">
								<form method="post" action="<?php echo site_url('task/add'); ?>">
									<label for="task_title"><?php echo lang('add_task'); ?>:</label>
									<input type="text" name="task_title" class="task-title" value="" />
									<span><button type="submit" name="save_task" class="save-task"><?php echo lang('save'); ?></button></span>
								</form>
							</li>
						</ul>
					</li>
					<!-- END: tasklist templates -->
					
					<?php for($j=0; $j<0; $j++): ?>
					<li class="tasklist tasklist-expanded" id="tasklist-<?php echo $j; ?>">
						<h3><a href="#"><?php echo lang('tasklist'); ?> <?php echo $j; ?></a></h3>
						<div class="tasklist-controls">
							<span class="num-tasks fade">0&#47;0</span>
							<form method="post" action="<?php echo site_url('tasklist/edit'); ?>>
								<input type="hidden" name="tasklist_id" class="tasklist-id" value="<?php echo $j; ?>" />
								<span><button type="submit" name="edit_tasklist" class="edit-tasklist">&#35;</button></span>
							</form>
							<form method="post" action="<?php echo site_url('tasklist/delete'); ?>>
								<input type="hidden" name="tasklist_id" class="tasklist-id" value="<?php echo $j; ?>" />
								<span><button type="submit" name="delete_tasklist" class="delete-tasklist">&times;</button></span>
							</form>
						</div>
						<ul>
							<?php for($i=0; $i<3; $i++): ?>
							<li class="task completed" id="task-<?php echo $i; ?>">
								<div class="task-controls-1"><input type="checkbox" class="task-checkbox" /></div>
								<div class="task-body">task <?php echo $i ?></div>
								<div class="task-controls-2">
									<form method="post">
										<input type="hidden" name="task_id" class="task-id" value="" />
										<span><button type="submit" name="edit_task" class="edit-task">&#35;</button></span>
									</form>
									<form method="post">
										<input type="hidden" name="task_id" class="taskt-id" value="" />
										<span><button type="submit" name="delete_task" class="delete-task">&times;</button></span>
									</form>
								</div>
							</li>
							<?php endfor; ?>
							<li class="task add-task">
								<form method="post" action="<?php echo site_url('task/add'); ?>">
									<label for="task_title"><?php echo lang('add_task'); ?>:</label>
									<input type="text" name="task_title" class="task-title" value="" />
									<span><button type="submit" name="save_task" class="save-task"><?php echo lang('save'); ?></button></span>
								</form>
							</li>
						</ul>
					</li>
					<?php endfor; ?>
					<li class="tasklist tasklist-grid-controls">
						<a href="#" class="add-tasklist">+ <span class="small"><?php echo lang('add_tasklist'); ?></span></a>
					</li>
				</ul>
				<!-- END: tasklist-grid -->
				
			</div>
		</div>
		<!-- END: bd -->
		
		<!-- START: ft -->
		<?php $this->load->view('section/ft'); ?>
		<!-- END: ft -->
		
		<!-- START: copyright -->
		<?php $this->load->view('section/copyright'); ?>
		<!-- END: copyright -->
	
</div>
<script type="text/javascript" src="<?php echo base_url().config_item('theme_dir'); ?>js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url().config_item('theme_dir'); ?>js/jquery-ui/js/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		
		// Update [tasks completed] / [total tasks]
		function updateTaskCounts() {
			$('.tasklist').each(function(n, obj) {
				$(obj).children('.tasklist-controls').children('.num-tasks').html(Array(
					$(obj).children('ul').children('.completed').length,
					'&#47;',
					$(obj).children('ul').children('li:not(.add-task, .edit-task-template, .add-task-template, .task-template)').length
				).join(''));
			});
		}
		
		
		// Toggle display for tasklist-grid-controls
		// This basically covers whether or not to display a second add task button
		function updateTasklistGridControls() {
			if($('.tasklist:not(.tasklist-template, .tasklist-grid-controls)').length == 0) {
				$('.tasklist-grid-controls:last').hide();
			}
			else {
				$('.tasklist-grid-controls:last').show();
			}
		}
		
		
		// Shows an error message
		function throwError(msg) {
			console.log('throwError: ' + msg);	
		}
		
		
		// Round corners on matching selectors
		var roundCorners = Array(
			'#hd',
			'#instructions',
			'.tasklist',
			'.add-tasklist',
			'.delete-tasklist',
			'.edit-tasklist',
			'.task',
			'.add-task',
			'.delete-task',
			'.edit-task',
			'.tasklist-title',
			'.task-title',
			'.save-task',
			'.save-tasklist',
			'#toggle-tasklist-grid',
			'.task-title'
		);
		$(roundCorners.join(', ')).addClass('ui-corner-all');
		
		
		// Make tasklist-grid sortable
		// This lets you drag and drop tasklists
		$('#tasklist-grid').sortable({
			items: 'li:not(.tasklist-grid-controls)'
		});
		$('#tasklist-grid').disableSelection();
		$('#tasklist-grid').bind('sortupdate', function(event, ui) {
			$('#tasklist-grid').effect('highlight', {color: '#F0F2DD'});
		});	
		
		
		// Make each task sortable
		// This lets you drag and drop tasks within a given tasklist as well
		// as across different tasklists
		$('.tasklist ul').sortable({
			connectWith: '.tasklist ul',
			items: 'li:not(.add-task, .edit-task-template, .add-task-template)'
		});
		$('.tasklist ul').disableSelection();
		$('.tasklist ul').bind('sortupdate', function() {
			$(this).parent().effect('highlight', {color: '#F0F2DD'});
			
			// If the tasklist is expanded, all tasks should be displayed.
			// This is important to ensure that when a task is moved
			// from one tasklist to another, that the task assumes the
			// the same display as other tasks in the receiving list.
			if($(this).closest('.tasklist').hasClass('tasklist-expanded')) {
				$(this).closest('.tasklist').children('ul').children('li:not(.edit-task-template, .add-task-template, .task-template)').each(function(n, obj) {
					if($(obj).css('display') == 'none') {
						$(obj).toggle();
					}
				});
			}
			else {
				$(this).closest('.tasklist').children('ul').children('li').each(function(n, obj) {
					if($(obj).css('display') != 'none') {
						$(obj).toggle();
					}
				});
			}
			$('.tasklist:not(.tasklist-template, .tasklist-grid-controls)').length
			
			updateTaskCounts();
		});
		
		
		// Toggle display of a given tasklist
		$('.tasklist h3 a').click(function(e) {
			e.preventDefault();
			$(this).closest('.tasklist').children('ul').children('li:not(.edit-task-template, .add-task-template, .task-template)').toggle('fast');
			$(this).closest('.tasklist').children('ul').children('li:not(.add-task, .edit-task-template, .add-task-template, .task-template)').toggleClass('fade');
			$(this).closest('.tasklist').toggleClass('tasklist-expanded');
			$(this).closest('.tasklist').children('.tasklist-controls').children(':not(.num-tasks)').toggle();
		});
		
		
		// Toggle the completed status of a task based on its checkbox
		$('.task-checkbox').click(function(e) {
			$(this).closest('.task').toggleClass('completed');
			updateTaskCounts();
		});
		
		
		// Launch a given task into edit mode
		$('.edit-task').click(function(e) {
			e.preventDefault();
				
			// Clone the template so that we can retain assigned events and attributes
			$(this).closest('.task').after($('.edit-task-template:first').clone(true));
			
			
			var newTask = $(this).closest('.task').next('.edit-task-template');
			var taskBodyHtml = $(this).closest('.task').children('.task-body').html();
			
			newTask.children('form').children('input.task-title').val(taskBodyHtml);
			newTask.toggleClass('task-editor').removeClass('edit-task-template');
			if($(this).closest('.task').hasClass('completed')) {
				newTask.addClass('completed');
			}
			$(this).closest('.task').remove();
			newTask.children('form').children('input.task-id:first').val($(this).closest('.task').attr('id').split('-')[1]);
			newTask.children('form').children('input.task-title:first').focus();
		});
		
		
		// Save a given task and return it to normal display mode from edit mode
		$('.task').children('form').submit(function(e) {
			e.preventDefault();
			
			// Clone the template so that we can retain assigned events and attributes
			$(this).closest('.task').after($('.task-template:first').clone(true));
			var newTask = $(this).closest('.task').next('.task-template');
			var taskBodyHtml = $(this).closest('.task').children('form').children('.task-title').val();
			
			// If task is in add mode (as opposed to edit mode), add a new add-task element
			if($(this).closest('.task').hasClass('task-editor') == false) {
				$(this).closest('.tasklist ul').append($('.add-task-template:first').clone(true));
				$(this).closest('.tasklist ul').children('.add-task-template:last').toggle('fast').removeClass('add-task-template').addClass('add-task');
				$(this).closest('.tasklist ul').children('.add-task:last').children('form').children('input.task-title').focus();
				var myTask = $(this).closest('.task');
	
				// Post new task and get a return task_id
				$.ajax({
					type: 'POST',
					url: '<?php echo site_url('task/add/'.config_item('ajax_format')); ?>',
					data: $(this).closest('form').serialize(),
					dataType: '<?php echo config_item('ajax_format'); ?>',
					success: function(data, textStatus) {
						if(data.task_id) {
							newTask.attr({id: 'task-' + data.task_id});
						}
						else {
							throwError(data.msg);
						}
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {
						throwError('Could not process save request, please try again. Error details: ' + errorThrown);
					}
				});
			}
			else {
				// Post update a task
				$.ajax({
					type: 'POST',
					url: '<?php echo site_url('task/update/'.config_item('ajax_format')); ?>',
					data: $(this).closest('form').serialize(),
					dataType: '<?php echo config_item('ajax_format'); ?>',
					success: function(data, textStatus) {
						if(data.success != 1) {
							throwError(data.msg);
						}
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {
						throwError('Could not process save request, please try again. Error details: ' + errorThrown);
					}
				});
			}
			$(this).closest('.task').removeClass('task-editor')
			
			newTask.children('.task-body').html(taskBodyHtml);
			newTask.removeClass('task-template');
			if($(this).closest('.task').hasClass('completed')) {
				newTask.addClass('completed');
				newTask.children('.task-controls-1').children('.task-checkbox').attr({'checked':true});
			}
			else {
				newTask.children('.task-controls-1').children('.task-checkbox').attr({'checked':false});
			}
			
			$(this).closest('.task').remove();
			
			updateTaskCounts();
		});
		
		
		// Delete a task
		$('.delete-task').click(function(e) {
			e.preventDefault();
			
			// Post delete a tasklist
			$.ajax({
				type: 'POST',
				url: '<?php echo site_url('task/delete/'.config_item('ajax_format')); ?>',
				data: $(this).closest('form').serialize(),
				dataType: '<?php echo config_item('ajax_format'); ?>',
				success: function(data, textStatus) {
					if(data.success != 1) {
						throwError(data.msg);
					}
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					throwError('Could not process delete request, please try again. Error details: ' + errorThrown);
				}
			});
			
			$(this).closest('.task').remove();
			updateTaskCounts();
		});
		
		
		// Delete a tasklist
		$('.delete-tasklist').click(function(e) {
			e.preventDefault();
			$(this).closest('.tasklist').remove();
			
			// Post delete a tasklist
			$.ajax({
				type: 'POST',
				url: '<?php echo site_url('tasklist/delete/'.config_item('ajax_format')); ?>',
				data: $(this).closest('form').serialize(),
				dataType: '<?php echo config_item('ajax_format'); ?>',
				success: function(data, textStatus) {
					if(data.success != 1) {
						throwError(data.msg);
					}
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					throwError('Could not process delete request, please try again. Error details: ' + errorThrown);
				}
			});
			
			updateTasklistGridControls();
		});
		
		
		// Add a tasklist based on a template tasklist
		$('.add-tasklist').click(function(e) {
			e.preventDefault();
			
			// Clone the template so that we can retain assigned events and attributes
			$(this).closest('#tasklist-grid').children('.tasklist-grid-controls:first').after($('.tasklist-template:first').clone(true));
			
			var newTasklist = $(this).closest('#tasklist-grid').children('.tasklist-template:first');
			newTasklist.toggle();
			newTasklist.removeClass('tasklist-template');
			newTasklist.children('h3, .tasklist-controls, .tasklist-editor').toggle();
			newTasklist.children('ul').children('.add-task').toggle();
			newTasklist.children('.tasklist-editor').children('form').children('input.tasklist-title').focus();
			
			// just-added-tasklist keeps track of whether this was a newly added tasklist
			// If newly added, once the tasklist is saved, focus will be placed on the add-task field
			newTasklist.addClass('just-added-tasklist');
		
			updateTasklistGridControls();
		});
		
		
		// Launch tasklist into edit mode
		$('.edit-tasklist').click(function(e) {
			e.preventDefault();
			
			// Clone the template so that we can retain assigned events and attributes
			
			$(this).closest('.tasklist-controls').after($('.tasklist-editor:first').clone(true));
			var myTasklist = $(this).closest('.tasklist');
			myTasklist.children('.tasklist-editor, .tasklist-controls').children('form').children('input.tasklist-id').val(myTasklist.attr('id').split('-')[1]);
			myTasklist.children('h3, .tasklist-controls, .tasklist-editor').toggle();
			var myTasklistTitleHtml = myTasklist.children('h3').children('a').html();
			myTasklist.children('.tasklist-editor').children('form').children('.tasklist-title:first').val(myTasklistTitleHtml);
			myTasklist.children('.tasklist-editor').children('form').children('.tasklist-title:first').focus();
		});
		
		
		// Save a given tasklist and return it to normal display mode from edit mode
		$('.tasklist-editor').children('form').submit(function(e) {
			e.preventDefault();
						
			var myTasklist = $(this).closest('.tasklist');
			
			if(myTasklist.hasClass('just-added-tasklist')) {
			
				// Post new tasklist and get a return tasklist_id
				$.ajax({
					type: 'POST',
					url: '<?php echo site_url('tasklist/add/'.config_item('ajax_format')); ?>',
					data: $(this).closest('form').serialize(),
					dataType: '<?php echo config_item('ajax_format'); ?>',
					success: function(data, textStatus) {
						if(data.tasklist_id) {
							myTasklist.attr({id: 'tasklist-' + data.tasklist_id});
						}
						else {
							throwError(data.msg);
						}
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {
						throwError('Could not process save request, please try again. Error details: ' + errorThrown);
					}
				});
				
				myTasklist.removeClass('just-added-tasklist');
				myTasklist.children('ul').children('.add-task').toggle('fast');
				myTasklist.children('ul').children('.add-task').children('form').children('input.task-title').focus();
			}
			else {
				// Post update a tasklist
				$.ajax({
					type: 'POST',
					url: '<?php echo site_url('tasklist/update/'.config_item('ajax_format')); ?>',
					data: $(this).closest('form').serialize(),
					dataType: '<?php echo config_item('ajax_format'); ?>',
					success: function(data, textStatus) {
						if(data.success != 1) {
							throwError(data.msg);
						}
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {
						throwError('Could not process save request, please try again. Error details: ' + errorThrown);
					}
				});
			}
			
			var tasklistTitleHtml = $(this).closest('.tasklist-editor').children('form').children('input.tasklist-title').val();
			myTasklist.children('h3').children('a').html(tasklistTitleHtml);
			myTasklist.children('h3, .tasklist-controls, .tasklist-editor').toggle('fast');
			myTasklist.children('.tasklist-editor').remove();
		});
		
		// Start off with only one tasklist-controls if no tasklists
		updateTasklistGridControls();
	});
</script>
</body>
</html>
