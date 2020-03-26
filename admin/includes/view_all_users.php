<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
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

    echo "<td>$user_id</td>";
    echo "<td>$username</td>";
    echo "<td>$user_firstname</td>";
    echo "<td>$user_lastname</td>";
    echo "<td>$user_email</td>";
    echo "<td>$user_role</td>";

    if($user_role == 'subscriber'){
        echo "<td><a href='users.php?change_to_admin={$user_id}'>Change Role</a></td>";
    } else {
        echo "<td><a href='users.php?change_to_sub={$user_id}'>Change Role</a></td>";
    }

    echo "<td><a href='users.php?source=edit_user&u_id={$user_id}'>Edit</a></td>";
    echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
    echo "</tr>";
;}


?>

    </tbody>
</table>

<?php 

if(isset($_GET['change_to_admin'])){
    global $connection;

    $user_id_admin = $_GET['change_to_admin'];
    $query = "UPDATE users SET user_role = 'admin' WHERE user_id = {$user_id_admin}";
    $adminQuery = mysqli_query($connection, $query);
    header("location:users.php");

}

if(isset($_GET['change_to_sub'])){
    global $connection;

    $user_id_sub = $_GET['change_to_sub'];
    $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = {$user_id_sub}";
    $adminQuery = mysqli_query($connection, $query);
    header("location:users.php");

}

if(isset($_GET['delete'])){
    global $connection;

    $user_id_del = $_GET['delete'];
    $query = "DELETE FROM users WHERE user_id = {$user_id_del}";
    $deleteQuery = mysqli_query($connection, $query);
    header("location:users.php");

}


?>