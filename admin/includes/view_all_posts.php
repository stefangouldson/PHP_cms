<?php 

if(isset($_POST['checkBoxArray'])){

    foreach($_POST['checkBoxArray'] as $checkBoxValue){
      $bulk_options = $_POST['bulkOptions'];

      switch($bulk_options){

        case 'published':
        $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$checkBoxValue}";
        $update_to_published = mysqli_query($connection, $query);
        confirmQuery($update_to_published);
        break;

        case 'draft':
        $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$checkBoxValue}";
        $update_to_draft = mysqli_query($connection, $query);
        confirmQuery($update_to_draft);
        break;

        case 'delete':
        $query = "DELETE FROM posts WHERE post_id = {$checkBoxValue}";
        $delete_posts_query = mysqli_query($connection, $query);
        confirmQuery($delete_posts_query);
        break;

        case 'clone':
            $query = "SELECT * from posts WHERE post_id = {$checkBoxValue}";
            $select_all_posts_admin = mysqli_query($connection, $query);
            
            while ($row = mysqli_fetch_assoc($select_all_posts_admin)){
                $post_author = $row['post_author'];
                $post_user_id = $row['post_user_id'];
                $post_title = $row['post_title'];
                $post_catergory = $row['post_catergory_id'];
                $post_status = $row['post_status'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_comments = $row['post_comment_count'];
                $post_date = $row['post_date'];
                $post_content = $row['post_content'];
            }

            $query = "INSERT INTO posts (post_catergory_id, post_title, post_user_id, post_date, post_image, post_content, post_tags, post_status)
            VALUES({$post_catergory},'{$post_title}','{$post_user_id}', now(), '{$post_image}', '{$post_content}','{$post_tags}','{$post_status}' )"; 
            
            $clone_query = mysqli_query($connection, $query);
            confirmQuery($clone_query);

        break;

        case 'reset':
        $query = "UPDATE posts SET post_views_count = 0 WHERE post_id = {$checkBoxValue}";
        $reset_query = mysqli_query($connection, $query);
        confirmQuery($reset_query);
        break;
        
      }
    }

}


?>

<form action="" method="POST">

<div id="bulkOptionsContainer" class="col-xs-4">
    <select class="form-control" name="bulkOptions" id="">
        <option disabled selected hidden value="">Select Option</option>
        <option value="published">Publish</option>
        <option value="draft">Draft</option>
        <option value="delete">Delete</option>
        <option value="clone">Clone</option>
        <option value="reset">Reset Views</option>
    </select>
</div>

<style>#bulkOptionsContainer{padding: 0px; margin-bottom: 1%}</style>

<div class="col-xs-4">
    <input type="submit" name="submit" class="btn btn-success" value="Apply">
    <a class="btn btn-primary" href="posts.php?source=add_posts">Add New</a>
</div>

<table class="table table-bordered table-hover">
    <thead>
        <tr>
        <!-- <input type="checkbox" id="selectAllBoxes"> -->
            <th><input id='selectAllBoxes' type="checkbox"></th>
            <!-- <th>ID</th> -->
            <th>Title</th>
            <th>Author</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th>Views</th>
        </tr>
    </thead>
    <tbody>

<?php

$query = "SELECT * from posts ORDER BY post_id DESC";
$select_all_posts_admin = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_all_posts_admin)){
    $post_id = $row['post_id'];
    $post_author = $row['post_author'];
    $post_user_id = $row['post_user_id'];
    $post_title = $row['post_title'];
    $post_catergory = $row['post_catergory_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_date = $row['post_date'];
    $post_views = $row['post_views_count'];
    echo "<tr>";
    ?>

    <td><input class = 'checkBoxes' type='checkbox' name = 'checkBoxArray[]' value='<?php echo $post_id ?>'></td>
    
    <?php
    echo "<td><a href='../post.php?p_id={$post_id}'>$post_title</a></td>";
    // echo "<td>$post_id</td>";
    if($post_user_id == null){
        echo "<td>$post_author</td>";
    } else {
        $query = "SELECT * FROM users WHERE user_id = {$post_user_id}";
        $get_user_query = mysqli_query($connection, $query);
        $row = mysqli_fetch_array($get_user_query);
        $username = $row['username'];
        echo "<td>$username</td>";
    }

        $query = "SELECT * FROM catergories WHERE cat_id = $post_catergory";
        $select_catergories_id = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_catergories_id)){
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
            echo "<td>{$cat_title}</td>";
        }

    echo "<td>$post_status</td>";
    echo "<td><img width=100 src='../images/$post_image' alt='image'</td>";
    echo "<td>$post_tags</td>";

    $comment_query = "SELECT * FROM comments WHERE comment_post_id = {$post_id}";
    $fetch_comment = mysqli_query($connection, $comment_query);
    $row = mysqli_fetch_array($fetch_comment);
    $post_comments = mysqli_num_rows($fetch_comment);

    if($post_comments>0){
        $comment_post_id = $row['comment_post_id'];
        echo "<td><a href='comment.php?id={$comment_post_id}'>$post_comments</a></td>";
    } else {
        echo "<td>$post_comments</td>";
    }

    echo "<td>$post_date</td>";
    echo "<td>$post_views</td>";
    echo "<td><a class='btn btn-success' href='posts.php?source=edit_posts&p_id={$post_id}'>Edit</a></td>";
    echo "<td><a class='btn btn-danger' onClick=\"javascript: return confirm('Are you sure you want to delete this post?') \"  href='posts.php?delete={$post_id}'>Delete</a></td>";
    echo "</tr>";
}


?>

    </tbody>
</table>
    </form>

<?php 

if(isset($_GET['delete'])){
    global $connection;

    if(isset($_SESSION['user_role'])){
        if($_SESSION['user_role'] == 'admin'){

        $post_id_del = $_GET['delete'];
        $query = "DELETE FROM posts WHERE post_id = {$post_id_del}";
        $deleteQuery = mysqli_query($connection, $query);
        header("location:posts.php");

        }
    }
}


?>