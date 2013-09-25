<!DOCTYPE html>
<html lang="en">
  <head>
	<!-- start: Meta -->
	<meta charset="utf-8">
	<?php if(!isset($header)): ?>
		<title>CodeIgniter Boostraped Tasklists</title>
	<?php else: ?>
		<title><?= $header ?> at CodeIgniter Boostraped Tasklists</title>
	<?php endif; ?>
	<meta name="description" content="CodeIgniter Boostraped Tasklists">
	<meta name="author" content="Mladjo">
	<!-- end: Meta -->
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->
	<!-- start: CSS -->
	<!-- Bootstrap core CSS -->
	<link href="<?php echo base_url("assets/css/bootstrap.min.css");?>" rel="stylesheet">	
	<link href="<?php echo base_url("assets/css/app.css");?>" rel="stylesheet">	
	<!-- end: CSS -->
	<!--[if lt IE 9]>
		<script src="<?php echo base_url("assets/js/html5shiv.js");?>"></script>
	<![endif]-->
	<!-- Fav and touch icons -->
	<link rel="shortcut icon" href="<?php echo base_url("assets/ico/favicon.ico");?>">
	<link rel="apple-touch-icon-precomposed" href="<?php echo base_url("assets/ico/apple-touch-icon-57x57-precomposed.png");?>">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url("assets/ico/apple-touch-icon-72x72-precomposed.png");?>">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url("assets/ico/apple-touch-icon-114x114-precomposed.png");?>">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url("assets/ico/apple-touch-icon-144x144-precomposed.png");?>">
	<!-- end: Favicon and Touch Icons -->
  </head>
  <body>
		<!-- start: Header -->
		<header class="navbar">
			<div class="container">
				<a class="navbar-brand col-lg-2 col-sm-1 col-xs-12" href="<?php echo base_url('');?>"><span>TaskLists</span></a>
				<?php if($this->session->userdata('username')): ?>
    		<div id="nav">
					<div class="nav-no-collapse header-nav">
						<ul class="nav navbar-nav pull-right">
        			<li>	Number of queries:	<?php echo $this->db->total_queries();?>	
							<?php echo anchor('#' , '<i class="icon-wrench"></i>', 'class="btn"') ?></li>
						<!-- start: User Dropdown -->
							<li class="dropdown">
								<a class="btn account dropdown-toggle" data-toggle="dropdown" href="#">
									<?php $email = $this->session->userdata('email'); ?>
									<div class="avatar"><img src="<?php  echo $this->gravatar->get_gravatar($email); ?>" alt=""></div>
									<div class="user">
										<span class="hello">Welcome!</span>
										<span class="name"><?php echo $this->session->userdata('username') ?></span>
									</div>
								</a>
								<ul class="dropdown-menu">
									<li class="dropdown-menu-title">
									</li>
									<li><?php echo anchor('site/user_info', '<i class="icon-user"></i> Profile') ?></li>
									<li><?php echo anchor('site/logout', '<i class="icon-off"></i> Logout') ?></li>
								</ul>
							</li>
						<!-- end: User Dropdown -->
						</ul>
					</div>
   	 		</div>	
    	<?php endif; ?>	
		</div>
	</header>
	<div class="container">
		<div class="row">