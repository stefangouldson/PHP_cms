<table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Author</th>
                                <th>Title</th>
                                <th>Catergory</th>
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
    echo "<td><a href='posts.php?source=edit_posts&p_id={$post_id}'>Edit</a></td>";
    echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";
    echo "</tr>";
;}


?>

                        </tbody>
                    </table>

<?php 

if(isset($_GET['delete'])){
    global $connection;

    $post_id_del = $_GET['delete'];
    $query = "DELETE FROM posts WHERE post_id = {$post_id_del}";
    $deleteQuery = mysqli_query($connection, $query);
    header("location:posts.php");

}


?>