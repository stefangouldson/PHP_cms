<?php include "include/db.php" ?>
<?php include "include/header.php"; ?>

<!-- Navigation -->
<?php include "include/navbar.php"; ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php

            if (isset($_GET['p_id'])) {
                $post_id = $_GET['p_id'];
                
                $view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = {$post_id}";
                $update_views = mysqli_query($connection, $view_query);
                if (!$update_views) {
                    die("VIEWS QUERY FAILED" . mysqli_error($connection));
                }

                $query = "SELECT * FROM posts where post_id = {$post_id} AND post_status = 'published'";
                $select_all_posts_query = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_user_id = $row['post_user_id'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
            ?>

                    <!-- Blog Post -->
                    <h1 class="page-header">
                        <?php echo $post_title; ?>
                        <small>By <?php

                            $query = "SELECT * FROM users WHERE user_id = {$post_user_id}";
                            $get_user_query = mysqli_query($connection, $query);
                            $row = mysqli_fetch_array($get_user_query);
                            $username = $row['username'];
                            echo "<td>$username</td>";
                            
                        
                        
                        
                        ?></small>
                    </h1>

                    <p class="lead">
                        <a href="author_posts.php?author=<?php echo $post_user_id ?>">View Profile</a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span><?php echo " Posted on {$post_date}" ?></p>
                    <hr>
                    <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                    <hr>
                    <p><?php echo $post_content ?></p>

                    <hr>

            <?php }
            } else {
                header("Location: ./");
            }

            ?>

            <!-- Blog Comments -->

            <?php

            if (isset($_POST['create_comment'])) {

                $the_post_id = $_GET['p_id'];
                $comment_author = $_POST['comment_author'];
                $comment_email = $_POST['comment_email'];
                $comment_content = $_POST['comment_content'];

                $comment_content = mysqli_real_escape_string($connection, $comment_content);

                if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {


                    $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) VALUES ($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'UNAPPROVED', now())";

                    $create_comment_query = mysqli_query($connection, $query);

                    if (!$create_comment_query) {
                        die("Comment Query Fail" . mysqli_error($connection));
                    }

                    // $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $the_post_id";
                    // $commentCountQuery = mysqli_query($connection, $query);


                } else {
                    echo "<script>alert('Comment fields cannot be empty')</script>";
                }
            }

            ?>

            <!-- Comments Form -->

            <?php 
            
            $query = "SELECT * FROM posts where post_id = {$post_id} AND post_status = 'published'";
            $select_all_posts_query = mysqli_query($connection, $query);
            $check_post = mysqli_num_rows($select_all_posts_query);
            
            
            if($check_post>0){
                
                if (isset($_SESSION['username'])){
            ?>
            <div class="well">

                <h4>Leave a Comment:</h4>
                <form role="form" method="POST" action="">

                    <?php

                    if (isset($_SESSION['username'])) {
                        $session_username = $_SESSION['username'];
                        $session_email = $_SESSION['user_email'];
                    ?>

                        <div class="form-group">
                            <input class="form-control" type="text" name="comment_author" placeholder="Enter Name" value="<?php echo $session_username ?>">
                        </div>

                        <div class="form-group">
                            <input class="form-control" type="email" name="comment_email" placeholder="Enter Email" value="<?php echo $session_email ?>">
                        </div>

                    <?php } else { ?>

                        <div class="form-group">
                            <input class="form-control" type="text" name="comment_author" placeholder="Enter Name">
                        </div>

                        <div class="form-group">
                            <input class="form-control" type="email" name="comment_email" placeholder="Enter Email">
                        </div>


                    <?php } ?>

                    <div class="form-group">
                        <textarea placeholder="Write a comment" class="form-control" name="comment_content" rows="3"></textarea>
                    </div>

                    <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>

                </form>

            </div>
                    <?php } else {
                        echo "<h3>Sign In to leave a comment</h3>";
                    } ?>
            <hr>

            <!-- Posted comments -->

            <?php

            $query = "SELECT * FROM comments WHERE comment_post_id = $post_id AND comment_status = 'APPROVED' ORDER BY comment_id DESC";
            $select_comment_query = mysqli_query($connection, $query);

            if (!$select_comment_query) {
                die("QUERY FAILED" . mysqli_error($connection));
            }

            while ($row = mysqli_fetch_assoc($select_comment_query)) {
                $comment_date = $row['comment_date'];
                $comment_content = $row['comment_content'];
                $comment_author = $row['comment_author'];
            ?>

                <!-- Comment -->
                <div class="media">
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>
                <hr>


            <?php } ?>
            <?php } else {
                echo "<h1>This post is still a draft</h1>";
            } ?>

            <!-- Pager -->

        </div>

        <!-- Blog Sidebar Widgets and footer -->
        <?php include "include/sidebar.php" ?>
        <?php include "include/footer.php"; ?>