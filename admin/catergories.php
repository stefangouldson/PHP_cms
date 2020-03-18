<?php include "includes/admin_header.php" ?>
<?php
$query = "SELECT * from catergories";
$select_all_catergories_admin = mysqli_query($connection, $query);
?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_nav.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Catergories
                        <small>Add</small>
                    </h1>

                    <div class="col-xs-6">
                        <form action="" method="">

                            <div class="form-group">
                                <label for="cat_title">Add Catergory</label>
                                <input type="text" class="form-control" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Catergory">
                            </div>

                        </form>
                    </div>

                    <div class="col-xs-6">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Catergory Title</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($select_all_catergories_admin)) {
                                    $cat_title = $row['cat_title'];
                                    $cat_id = $row['cat_id'];
                                    echo "<tr><td>{$cat_id}</td><td>{$cat_title}</td><tr>";
                                }
                                ?>
                            </tbody>
                        </table>
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