<?php
//echo validation_errors(); 
?>
<form id="update" role="form" class="form-horizontal" accept-charset="utf-8" method="post" action="#">	
	<div class="form-group">
		<label>Title</label>
		<?php echo form_error('title'); ?>		
    <input class="form-control" type="text" id="title" name="title" value="<?php echo set_value('title', $title); ?>" />
	</div>
	<div class="form-group">
    <label>Description</label>
    <?php echo form_error('description'); ?>		
		<textarea maxlength="255" class="form-control" id="description" name="description"><?php echo set_value('description', $description); ?></textarea>
	</div>
	<div class="form-group">
		<input type="submit" class="btn btn-primary" value="Update task"/>
	</div>
</form>		