<?php session_start(); ?>

<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
<?php include "functions.php"; ?>

<?php include "includes/header.php" ?>

<?php
    $itemCount = 0; 
    if(isset($_SESSION['cart'])){
        $itemCount = count(isset($_SESSION['cart']) ? $_SESSION['cart'] : array()); 
    }
?>
<?php
    if (isset($_SESSION['user_id'])) {
        $the_user_id = $_SESSION['user_id'];
        $query = "SELECT * FROM users WHERE user_id = '{$the_user_id}'";
        $select_user_profile_query = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_array($select_user_profile_query)) {
            $user_id = escape($row['user_id']);
            $username = escape($row['username']);
            $user_password = escape($row['user_password']);
            $user_firstname = escape($row['first_name']);
            $user_lastname = escape($row['last_name']);
            $user_email = escape($row['user_email']);
            $user_gender = escape($row['user_gender']);
            $user_image = escape($row['user_img']);
        }
    }
    if (isset($_POST['update_user'])) {
        $user_firstname = escape($_POST['user_firstname']);
        $user_lastname = escape($_POST['user_lastname']);
        $username= escape($_POST['username']);
        // $post_image = $_FILES['image']['name'];
        // $post_image_temp = $_FILES['image']['tmp_name'];
        $user_email = escape($_POST['user_email']);
        $user_password = escape($_POST['user_password']);
        $user_gender = escape($_POST['user_gender']);

        // move_uploaded_file($post_image_temp, "../images/$post_image");

        if (!empty($user_password)) {
            $query_password = "SELECT user_password FROM users WHERE user_id = $the_user_id";
            $get_user_query = mysqli_query($connection, $query_password);
            confirmQuery($get_user_query);

            $row = mysqli_fetch_array($get_user_query);
            $db_user_password = $row['user_password'];

            if ($db_user_password != $user_password) {
                $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10) );
            }else{$hashed_password=$user_password;}

            $query = "UPDATE users SET ";
            $query .= "first_name = '{$user_firstname}', ";
            $query .= "last_name = '{$user_lastname}', ";
            $query .= "username = '{$username}', ";
            $query .= "user_password = '{$hashed_password}', ";
            $query .= "user_email = '{$user_email}', ";
            $query .= "user_gender = '{$user_gender}' ";
            $query .= "WHERE user_id = '{$the_user_id}'";

            $update_user_query = mysqli_query($connection, $query);

            confirmQuery($update_user_query);
            echo "User Updated" . " <a href='users.php'>View Users</a>";
        } else {
            $query = "UPDATE users SET ";
            $query .= "first_name = '{$user_firstname}', ";
            $query .= "last_name = '{$user_lastname}', ";
            $query .= "user_role = '{$user_role}', ";
            $query .= "username = '{$username}', ";
            $query .= "user_email = '{$user_email}' ";
            $query .= "WHERE user_id = {$the_user_id}";

            $update_user_query = mysqli_query($connection, $query);

            confirmQuery($update_user_query);

            echo "User Updated" . " <a href='users.php'>View Users</a>";

        }
    }
?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/nav.php" ?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Edit Your Profile
                            <small><?php echo $_SESSION['username'] ?></small>
                        </h1>

                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="user_firstname">First Name</label>
                                <input type="text" value="<?php echo $user_firstname ?>" class="form-control" name="user_firstname" id="user_firstname">
                            </div>
                            <div class="form-group">
                                <label for="user_lastname">Last Name</label>
                                <input type="text" value="<?php echo $user_lastname ?>" class="form-control" name="user_lastname" id="user_lastname">
                            </div>
                            <div class="form-group">
                                <label for="author">Gender</label>
                                <select name="user_gender" id="user_gender">
                                    <?php 
                                        if ($user_gender == 'Male') {
                                            echo "<option value='Male' selected>Male</option>
                                            <option value='Female'>Female</option>";
                                        }
                                        else{
                                            echo "<option value='Male'>Male</option>
                                            <option value='Female' selected>Female</option>";  
                                        }
                                    ?>
                                </select>
                            </div>
                            <!-- <div class="form-group">
                                <label for="post_image">Post Image</label>
                                <input type="file" name="image">
                            </div> -->
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" value="<?php echo $username ?>" class="form-control" name="username" id="username">
                            </div>
                            <div class="form-group">
                                <label for="user_email">Email</label>
                                <input type="email" value="<?php echo $user_email ?>" class="form-control" name="user_email" id="user_email"></input>
                            </div>

                            <div class="form-group">
                                <label for="user_password">Password</label>
                                <input type="password" value="<?php echo $user_password ?>" class="form-control" name="user_password" id="user_password">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" name="update_user" value="Update Profile">
                            </div>
                        </form>


                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/footer.php" ?>