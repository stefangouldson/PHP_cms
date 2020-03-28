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
            <th></th>
            <th>ID</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>

<?php

$query = "SELECT * from posts";
$select_all_posts_admin = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_all_posts_admin)){
    $post_id = $row['post_id'];
    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_catergory = $row['post_catergory_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_comments = $row['post_comment_count'];
    $post_date = $row['post_date'];

    echo "<tr>";
    ?>

    <td><input class = 'checkBoxes' type='checkbox' name = 'checkBoxArray[]' value='<?php echo $post_id ?>'></td>
    
    <?php
    echo "<td>$post_id</td>";
    echo "<td>$post_author</td>";
    echo "<td>$post_title</td>";

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
    echo "<td>$post_comments</td>";
    echo "<td>$post_date</td>";
    echo "<td><a class='btn btn-info' href='../post.php?p_id={$post_id}'>View Post</a></td>";
    echo "<td><a class='btn btn-success' href='posts.php?source=edit_posts&p_id={$post_id}'>Edit</a></td>";
    echo "<td><a class='btn btn-danger' onClick=\"javascript: return confirm('Are you sure you want to delete this post?') \"  href='posts.php?delete={$post_id}'>Delete</a></td>";
    echo "</tr>";
;}


?>

    </tbody>
</table>
    </form>

<?php 

if(isset($_GET['delete'])){
    global $connection;

    $post_id_del = $_GET['delete'];
    $query = "DELETE FROM posts WHERE post_id = {$post_id_del}";
    $deleteQuery = mysqli_query($connection, $query);
    header("location:posts.php");

}


?>