<div id="content" class="full">
	<div class="container">
		<div class="row">		
		<div id="signup" class="col-lg-6 col-md-6 col-lg-offset-3">
		<div class="box">
			<div class="box-header">
				<h2><i class="icon-unlock"></i><span class="break"></span>Sign Up</h2>
			</div>
			<div class="box-content">
				<?php if(validation_errors()): ?>
					<div class="alert alert-danger">
						<button data-dismiss="alert" class="close" type="button">×</button>
						<strong>Oh snap!</strong> Change a few things up and try submitting again.
						<p><?php echo validation_errors() ;?></p>
					</div>
				<?php endif; ?>
				<div class="container">
					<?php $attributes = array('id' => 'form-signup', 'class' => 'form-horizontal', 'role' =>'form');?>
					<?php echo form_open('site/signup_validation', $attributes); ?>
					<div class="form-group">
						<label>Username:</label>
						<?php $username = array('id' => 'username', 'name' => 'username', 'class' => 'form-control'); ?>
						<?php echo form_input($username, $this->input->post('username')); ?>
					</div>
					<div class="form-group">
						<label>E-mail:</label>
						<?php $email = array('id' => 'email', 'name' => 'email', 'class' => 'form-control'); ?>
						<?php echo form_input($email, $this->input->post('email')); ?>
					</div>
					<div class="form-group">
						<label>Password:</label>
						<?php $password = array('id' => 'password', 'name' => 'password', 'class' => 'form-control'); ?>
						<?php echo form_password($password, $this->input->post('password')) ;?>
					</div>
					<div class="form-group">
						<label>Confirm Password:</label>
						<?php $cpassword = array('id' => 'cpassword', 'name' => 'cpassword', 'class' => 'form-control'); ?>
						<?php echo form_password($cpassword, $this->input->post('cpassword')) ;?>
					</div>
					<div class="form-group">
						<?php  $submit = array('name' => 'submit', 'value' => 'Submit', 'class' => 'btn btn-primary'); ?>
						<?php echo form_submit($submit); ?>
					</div>
					<?php echo form_close() ?>
				</div>
			</div>
		</div>
	</div>
	</div><!-- end: row -->
	</div><!-- end: container -->	
</div><!-- end: content -->