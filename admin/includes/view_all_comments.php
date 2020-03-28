<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>Post</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>

<?php

$query = "SELECT * from comments";
$select_all_comments_admin = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_all_comments_admin)){
    $comment_id = $row['comment_id'];
    $comment_author = $row['comment_author'];
    $comment_content = $row['comment_content'];
    $comment_email = $row['comment_email'];
    $comment_status = $row['comment_status'];
    $comment_post_id = $row['comment_post_id'];
    $comment_date = $row['comment_date'];

    echo "<tr>";
    echo "<td>$comment_id</td>";
    echo "<td>$comment_author</td>";
    echo "<td>$comment_content</td>";
    echo "<td>$comment_email</td>";
    echo "<td>$comment_status</td>";
        $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
        $select_post_id = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_post_id)){
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        echo "<td><a href = '../post.php?p_id={$post_id}'>{$post_title}</a></td>";
    }
    echo "<td>$comment_date</td>";

    if ($comment_status == 'UNAPPROVED'){
    echo "<td><a class='btn btn-warning' href='comments.php?approve={$comment_id}'>Approve</a></td>";
    } else {
    echo "<td><a class='btn btn-warning' href='comments.php?unapprove={$comment_id}'>Unapprove</a></td>";
    }
    echo "<td><a class='btn btn-danger' href='comments.php?delete={$comment_id}'>Delete</a></td>";

    echo "</tr>";
;}


?>

    </tbody>
</table>

<?php 

if(isset($_GET['approve'])){
    global $connection;

    $comment_id_approve = $_GET['approve'];
    $query = "UPDATE comments SET comment_status = 'APPROVED' WHERE comment_id = {$comment_id_approve}";
    $approveQuery = mysqli_query($connection, $query);
    header("location:comments.php");

}

if(isset($_GET['unapprove'])){
    global $connection;

    $comment_id_unapprove = $_GET['unapprove'];
    $query = "UPDATE comments SET comment_status = 'UNAPPROVED' WHERE comment_id = {$comment_id_unapprove}";
    $unapproveQuery = mysqli_query($connection, $query);
    header("location:comments.php");

}

if(isset($_GET['delete'])){
    global $connection;

    $comment_id_del = $_GET['delete'];
    $query = "DELETE FROM comments WHERE comment_id = {$comment_id_del}";
    $deleteQuery = mysqli_query($connection, $query);
    header("location:comments.php");

}


?>