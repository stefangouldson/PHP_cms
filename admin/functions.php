<?php

function confirmQuery ($result) {
    global $connection;

    if(!$result){
        die("QUERY FAILED" . mysqli_error($connection));
    }

    return $result;

}

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