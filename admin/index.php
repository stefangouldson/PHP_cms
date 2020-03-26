<?php include "includes/admin_header.php" ?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_nav.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Admin
                        <small><?php echo $_SESSION['username'] ?></small>
                    </h1>

                    <!-- /.row -->

                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-file-text fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <?php
                                            $query = "SELECT * FROM posts WHERE post_status = 'published'";
                                            $select_all_active_posts = mysqli_query($connection, $query);
                                            $active_post_counts = mysqli_num_rows($select_all_active_posts);
                                            echo "<div class='huge'>{$active_post_counts}</div>";
                                            ?>

                                            <div>Active Posts</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="posts.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-green">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-comments fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <?php
                                            $query = "SELECT * FROM comments WHERE comment_status = 'APPROVED'";
                                            $select_all_app_comments = mysqli_query($connection, $query);
                                            $app_comment_counts = mysqli_num_rows($select_all_app_comments);
                                            echo "<div class='huge'>{$app_comment_counts}</div>";
                                            ?>
                                            <div>Approved Comments</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="comments.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-yellow">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-users fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <?php
                                            $query = "SELECT * FROM users WHERE user_role = 'subscriber'";
                                            $select_all_users = mysqli_query($connection, $query);
                                            $sub_counts = mysqli_num_rows($select_all_users);
                                            echo "<div class='huge'>{$sub_counts}</div>";
                                            ?>
                                            <div> Subscribers</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="users.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-red">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-list fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <?php
                                            $query = "SELECT * FROM catergories";
                                            $select_all_catergories = mysqli_query($connection, $query);
                                            $cat_counts = mysqli_num_rows($select_all_catergories);
                                            echo "<div class='huge'>{$cat_counts}</div>";
                                            ?>
                                            <div>Categories</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="catergories.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->

                    <?php

                    $query = "SELECT * FROM posts";
                    $select_all_posts = mysqli_query($connection, $query);
                    $post_counts = mysqli_num_rows($select_all_posts);

                    $query = "SELECT * FROM posts WHERE post_status = 'draft'";
                    $select_all_draft_posts = mysqli_query($connection, $query);
                    $draft_count = mysqli_num_rows($select_all_draft_posts);


                    $query = "SELECT * FROM comments";
                    $select_all_comments = mysqli_query($connection, $query);
                    $comment_counts = mysqli_num_rows($select_all_comments);

                    $query = "SELECT * FROM comments WHERE comment_status = 'UNAPPROVED'";
                    $select_all_unapp_comments = mysqli_query($connection, $query);
                    $unapp_comment_counts = mysqli_num_rows($select_all_unapp_comments);


                    $query = "SELECT * FROM users";
                    $select_all_users = mysqli_query($connection, $query);
                    $user_counts = mysqli_num_rows($select_all_users);

                    $query = "SELECT * FROM users WHERE user_role = 'admin'";
                    $select_all_admin = mysqli_query($connection, $query);
                    $admin_counts = mysqli_num_rows($select_all_admin);
                    ?>

                    <div class="row">
                            <script type="text/javascript">
                                google.charts.load('current', {
                                    'packages': ['bar']
                                });
                                google.charts.setOnLoadCallback(drawChart);

                                function drawChart() {
                                    var data = google.visualization.arrayToDataTable([
                                        [' ', 'Total', 'Active', 'Inactive'],

                                        <?php
                                        echo "['Posts', {$post_counts}, {$active_post_counts}, {$draft_count}],";
                                        echo "['Comments', {$comment_counts}, {$app_comment_counts}, {$unapp_comment_counts}],";
                                        echo "['Users', {$user_counts}, {$admin_counts}, {$sub_counts}]";
                                        ?>

                                    ]);

                                    var options = {
                                        chart: {
                                            title: 'Summary',
                                            subtitle: 'ACTIVE = Published Posts, Approved Comments, Admin Users | INACTIVE = Draft Posts, Unapproved Comments, Subscribers',
                                        }
                                    };

                                    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                                    chart.draw(data, google.charts.Bar.convertOptions(options));
                                }
                            </script>
                        <div class="col-md-auto">
                            <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<?php include "includes/admin_footer.php" ?>