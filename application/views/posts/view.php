<h1><?php echo $title; ?></h1>
<?php if (!empty($post["name"])) { ?>
 <small class="posts-cat">Relevent Experience: <?php echo $post["name"]; ?></small>
 <br>
<?php } ?>
<img class="posts-thumb" src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['Post_image']; ?>" />
<div class="post-body">
	<?php echo $post['Body']; ?>
</div>

<hr>

<?php if ($this->input->post('type') == 'admin') : ?>

<a class="btn btn-primary float-left" href="<?php echo base_url(); ?>post/edit/<?php echo $post['Slug'];?>">Edit</a>

<?php echo form_open('/posts/delete/'.$post['Post_ID']); ?>
	<input type="submit" value="Delete" class="btn btn-danger">
</form>

<?php endif;?>