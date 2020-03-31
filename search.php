<?php include "include/db.php" ?>
<?php include "include/header.php"; ?>

<!-- Navigation -->
<?php include "include/navbar.php"; ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <h1 class="page-header">Showing results for: 
                <small><?php echo $_POST['search'] ?></small>
            </h1>
            <?php

            if (isset($_POST['search'])) {
                $search = $_POST['search'];
                $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' OR  post_title LIKE '%$search%' AND post_status='published'";
                $search_query = mysqli_query($connection, $query);

                if (!$search_query) {
                    die("Search Query error" . mysqli_error($connection));
                }

                $count = mysqli_num_rows($search_query);
                if ($count == 0) {
                    echo "<h1><small>No results</small></h1>";
                } else {

                    while ($row = mysqli_fetch_assoc($search_query)) {
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_user_id = $row['post_user_id'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = substr($row['post_content'],0,100);
                    

            ?>

                <!-- Blog Post -->
            <h2>
                <a href="post.php?p_id=<?php echo $post_id?>"><?php echo $post_title ?></a>
            </h2>
            <?php 
                $query = "SELECT * FROM users WHERE user_id = {$post_user_id}";
                $get_user_query = mysqli_query($connection, $query);
                $row = mysqli_fetch_array($get_user_query);
                $username = $row['username'];
            ?>
            <p class="lead">
                by <a href="author_posts.php?author=<?php echo $post_user_id ?>"><?php echo $username ?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span><?php echo " Posted on {$post_date}" ?></p>
            <hr>
            <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
            <hr>
            <p><?php echo "$post_content...." ?></p>
            <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

            <hr>

            <?php }}
            } ?>

            <!-- Pager -->
            <!-- <?php include"include/pager.php"; ?> -->

        </div>

        <!-- Blog Sidebar Widgets and footer -->
        <?php include "include/sidebar.php" ?>
        <?php include "include/footer.php"; ?>