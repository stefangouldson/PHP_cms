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
        // $post_comment_count = 0;


        move_uploaded_file($post_image_temp, "../images/$post_image");

        $query = "INSERT INTO posts (post_catergory_id, post_title, post_user_id, post_date, post_image, post_content, post_tags, post_status)
        VALUES({$post_catergory_id},'{$post_title}','{$post_author}', now(), '{$post_image}', '{$post_content}','{$post_tags}','{$post_status}' )"; 
        
        $create_post_query = mysqli_query($connection, $query);

        confirmQuery($create_post_query);
        echo "<script type='text/javascript'>
        if(window.confirm('Post Added, click ok to view all post')) {
        window.location.href='posts.php';};
        </script>";
}
?>
<form action="" method="POST" enctype="multipart/form-data">

<div class="form-group">
    <label for="title">Post Title</label>
    <input type="text" class="form-control" name="title">
</div>

 <div class="form-group">
        <label for="catergory">Change Category</label>
        <select name="catergory" id="post_catergory" class="form-control">
        <option disabled selected hidden>Select Category</option>
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
        <select name="author" id="post_author" class="form-control">
        <option disabled selected hidden>Select Author</option>
                <?php 
    
                $query = "SELECT * FROM users";
                $select_all_users = mysqli_query($connection, $query);

                confirmQuery($select_all_users);
        
                while ($row = mysqli_fetch_assoc($select_all_users)) {
                    $username = $row['username'];
                    $user_id = $row['user_id'];
                
                    echo "<option value='{$user_id}'>{$username}</option>";
                }
                ?>

        </select>
    </div>

<!-- <div class="form-group">
    <label for="author">Post Author</label>
    <input type="text" class="form-control" name="author">
</div> -->

<div class="form-group">
    <label for="status">Post Status</label>
    <select name="status" id="post_status" class="form-control">
        <option disabled selected hidden>Select Status</option>
        <option value="draft">draft</option>
        <option value="published">published</option>
    </select >
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
    <textarea id="body" class="form-control" name="content" cols=30 rows="10"></textarea>
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
</div>

</form>