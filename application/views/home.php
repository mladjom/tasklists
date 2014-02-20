	<div class="container">

	<h1>Codeigniter Todo Tasklist</h1>
	<p class="lead">Use this app as a way to quickly create todo tasklist.</p>
<div id="main">

<?= anchor('tasks/add/', 'Add new to do', array('title' => 'Add new to do!')); ?>
 
<p><?= $flash_message ?></p>
 
<h2>Next</h2>
<?php if($todo_list): ?>
<ul>
    <?php foreach($todo_list as $todo): ?>
    <li><h3><?= $todo->name ?></h3>
    <?php if($todo->description): ?><p><?= $todo->description ?></p><?php endif ?>
    </li>
    <?php endforeach ?>
</ul>
<?php else: ?>
None
<?php endif ?>
 
<h2>Completed</h2>
<?php if($completed_list): ?>
<ul>
    <?php foreach($completed_list as $todo): ?>
    <li><h3><?= $todo->name ?></h3>
    <?php endforeach ?>
</ul>
<?php else: ?>
None
<?php endif ?>


	
	<ul class="todoList">
		
        <?php
		
		// Looping and outputting the $todos array. 
		$query = $this->db->query('SELECT name, description FROM tasks');

			foreach ($query->result() as $row)
			{
					echo '<li>';
					echo $row->name;
					echo $row->description;
					echo '</li>';
			}		
		?>

    </ul>

</div>

<?php echo 'Total Results: ' . $query->num_rows(); ?>
	
	
	</div><!-- /.container -->
