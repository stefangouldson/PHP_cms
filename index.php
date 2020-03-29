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
        
        $per_page = 3;
        
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        } else {
            $page = '';
        }

        if($page == '' || $page == 1){
            $page_1 = 0;
        } else {
            $page_1 = ($page * $per_page) - $per_page;
        }
        
        ?>

            <h1 class="page-header">
                Welcome
                <small>to the PHP Blog</small>
            </h1>

            <?php

            $count_query = "SELECT * FROM posts";
            $posts_count = mysqli_query($connection, $count_query);
            $count = mysqli_num_rows($posts_count);

            $count = ceil($count / $per_page);



    $query = "SELECT * FROM posts WHERE post_status = 'published' LIMIT {$page_1},{$per_page}";
            $select_all_posts_query = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = substr($row['post_content'], 0, 100);
            ?>

                <!-- Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $post_author ?>&p_id=<?php echo $post_id ?>"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo " Posted on {$post_date}" ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo "{$post_content}... "; ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

            <?php } ?>

            <!-- Pager -->
            <ul class="pagination">
                <?php 
                
                for($i = 1; $i<=$count; $i++){

                    if($i == $page){
                    echo "<li class='page-item active'><a class='page_link' href='index.php?page={$i}'>{$i}</a></li>";
                    } else {
                    echo "<li class='page-item'><a class='page_link' href='index.php?page={$i}'>{$i}</a></li>";
                    }
                }
                
                
                ?>
            </ul>

            <!-- <?php include "include/pager.php"; ?> -->

        </div>

        <!-- Blog Sidebar Widgets and footer -->
        <?php include "include/sidebar.php" ?>
        <?php include "include/footer.php"; ?>