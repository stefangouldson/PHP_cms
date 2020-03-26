<?php

if(isset($_GET['p_id'])){
    $the_post_id = $_GET['p_id']; 
}

$query = "SELECT * from posts WHERE post_id = {$the_post_id}";
$select_post_by_id = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_post_by_id)){
    $post_id = $row['post_id'];
    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_catergory = $row['post_catergory_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_comments = $row['post_comment_count'];
    $post_date = $row['post_date'];
    $post_content = $row['post_content'];
}

?>


<?php
    if (isset($_POST['update_post'])) {
    
        $post_author = $_POST['author'];
        $post_title = $_POST['title'];
        $post_catergory_id = $_POST['catergory'];
        $post_status = $_POST['status'];
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        $post_content = $_POST['content'];
        $post_tags = $_POST['tags'];

        move_uploaded_file($post_image_temp, "../images/$post_image");

        if(empty($post_image)) {

        $query = "SELECT * FROM posts WHERE post_id = {$the_post_id}";
        $select_image = mysqli_query($connection, $query);

        while($row= mysqli_fetch_assoc($select_image)) {
            $post_image = $row['post_image'];
        }

        }

        $query = "UPDATE posts SET post_title = '{$post_title}', post_catergory_id = '{$post_catergory_id}', post_date = now(), post_author = '{$post_author}', post_status = '{$post_status}', post_tags = '{$post_tags}', post_content = '{$post_content}', post_image = '{$post_image}' WHERE post_id = {$the_post_id} ";

        $update_post_query = mysqli_query($connection, $query);

        confirmQuery($update_post_query);
        echo "<script type='text/javascript'>
            if(window.confirm('Post Updated, click ok to view all post')) {
            window.location.href='posts.php';};
            </script>";
    }
?>

<form action="" method="POST" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Update Title</label>
        <input value="<?php echo $post_title ?>" type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
        <label for="catergory">Change Catergory - <bold>Set default, must change to original catergory</bold></label>
        <select name="catergory" id="post_catergory" class="form-control">
                <?php 
    
                $query = "SELECT * from catergories";
                $select_all_cat = mysqli_query($connection, $query);

                // confirmQuery($select_all_cat);
        
                while ($row = mysqli_fetch_assoc($select_all_cat)) {
                    $cat_title = $row['cat_title'];
                    $cat_id = $row['cat_id'];
                
                    echo "<option value='{$cat_id}'>{$cat_title}</option>";
                }
                ?>

        </select>
    </div>

    <div class="form-group">
        <label for="author">Update Author</label>
        <input value="<?php echo $post_author ?>" type="text" class="form-control" name="author">
    </div>

    <div class="form-group">
        <label for="status">Update Status</label>
        <input value="<?php echo $post_status ?>" type="text" class="form-control" name="status">
    </div>

    <div class="form-group">
        <label for="image">Change Photo</label>
        <img src="../images/<?php echo $post_image ?>" alt="" width="100">
        <input type="file" class="form-control-file" name="image">
    </div>

    <div class="form-group">
        <label for="tags">Edit Tags</label>
        <input value="<?php echo $post_tags ?>" type="text" class="form-control" name="tags">
    </div>

    <div class="form-group">
        <label for="content">Update Content</label>
        <textarea class="form-control" name="content" cols=30 rows="10"><?php echo $post_content ?></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_post" value="Edit Post">
    </div>

</form>