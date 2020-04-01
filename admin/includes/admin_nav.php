<?php $pageName = basename($_SERVER['PHP_SELF']); ?>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="../">HOMEPAGE</a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <!-- <li><a href="./">Users Online: <?php // echo users_online(); ?></a></li> -->
        <li><a href="./">Admin Online: <span class="usersonline"></span></a></li>
   
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['user_firstname'] . " " . $_SESSION['user_lastname']; ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="../include/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>

    
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
                <?php 
                    if($pageName == "index.php"){
                        echo "<li class='active'><a href='./'><i class='fa fa-fw fa-dashboard'></i> Dashboard</a></li>";
                    } else {
                        echo "<li><a href='./'><i class='fa fa-fw fa-dashboard'></i> Dashboard</a></li>";
                    }
                ?>
            <li <?php 
            if($pageName=='posts.php'){
                echo "class='active'";
            } 
            ?>>
                <a href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown"><i class="fa fa-fw fa-file-text"></i> Posts <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="posts_dropdown" class="collapse">
                    <li>
                        <a href="posts.php">View All Posts</a>
                    </li>
                    <li>
                        <a href="posts.php?source=add_posts">Add Posts</a>
                    </li>
                </ul>
            </li>
            <li <?php 
            if($pageName=='catergories.php'){
                echo "class='active'";
            } 
            ?>>
                <a href="catergories.php"><i class="fa fa-list"></i> Categories</a>
            </li>
            <li <?php 
            if($pageName=='comments.php' || $pageName=='comment.php'){
                echo "class='active'";
            } 
            ?>>
                <a href="comments.php"><i class="fa fa-comments"></i> Comments</a>
            </li>
            <li <?php 
            if($pageName=='users.php'){
                echo "class='active'";
            } 
            ?>>
                <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-users"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="demo" class="collapse">
                    <li>
                        <a href="users.php">View All Users</a>
                    </li>
                    <li>
                        <a href="users.php?source=add_user">Add User</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>