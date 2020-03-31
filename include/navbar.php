<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php 
            $pageName = basename($_SERVER['PHP_SELF']);
            
            ?>
        </div>


        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

            <?php 
             $pageName = basename($_SERVER['PHP_SELF']);

             if($pageName == 'index.php'){
                echo "<li class='active'><a href='./'>Home</a></li>";
             } else { echo "<li><a href='./'>Home</a></li>";}

            if(isset($_SESSION['username'])){
             echo "<li><a href='admin'>Admin</a></li>";
            } else {
             if($pageName == 'registration.php'){
                echo "<li class = 'active'><a href='registration.php'>Register</a></li>";
             } else { echo "<li><a href='registration.php'>Register</a></li>";}
            }
             if($pageName == 'contact.php'){
                echo "<li class = 'active'><a href='contact.php'>Contact Us</a></li>";
             } else { echo "<li><a href='contact.php'>Contact Us</a></li>";}
            
            ?>

                <?php 
                
                if(isset($_SESSION['user_role'])){
                    if(isset($_GET['p_id'])){
                        
                        echo "<li><a href='admin/posts.php?source=edit_posts&p_id={$_GET['p_id']}'>Update Post</a></li>";

                    }
                }
                
                ?>

            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>