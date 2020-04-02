<?php include "include/db.php"; ?>
<?php include "include/header.php"; ?>
<!-- Navigation -->
<?php include "include/navbar.php"; ?>

<?php 


if(isset($_POST['submit'])){

    if(!empty($_POST['botcatcher'])){
        die('gotcha bot!');
    } 

    $to = "stefangouldson@gmail.com";
    $subject = $_POST['subject'];
    $msg = $_POST['body'];

    $msg = wordwrap($msg, 70);

    $header = "From: " . $_POST['email'];
    mail($to, $subject, $msg, $header);
}
?>


<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-wrap">
                        <h1>Contact Us</h1>
                        <form role="form" action="" method="post" id="login-form" autocomplete="off">
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your Email">
                            </div>

                            <div class="form-group">
                                <label for="subject" class="sr-only">Subject</label>
                                <input type="text" name="subject" id="key" class="form-control" placeholder="Enter Subject">
                            </div>

                            <div class="form-group">
                                <textarea class="form-control" name="body" id="body" cols="30" rows="10"></textarea>
                            </div>

                            <input type="text" name="botcatcher" style="display:none" value="">

                            <input type="submit" name="submit" id="btn-login" class="btn btn-primary" value="Submit">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>



    <?php include "include/footer.php"; ?>