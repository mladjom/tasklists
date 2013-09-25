<div id="content" class="full">
	<div class="container">
		<div class="row">	
		<div id="user" class="col-lg-6 col-md-6 col-lg-offset-3">
		<p>
 <img src="<?php echo $this->gravatar->get_gravatar($user_info->email); ?>" alt="" class="avatar">   <strong>Username:</strong>
    <?= $user_info->username ?>
  	</p>
  	<p>
    <strong>E-mail:</strong>
    <?= $user_info->email;  ?>

    <strong>Date Activated:</strong>
    <?= $date['day'] ?>.<?= $date['month'] ?>.<?= $date['year'] ?>
    (<?= $date['hour'] ?>h : <?= $date['minute'] ?>min : <?= $date['second'] ?>sec)
  	</p>
	</div>
	</div><!-- end: row -->
	</div><!-- end: container -->	
</div><!-- end: content -->