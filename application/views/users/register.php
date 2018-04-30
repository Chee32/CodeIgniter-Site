<div class="row">
		<div class="col-sm-12 offset-sm-0 col-md-6 offset-md-3">
<h1 class="text-center"><?= $title ?></h1>

<?php echo validation_errors(); ?>

<?php echo form_open('users/register'); ?>

<div class="form-group">
	<label>Name</label>
	<input type="text" class="form-control" name="name" placeholder="Your Name">
</div>
<div class="form-group">
	<label>User Name</label>
	<input type="text" class="form-control" name="user_name" placeholder="User Name">
</div>
<div class="form-group">
	<label>Email</label>
	<input type="email" class="form-control" name="email" placeholder="Email">
</div>
<?php if($this->session->userdata('type') == 'admin') : ?>
<div class="form-group">
	<label>Type</label>
	<select name="type" class="form-control">
		<option value="subscriber" selected="selected">Subscriber</option>
		<option value="admin">Administrator</option>
	</select>
</div>
<?php endif; ?>
<div class="form-group">
	<label>Password</label>
	<input type="password" class="form-control" name="password" placeholder="Password">
</div>
<div class="form-group">
	<label>Confirm Password</label>
	<input type="password" class="form-control" name="passwordcf" placeholder="Confirm Password">
</div>
<button type="submit" class="btn btn-primary btn-block">Submit</button>

<?php echo form_close(); ?>

</div>
</div>