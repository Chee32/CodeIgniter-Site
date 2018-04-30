<html>
	<head>
		<title>Ian Foulk Resume</title>
		<link rel="stylesheet" href="https://bootswatch.com/4/flatly/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/styles.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  		<script src="https://cdn.ckeditor.com/4.9.0/standard/ckeditor.js"></script>
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
		  <a class="navbar-brand" href="<?php echo base_url(); ?>">Ian Foulk</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarColor01">
		    <ul class="navbar-nav mr-auto">
		      <li class="nav-item active">
		        <a class="nav-link" href="<?php echo base_url(); ?>">Home</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="<?php echo base_url(); ?>websites">Websites</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="<?php echo base_url(); ?>programming-exp">Programming Experince</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="<?php echo base_url(); ?>about">About</a>
		      </li>
		    </ul>
		    <ul class="navbar-nav navbar-right">
		    	<li class="nav-item dropdown">
			        <a id="program-drop" href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			        	Admin Actions<span class="caret"></span>
			        </a>
			        <ul id="program-menu" class="dropdown-menu" aria-labelledby="program-drop">
			          <?php if(!$this->session->userdata('logged_in')) : ?>
				        <li><a class="dropdown-item" href="<?php echo base_url(); ?>users/register">Register</a></li>
				        <li><a class="dropdown-item" href="<?php echo base_url(); ?>users/login">Log in</a></li>
				      <?php elseif($this->session->userdata('type') == 'admin') : ?>
				      	<li><a class="dropdown-item" href="<?php echo base_url(); ?>users/register">Register Users</a></li>
				        <li><a class="dropdown-item" href="<?php echo base_url(); ?>post/create">Create Post</a></li>
				        <li><a class="dropdown-item" href="<?php echo base_url(); ?>categories/create">Create Category</a></li>
				        <li><a class="dropdown-item" href="<?php echo base_url(); ?>users/logout">Log out</a></li>
				      <?php else : ?>  
				        <li><a class="dropdown-item" href="<?php echo base_url(); ?>users/logout">Log out</a></li>
				      <?php endif; ?>
			        </ul>
		      </li>
		  </div>
		</nav>
		
		<div class="container">
			<!-- Flash messages -->

			<?php if($this->session->flashdata('success_message')): ?>
				<?php echo '<p class="alert alert-success">'. $this->session->flashdata('success_message') .'</p>'; ?>
			<?php endif; ?>
			<?php if($this->session->flashdata('error_message')): ?>
				<?php echo '<p class="alert alert-danger">'. $this->session->flashdata('error_message') .'</p>'; ?>
			<?php endif; ?>