<?php 
$attributes = array('class' => 'form-horizontal');
echo form_open('todo/add_list', $attributes); ?>
<?php echo form_error('list_name'); ?>		
<input type="text" class="form-control" name="list_name" id="list_name" /><br/>
		<!--<input type="submit" class="btn btn-primary" value="Add new list"/>-->
<?php echo form_close(); ?>
