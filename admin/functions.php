<?php

function confirmQuery ($result) {
    global $connection;

    if(!$result){
        die("QUERY FAILED" . mysqli_error($connection));
    }

    return $result;

}

function is_admin ($username) {
    global $connection;

    $query = "SELECT user_role FROM users WHERE username = '$username'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);

    $row= mysqli_fetch_array($result);
    
    if($row['user_role']=='admin'){
        return true;
    } else {
        return false;
    }

}

function users_online (){

    if(isset($_GET['onlineusers'])) {
        global $connection;

        if(!$connection){
            session_start();
            include("../include/db.php");
        }

        $session = session_id();
        $time = time();
        $time_out_in_seconds = 30;
        $time_out = $time - $time_out_in_seconds;

        $query = "SELECT * FROM users_online WHERE session = '$session'";
        $send_query = mysqli_query($connection, $query);
        $count = mysqli_num_rows($send_query);

        if($count == NULL){
            mysqli_query($connection, "INSERT INTO users_online(session, time) VALUE('$session','$time')");
        } else {
        mysqli_query($connection, "UPDATE users_online SET time='{$time}' WHERE session = '{$session}'");
        }

        $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time >'$time_out'");
        $count_user = mysqli_num_rows($users_online_query);
        echo $count_user;
}
}
users_online();

function insertCatergory () {

    global $connection ;

if (isset($_POST['submit'])) {

    $cat_title =  $_POST['cat_title'];
    if ($cat_title == "") {
        echo "This field should not be empty";
    } else {

        $query = "INSERT INTO catergories(cat_title) VALUES ('{$cat_title}')";
        $create_catergory_query = mysqli_query($connection, $query);
        header("location:catergories.php");

        if (!$create_catergory_query) {
            die('Query Failed' . mysqli_error($connection));
        }
    }
}

}

function findAllCatergories () {

    global $connection ;

    $query = "SELECT * from catergories";
    $select_all_catergories_admin = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_all_catergories_admin)) {
        $cat_title = $row['cat_title'];
        $cat_id = $row['cat_id'];
        echo "<tr>
        <td>{$cat_id}</td>
        <td>{$cat_title}</td>
        <td><a class='btn btn-success' href='catergories.php?edit={$cat_id}'>Edit</a></td>
        <td><a class='btn btn-danger' href='catergories.php?delete={$cat_id}'>Delete</a></td>
        </tr>";
    }

}

function deleteCatergory (){

    global $connection;

    if (isset($_GET['delete'])) {

        $cat_id = $_GET['delete'];
        $query = "DELETE FROM catergories WHERE cat_id={$cat_id}";
        $delete_query = mysqli_query($connection, $query);
        header("location:catergories.php");
    }

}

?>