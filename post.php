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

            if(isset($_GET['p_id'])){
                $post_id = $_GET['p_id'];

            }

            $query = "SELECT * FROM posts where post_id = {$post_id}";
            $select_all_posts_query = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];
            ?>

                <!-- Blog Post -->
                <h1 class="page-header">
                    Title:
                    <small><?php echo $post_title; ?></small>
                </h1>
                
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo " Posted on {$post_date}" ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>

                <hr>

            <?php } ?>

            <!-- Blog Comments -->

            <?php 
            
            if(isset($_POST['create_comment'])){

                $the_post_id = $_GET['p_id'];
                $comment_author = $_POST['comment_author'];
                $comment_email = $_POST['comment_email'];
                $comment_content = $_POST['comment_content'];
                
                if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){

                
                $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) VALUES ($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'UNAPPROVED', now())";

                $create_comment_query = mysqli_query($connection, $query);

                if(!$create_comment_query){
                    die("Comment Query Fail" . mysqli_error($connection));
                }

                $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $the_post_id";
                $commentCountQuery = mysqli_query($connection, $query);

                if(!$commentCountQuery){
                    die("Comment Count Query" . mysqli_error($connection));
                }
            } else {
                echo "<script>alert('Comment fields cannot be empty')</script>";
            }
        }            
            
            ?>

            <!-- Comments Form -->
            <div class="well">

                <h4>Leave a Comment:</h4>
                <form role="form" method="POST" action="">

                    <div class="form-group">
                        <input class="form-control" type="text" name="comment_author" placeholder="Enter Name">
                    </div>

                    <div class="form-group">
                        <input class="form-control" type="email" name="comment_email" placeholder="Enter Email">
                    </div>

                    <div class="form-group">
                        <textarea class="form-control" name="comment_content" rows="3"></textarea>
                    </div>

                    <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>

                </form>

            </div>

            <hr>

            <!-- Posted comments -->

            <?php 
            
            $query = "SELECT * FROM comments WHERE comment_post_id = $post_id AND comment_status = 'APPROVED' ORDER BY comment_id DESC";
            $select_comment_query = mysqli_query($connection, $query);

            if(!$select_comment_query){
                die("QUERY FAILED" . mysqli_error($connection));
            }
            
            while($row = mysqli_fetch_assoc($select_comment_query)){
                $comment_date = $row['comment_date'];
                $comment_content = $row['comment_content'];
                $comment_author = $row['comment_author'];
            ?>

            <!-- Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo $comment_author; ?>
                        <small><?php echo $comment_date; ?></small>
                    </h4>
                    <?php echo $comment_content; ?>
                </div>
            </div>



           <?php } ?>

            <!-- Pager -->

        </div>

<!-- Blog Sidebar Widgets and footer -->
<?php include "include/sidebar.php" ?>
<?php include "include/footer.php"; ?>