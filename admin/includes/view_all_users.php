<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>

<?php

$query = "SELECT * FROM users";
$select_all_users_admin = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_all_users_admin)){
    $user_id = $row['user_id'];
    $username = $row['username'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_email = $row['user_email'];
    $user_role = $row['user_role'];
    $user_image = $row['user_image'];

    echo "<tr>";
    echo "<td>$username</td>";
    echo "<td>$user_firstname</td>";
    echo "<td>$user_lastname</td>";
    echo "<td>$user_email</td>";
    echo "<td>$user_role</td>";

    if($user_role == 'subscriber'){
        echo "<td><a class='btn btn-warning' href='users.php?change_to_admin={$user_id}'>Change Role</a></td>";
    } else {
        echo "<td><a class='btn btn-warning' href='users.php?change_to_sub={$user_id}'>Change Role</a></td>";
    }

    echo "<td><a class='btn btn-success' href='users.php?source=edit_user&u_id={$user_id}'>Edit</a></td>";
    echo "<td><a class='btn btn-danger' href='users.php?delete={$user_id}' onClick=\"javascript: return confirm('Are you sure you want to delete this user?') \">Delete</a></td>";
    echo "</tr>";
;}


?>

    </tbody>
</table>

<?php 

if(isset($_GET['change_to_admin'])){
    global $connection;

    if(isset($_SESSION['user_role'])){
        if($_SESSION['user_role'] == 'admin'){
        $user_id_admin = $_GET['change_to_admin'];
        $query = "UPDATE users SET user_role = 'admin' WHERE user_id = {$user_id_admin}";
        $adminQuery = mysqli_query($connection, $query);
        header("location:users.php");
        }
    }
}

if(isset($_GET['change_to_sub'])){
    global $connection;

    if(isset($_SESSION['user_role'])){
        if($_SESSION['user_role'] == 'admin'){
        $user_id_sub = $_GET['change_to_sub'];
        $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = {$user_id_sub}";
        $adminQuery = mysqli_query($connection, $query);
        header("location:users.php");
        }
    }

}

if(isset($_GET['delete'])){
    global $connection;

    if(isset($_SESSION['user_role'])){
        if($_SESSION['user_role'] == 'admin'){
        $user_id_del = $_GET['delete'];
        $query = "DELETE FROM users WHERE user_id = {$user_id_del}";
        $deleteQuery = mysqli_query($connection, $query);
        header("location:users.php");
        }
    }
}


?>