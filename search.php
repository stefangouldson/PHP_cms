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
                $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
                $search_query = mysqli_query($connection, $query);

                if (!$search_query) {
                    die("Search Query error" . mysqli_error($connection));
                }

                $count = mysqli_num_rows($search_query);
                if ($count == 0) {
                    echo "<h1><small>No results</small></h1>";
                } else {
                    //echo $count;

                    while ($row = mysqli_fetch_assoc($search_query)) {
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                    }

            ?>

                <!-- Blog Post -->
            <h2>
                <a href="post.php?p_id=<?php echo $post_id?>"><?php echo $post_title ?></a>
            </h2>
            <p class="lead">
                by <a href="index.php"><?php echo $post_author ?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span><?php echo " Posted on {$post_date}" ?></p>
            <hr>
            <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
            <hr>
            <p><?php echo $post_content ?></p>
            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

            <hr>

            <?php }
            } ?>

            <!-- Pager -->
            <!-- <ul class="pager">
                <li class="previous">
                    <a href="#">&larr; Older</a>
                </li>
                <li class="next">
                    <a href="#">Newer &rarr;</a>
                </li>
            </ul> -->


        </div>

        <!-- Blog Sidebar Widgets and footer -->
        <?php include "include/sidebar.php" ?>
        <?php include "include/footer.php"; ?>