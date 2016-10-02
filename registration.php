<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
<?php include "functions.php"; ?>

<?php session_start(); ?>

<?php 

    if (isset($_POST['submit'])) {
        $first_name = escape($_POST['first_name']);
        $last_name = escape($_POST['last_name']);
        $username = escape($_POST['username']);
        $email = escape($_POST['email']);
        $password = escape($_POST['password']);

        if (!empty($first_name) && !empty($last_name) && !empty($username) && !empty($email) && !empty($password)) {

            $safe_password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12) );


            $message = "<h6 class='text-center bg-success'>Your registration has been submitted</h6>";

            $query = "INSERT INTO users (username, first_name, last_name, user_email, user_password, user_role) ";
            $query .= "VALUES('{$username}', '{$first_name}', '{$last_name}', '{$email}', '{$safe_password}', 'Shopper' )";
            $register_user_query = mysqli_query($connection, $query);
            if (!$register_user_query) {
                die("Query Failed " . mysqli_error($connection) . ' ' . mysqli_errno($connection));
            }
        } 
        else{
                $message = "<h6 class='text-center bg-warning'>Fields must not be left empty</h6>";
        }

        

    } 
    else{
            $message = "";
    }

?>


<!-- Navigation -->

<?php  include "includes/nav.php"; ?>

 
<!-- Page Content -->
<div class="container">
    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Register</h1>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                            <?php echo $message; ?>
                            <div class="form-group">
                                <label for="first_name" class="sr-only">first name</label>
                                <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name">
                            </div>
 							<div class="form-group">
                                <label for="last_name" class="sr-only">last name</label>
                                <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name">
                            </div>
                            <div class="form-group">
                                <label for="username" class="sr-only">username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email">
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                            </div>         
                            <div class="form-group">
                                <label for="passwordRepeat" class="sr-only">Retype Password</label>
                                <input type="password" name="passwordRepeat" class="form-control" placeholder="Retype Password">
                            </div>         
                            <input type="submit" name="submit" id="btn-login" class="btn btn-primary btn-lg btn-block" value="Register">
                        </form>
                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>
<?php
	include 'includes/footer.php';
?>