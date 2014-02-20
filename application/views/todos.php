<div class="container">
<ul class="nav">
	<li <?php if($this->current_method == 'index') echo 'class="current"'?>>
		<a href="/">Your To-dos</a>

	</li>
	<li <?php if($this->current_method == 'add_todo') echo 'class="current"'?>>
		<a href="/todos/add_todo">Add a to-do</a><?= anchor('todos_add/', 'Add new to do', array('title' => 'Add new to do!')); ?>
	</li>
	<li <?php if($this->current_method == 'add_list') echo 'class="current"'?>>
		<a href="/todos/add_list">Add a new list</a>
	</li>
	<li <?php if($this->current_method == 'add_urgency') echo 'class="current"'?>>
		<a href="/todos/add_urgency">Add urgency</a>
	</li>
</ul>
<?php echo validation_errors(); ?>
<?php echo form_open('todos'); ?>
	<table>
		<thead>
			<tr>
				<th>
					Todo description
				</th>
				<th>
					List
				</th>
				<th>
					Urgency
				</th>
				<th>
					Time required
				</th>
				<th>
				</th>
				<th>
				</th>
			</tr>
		</thead>
		<tbody>
<?php foreach($todos as $todo)
{
?>
	<tr>
			<td>
				<?php echo $todo->todo_description;?>
			</td>
			<td>
				<?php echo $todo->list_name;?>
			</td>
			<td>
				<?php echo $todo->urgency_name;?>
			</td>
			<td>
				<?php echo $todo->time_required;?>
			</td>
			<td>
				<input type="checkbox" class="checkbox" name="complete_<?php echo $todo->todo_id;?>" />
				Complete
			</td>
			<td>
				<input type="checkbox" class="checkbox" name="delete_<?php echo $todo->todo_id;?>" />
				Delete
			</td>
	</tr>
<?php
}
?>
		</tbody>
	</table>
	
	<p>
		<input type="submit" name="submit" />
	</p>
	
</form>
</div>