<?php 
$attributes = array('class' => 'form-horizontal', 'role' =>'form');
echo form_open('todo/add', $attributes); ?>
	<div class="form-group">
		<label>Title</label>
		<?php echo form_error('title'); ?>		
    <input class="form-control" type="text" name="title" value="<?php echo set_value('title'); ?>" />
	</div>
	<div class="form-group">
    <label>Description</label>
    <?php echo form_error('description'); ?>		
		<textarea maxlength="255" class="form-control" name="description"><?php echo set_value('description'); ?></textarea>
	</div>
	<?php if($todo_lists): ?>
	<div class="form-group">
		<label>Task lists</label>
		<select class="form-control" name="list">
			<?php foreach($todo_lists as $lists): ?>
			<option value="<?php echo $lists->list_id;?>"><?php echo $lists->list_name;?></option>
    	<?php endforeach ?>
		</select>
	</div>
	<?php endif ?>
	<div class="form-group">
		<input type="submit" class="btn btn-primary" value="Add new task"/>
	</div>
<?php echo form_close(); ?>
