<?php include "includes/admin_header.php" ?>
<?php
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $query = "SELECT * FROM users WHERE username = '{$username}'";
    $select_profile_query = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_array($select_profile_query)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];
        $user_image = $row['user_image'];
    }
}

if (isset($_POST['edit_user'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];

    // $post_image = $_FILES['image']['name'];
    // $post_image_temp = $_FILES['image']['tmp_name'];

    //move_uploaded_file($post_image_temp, "../images/$post_image");
    // if(empty($post_image)) {
    // $query = "SELECT * FROM posts WHERE post_id = {$the_post_id}";
    // $select_image = mysqli_query($connection, $query);

    // while($row= mysqli_fetch_assoc($select_image)) {
    //     $post_image = $row['post_image'];
    // }

    if (!empty($password)) {

        $query = "SELECT user_password FROM users WHERE user_id = {$user_id}";
        $get_password = mysqli_query($connection, $query);
        confirmQuery($get_password);

        $row = mysqli_fetch_array($get_password);
        $db_password = $row['user_password'];
    }

    if ($password != $db_password) {
        $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

        $query = "UPDATE users SET username = '{$username}', user_firstname = '{$user_firstname}', user_lastname = '{$user_lastname}', user_email = '{$user_email}', user_role = '{$user_role}', user_password = '{$password}' WHERE user_id = {$user_id} ";
        $update_user_query = mysqli_query($connection, $query);

        confirmQuery($update_user_query);
        echo "<script>alert('Profile Updated')</script>";
    }
}

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
                        Profile
                        <small><?php echo $_SESSION['username'] ?></small>
                    </h1>

                    <form action="" method="POST" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="title">Username</label>
                            <input type="text" class="form-control" name="username" value="<?php echo $username ?>">
                        </div>

                        <div class="form-group">
                            <label for="title">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Enter Password">
                        </div>

                        <div class="form-group">
                            <label for="author">Firstname</label>
                            <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname ?>">
                        </div>

                        <div class="form-group">
                            <label for="status">Lastname</label>
                            <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname ?>">
                        </div>

                        <div class="form-group">
                            <label for="tags">Email</label>
                            <input type="email" class="form-control" name="user_email" value="<?php echo $user_email ?>">
                        </div>

                        <!-- <div class="form-group">
    <label for="image">User Image</label>
    <input type="file" class="form-control" name="user_image">
</div> -->

                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="edit_user" value="Update User">
                        </div>

                    </form>



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