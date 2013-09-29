<?php 
echo validation_errors(); 
$attributes = array('class' => 'form-horizontal', 'role' =>'form' , 'id' =>'add_list');
echo form_open('todo/add_list_todo', $attributes); ?>
<div class="container">
	<div class="form-group">
		<label>Title</label>
		<?php echo form_error('title'); ?>		
    <input class="form-control" type="text" id="title" name="title" value="<?php echo set_value('title'); ?>" />
	</div>
	<div class="form-group">
    <label>Description</label>
    <?php echo form_error('description'); ?>		
		<textarea maxlength="255" class="form-control" id="description" name="description"><?php echo set_value('description'); ?></textarea>
	</div>
<?php if (isset($current_list)): ?>
 <input type="hidden" name="list" value="<?php echo $current_list->list_id; ?>" />
	<?php endif ;?>

<!--	<div class="form-group">
		<input type="submit" class="btn btn-primary" value="Add new"/>
	</div>-->
</div>
<?php echo form_close(); ?>
