<?php include "include/db.php" ?>
<?php include "include/header.php"; ?>

<!-- Navigation -->
<?php include "include/navbar.php"; ?>
<?php if (isset($_GET['p_id'])) {
    $post_id = $_GET['p_id'];
    $the_post_author = $_GET['author'];
} ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <h1 class="page-header">
                Posts By:
                <small><?php echo $the_post_author ?></small>
            </h1>

            <?php


            $query = "SELECT * FROM posts WHERE post_author = '{$the_post_author}'";
            $select_all_posts_query = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_array($select_all_posts_query)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = substr($row['post_content'],0,100);
            ?>

                <!-- Blog Post -->

                <h2>
                    <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                </h2>
                <p><span class="glyphicon glyphicon-time"></span><?php echo " Posted on {$post_date}" ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo "{$post_content}... "; ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

            <?php } ?>


            <!-- Pager -->
            <!-- <?php include "include/pager.php"; ?> -->

        </div>

        <!-- Blog Sidebar Widgets and footer -->
        <?php include "include/sidebar.php" ?>
        <?php include "include/footer.php"; ?>