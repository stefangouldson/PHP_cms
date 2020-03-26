<?php

if(isset($_GET['u_id'])){
    $the_user_id = $_GET['u_id']; 
}

$query = "SELECT * from users WHERE user_id = {$the_user_id}";
$select_user_by_id = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_user_by_id)){
    $user_id = $row['user_id'];
    $username = $row['username'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_email = $row['user_email'];
    $user_role = $row['user_role'];
    $user_image = $row['user_image'];
}

?>


<?php
    if (isset($_POST['edit_user'])) {
    
        $username = $_POST['username'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_email = $_POST['user_email'];
        $user_role = $_POST['user_role'];

        // $post_image = $_FILES['image']['name'];
        // $post_image_temp = $_FILES['image']['tmp_name'];

        //move_uploaded_file($post_image_temp, "../images/$post_image");
        // if(empty($post_image)) {
        // $query = "SELECT * FROM posts WHERE post_id = {$the_post_id}";
        // $select_image = mysqli_query($connection, $query);

        // while($row= mysqli_fetch_assoc($select_image)) {
        //     $post_image = $row['post_image'];
        // }

        $query = "UPDATE users SET username = '{$username}', user_firstname = '{$user_firstname}', user_lastname = '{$user_lastname}', user_email = '{$user_email}', user_role = '{$user_role}' WHERE user_id = {$the_user_id} ";
        $update_user_query = mysqli_query($connection, $query);

        confirmQuery($update_user_query);
        echo "<script type='text/javascript'>
        if(window.confirm('User Updated, click ok to view all users')) {
        window.location.href='users.php';};
        </script>";
    }
?>

<form action="" method="POST" enctype="multipart/form-data">

<div class="form-group">
    <label for="title">Username</label>
    <input type="text" class="form-control" name="username" value="<?php echo $username ?>">
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
    <label for="content">Role</label>
    <select name="user_role" class="form-control" id="">
        <option value="<?php echo $user_role ?>"><?php echo $user_role ?></option>

        <?php 
        if($user_role == 'admin'){
            echo "<option value='subscriber'>Subscriber</option>";
        } else {
            echo "<option value='admin'>Admin</option>";
        }
        ?>
    </select>
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" name="edit_user" value="Update User">
</div>

</form>