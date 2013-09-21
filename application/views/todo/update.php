<h1>Update task</h1>
 <?php echo $id.$title; ?>
<?php echo validation_errors(); ?>
 
<form method="post" action="#" >
	<fieldset>
		<legend>Todo details</legend>    
		<label>Title</label><br/>
    <input type="text" name="title" value="<?php echo set_value('title', $title); ?>" /><br/>
    <label>Description</label><br/>
    <textarea name="description"><?php echo set_value('description', $description); ?></textarea><br/>
</fieldset>
	<p>
	    <input type="submit" value="Update task"/><br/>
	</p>
</form>		

