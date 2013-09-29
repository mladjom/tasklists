<form id="update" role="form" class="form-horizontal" accept-charset="utf-8" method="post" action="#">	
<div class="container">
	<div class="form-group">
		<label>Title</label>
		<?php echo form_error('list_name'); ?>		
    <input class="form-control" type="text" id="list_name" name="list_name" value="<?php echo set_value('list_name', $list_name); ?>" />
	</div>
	<div class="form-group">
		<input type="submit" class="btn btn-primary" value="Update task"/>
	</div>
</div>
</form>		