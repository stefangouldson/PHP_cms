<?php 
    if(isset($_POST['create_post'])){
        
        $post_title = $_POST['title'];
        $post_catergory_id = $_POST['catergory'];
        $post_author = $_POST['author'];
        $post_status =$_POST['status'];

        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];

        $post_tags = $_POST['tags'];
        $post_content = $_POST['content'];
        $post_date = date('d-m-y');
        $post_comment_count = 4;


        move_uploaded_file($post_image_temp, "../images/$post_image");

        $query = "INSERT INTO posts (post_catergory_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status)
        VALUES({$post_catergory_id},'{$post_title}','{$post_author}', now(), '{$post_image}', '{$post_content}','{$post_tags}',{$post_comment_count}, '{$post_status}' )"; 
        
        $create_post_query = mysqli_query($connection, $query);

        confirmQuery($create_post_query);
}
?>
<form action="" method="POST" enctype="multipart/form-data">

<div class="form-group">
    <label for="title">Post Title</label>
    <input type="text" class="form-control" name="title">
</div>

 <div class="form-group">
        <label for="catergory">Change Catergory</label>
        <select name="catergory" id="post_catergory" class="form-control">
                <?php 
    
                $query = "SELECT * from catergories";
                $select_all_cat = mysqli_query($connection, $query);

                confirmQuery($select_all_cat);
        
                while ($row = mysqli_fetch_assoc($select_all_cat)) {
                    $cat_title = $row['cat_title'];
                    $cat_id = $row['cat_id'];
                
                    echo "<option value='{$cat_id}'>{$cat_title}</option>";
                }
                ?>

        </select>
    </div>

<div class="form-group">
    <label for="author">Post Author</label>
    <input type="text" class="form-control" name="author">
</div>

<div class="form-group">
    <label for="status">Post Status</label>
    <input type="text" class="form-control" name="status">
</div>

<div class="form-group">
    <label for="image">Post Image</label>
    <input type="file" class="form-control" name="image">
</div>

<div class="form-group">
    <label for="tags">Post Tags</label>
    <input type="text" class="form-control" name="tags">
</div>

<div class="form-group">
    <label for="content">Post Content</label>
    <textarea class="form-control" name="content" cols=30 rows="10"></textarea>
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
</div>

</form>