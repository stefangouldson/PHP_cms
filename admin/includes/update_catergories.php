<form action="" method="POST">

<div class="form-group">
    <label for="cat_title">Edit Category</label>

    <?php

    if (isset($_GET['edit'])) {
        $cat_id = $_GET['edit'];

        $query = "SELECT * from catergories WHERE cat_id = {$cat_id}";
        $select_all_cat_id_admin = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_all_cat_id_admin)) {
            $cat_title = $row['cat_title'];
            $cat_id = $row['cat_id'];

    ?>
            <input value="<?php echo $cat_title; ?>" type="text" class="form-control" name="cat_title">
    <?php }
    } ?>


    <?php

    if (isset($_POST['update'])) {

        $cat_title = $_POST['cat_title'];
        $query = "UPDATE catergories SET cat_title = '$cat_title' WHERE cat_id={$cat_id}";
        $update_query = mysqli_query($connection, $query);

        if(!$update_query){

            die("Update Query Failed" . mysqli_error($connection));
        }
        header("location:catergories.php");
    }



    ?>
</div>

<div class="form-group">
    <input class="btn btn-success" type="submit" name="update" value="Edit Category">
</div>

</form>