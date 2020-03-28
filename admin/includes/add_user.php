<?php 
    if(isset($_POST['create_user'])){
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_email = $_POST['user_email'];
        $user_role = $_POST['user_role'];

        // $post_image = $_FILES['image']['name'];
        // $post_image_temp = $_FILES['image']['tmp_name'];

        // move_uploaded_file($post_image_temp, "../images/$post_image");
        $password = password_hash($password,PASSWORD_BCRYPT,['cost'=>12]);
        
        $query = "INSERT INTO users (username, user_password, user_firstname, user_lastname, user_email, user_role)
        VALUES('{$username}','{$password}','{$user_firstname}','{$user_lastname}','{$user_email}','{$user_role}')"; 
        
        $add_user_query = mysqli_query($connection, $query);

        confirmQuery($add_user_query);

        echo "<script type='text/javascript'>
        if(window.confirm('User Updated, click ok to view all users')) {
        window.location.href='users.php';};
        </script>";
}
?>

<form action="" method="POST" enctype="multipart/form-data">

<div class="form-group">
    <label for="title">Username</label>
    <input type="text" class="form-control" name="username">
</div>

 <div class="form-group">
    <label for="catergory">Password</label>
    <input type="password" class="form-control" name="password">
</div>

<div class="form-group">
    <label for="author">Firstname</label>
    <input type="text" class="form-control" name="user_firstname">
</div>

<div class="form-group">
    <label for="status">Lastname</label>
    <input type="text" class="form-control" name="user_lastname">
</div>

<div class="form-group">
    <label for="tags">Email</label>
    <input type="email" class="form-control" name="user_email">
</div>

<!-- <div class="form-group">
    <label for="image">User Image</label>
    <input type="file" class="form-control" name="user_image">
</div> -->


<div class="form-group">
    <label for="content">Role</label>
    <select name="user_role" class="form-control" id="">
        <option disabled selected hidden>Select Option</option>
        <option value="admin">Admin</option>
        <option value="subscriber">Subscriber</option>
    </select>
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
</div>

</form>