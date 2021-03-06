<?php include "include/db.php"; ?>
<?php include "include/header.php"; ?>
<!-- Navigation -->
<?php include "include/navbar.php"; ?>
<?php 

function username_exist ($username){
    global $connection;

    $query = "SELECT * FROM users WHERE username = '$username'";
    $check_user = mysqli_query($connection, $query);
    $result = mysqli_num_rows($check_user);

    if($result > 0){ return true;}
    else {return false;}
}

function email_exist ($email){
    global $connection;

    $query = "SELECT * FROM users WHERE user_email = '$email'";
    $check_email = mysqli_query($connection, $query);
    $result = mysqli_num_rows($check_email);

    if($result > 0){ return true;}
    else {return false;}
}


?>
<?php 

if(isset($_POST['submit'])){

    if(!empty($_POST['botcatcher'])){
        die('gotcha bot!');
    } else {

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if(!empty($username) && !empty($email) && !empty($password)){

    $username = mysqli_real_escape_string($connection,$username);
    $email = mysqli_real_escape_string($connection,$email);
    $password = mysqli_real_escape_string($connection,$password);

    if (!username_exist($username) && !email_exist($email)){


    $password = password_hash($password,PASSWORD_BCRYPT,['cost'=>12]);

    $query = "INSERT INTO users (username, user_email, user_password, user_role) VALUES ('{$username}', '{$email}', '{$password}','subscriber')";
    $register_query = mysqli_query($connection, $query);
    if(!$register_query){
        die("QUERY FAILED" . mysqli_error($connection));
    }

    header('Location:./');
    }
    } else {
        echo "<script>alert('Fields cannot be empty')</script>";
    }
}
}

?>




<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-8 col-xs-offset-2">
                    <div class="form-wrap">
                        <h1>Register</h1>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                            <div class="form-group">
                                <label for="username" class="sr-only">username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username" required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control" placeholder="Password" required>
                            </div>

                            <input type="text" name="botcatcher" style="display:none" value="">

                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>



    <?php include "include/footer.php"; ?>