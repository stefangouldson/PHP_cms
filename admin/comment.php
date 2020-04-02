<?php include "includes/admin_header.php" ?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_nav.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <?php 
                    if(isset($_GET['id'])){
                        $post_id = $_GET['id'];
                        $query = "SELECT * FROM posts WHERE post_id = {$post_id}";
                        $get_post = mysqli_query($connection, $query);

                        $row = mysqli_fetch_array($get_post);
                        $post_title = $row['post_title'];
                    } 
                    ?>
                    <h1 class="page-header">
                        Comments for :
                        <small><?php echo $post_title ?></small>
                    </h1>

                    <?php 
                    
                    if(isset($_GET['source'])){
                        $source = $_GET['source'];
                    } else { $source = '';}

                    switch($source) {

                    default:
                    include "includes/post_comments.php";
                    }
                    
                     ?>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<?php include "includes/admin_footer.php"; ?>