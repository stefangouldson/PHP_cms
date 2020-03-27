<div class="col-md-4">


    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="POST">
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                    <button name="submit" class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>

    <!-- <?php 
    /*
    $user_role = $_SESSION['user_role'];
    if(!$user_role){ 
        */?> -->
    <div class="well">
        <h4>Login</h4>
        <form action="include/login.php" method="POST">
            <div class="form-group">
                <input name="username" type="text" class="form-control" placeholder="Enter Username">
            </div>

            <div class="input-group">
                <input name="password" type="password" class="form-control" placeholder="Enter Password">

            <span class="input-group-btn">
                <input name="login" type="submit" value="Login" class="btn btn-primary">
            </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>

    <!-- <?php // } ?> -->





    <div class="well">
        <?php
            $query = "SELECT * from catergories LIMIT 5";
            $select_all_catergories_sidebar = mysqli_query($connection, $query);
        ?>

        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                <?php

                while($row = mysqli_fetch_assoc($select_all_catergories_sidebar)) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    echo "<li><a href='catergories.php?catergory={$cat_id}'</a>{$cat_title}</li></a>";
                }

                ?>
                </ul>
            </div>
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include "widget.php" ?>

</div>
</div>
</hr>