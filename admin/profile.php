<?php include "includes/adminheader.php" ?>
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
            $user_role = escape($row['user_role']);
            $user_gender = escape($row['user_gender']);
            $user_image = escape($row['user_img']);
        }
    }
    if (isset($_POST['update_user'])) {
        $user_firstname = escape($_POST['user_firstname']);
        $user_lastname = escape($_POST['user_lastname']);
        $user_role = escape($_POST['user_role']);
        $username= escape($_POST['username']);
        // $post_image = $_FILES['image']['name'];
        // $post_image_temp = $_FILES['image']['tmp_name'];
        $user_email = escape($_POST['user_email']);
        $user_password = escape($_POST['user_password']);
        $user_gender = escape($_POST['user_gender']);

        // move_uploaded_file($post_image_temp, "../images/$post_image");


        $query = "UPDATE users SET ";
        $query .= "first_name = '{$user_firstname}', ";
        $query .= "last_name = '{$user_lastname}', ";
        $query .= "user_role = '{$user_role}', ";
        $query .= "username = '{$username}', ";
        $query .= "user_password = '{$user_password}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_gender = '{$user_gender}' ";
        $query .= "WHERE user_id = '{$the_user_id}'";

        $update_user_query = mysqli_query($connection, $query);

        confirmQuery($update_user_query);
    }
?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/adminNav.php" ?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to your Admin Panel
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
                            <div class="form-group">
                                <label for="author">User Role</label>
                                <select name="user_role" id="user_role">
                                    <?php 
                                        if ($user_role == 'Admin') {
                                            echo "<option value='Admin' selected>Admin</option>
                                            <option value='Shopper'>Shopper</option>";
                                        }
                                        else{
                                            echo "<option value='Admin'>Admin</option>
                                            <option value='Shopper' selected>Shopper</option>";  
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

<?php include "includes/adminfooter.php" ?>