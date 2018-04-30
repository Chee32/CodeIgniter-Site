<h1><?= $title; ?></h1>

<?php echo validation_errors(); ?>

<?php echo form_open_multipart('posts/update'); ?>
  <input type="hidden" name="ID" value="<?php echo $post['Post_ID'];?>">
  <div class="form-group">
    <label>Title</label>
    <input type="text" class="form-control" name="Title" placeholder="Add Title" value="<?php echo $post['Title']; ?>">
  </div>
  <div class="form-group">
    <label>Body</label>
    <textarea id="editor1" class="form-control" name="Body" placeholder="Add Body"><?php echo $post['Body']; ?></textarea>
  </div>
  <div class="form-group">
    <label>Category</label>
    <select name="Category_id" class="form-control">
        <option value="">No Category</option>
      <?php foreach($categories as $category) :?>
        <option value="<?php echo $category['Cat_ID']; ?>" <?php echo ($category['Cat_ID'] == $post['Category_id'] ? "selected='selected'" : ""); ?>><?php echo $category['name']; ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="form-group">
    <label>Change Image</label>
    <input type="file" name="userfile" size="20"/>
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>