<h1><?= $title ?></h1>

<?php foreach($posts as $post) : ?>
	<h3><?php echo $post['Title'] ?></h3>
	<div class="row">
		<div class="col-md-3">
			<img class="posts-thumb thumbnail" src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['Post_image']; ?>" />
		</div>
		<div class="col-md-9">
			<?php if (!empty($posts["name"])) { ?>
			 <small class="post-cat">Relevent Experience: <?php echo $posts["name"]; ?></small>
			 <br>
			<?php } ?>
			<p><?php echo word_limiter($post['Body'], 60); ?></p>
			<p><a class="btn btn-secondary" href="<?php echo base_url().'post/'.$post['Slug']; ?>">Read More</a></p>
		</div>
	</div>
<?php endforeach; ?>
<div class="pagination-links">
<?php echo $this->pagination->create_links(); ?>
</div>
