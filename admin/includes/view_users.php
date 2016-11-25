    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Username</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
        </thead>

        <tbody>

            <?php
                $query = "SELECT * FROM users";
                $select_users_query = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($select_users_query)) {
                    $user_id = escape($row['user_id']);
                    $username = escape($row['username']);
                    $user_password = escape($row['user_password']);
                    $user_firstname = escape($row['first_name']);
                    $user_lastname = escape($row['last_name']);
                    $user_email = escape($row['user_email']);
                    $user_role = escape($row['user_role']);
                    $user_image = escape($row['user_img']);

                    echo "<tr>";
                    echo "<td>{$user_id}</td>";
                    echo "<td>{$username}</td>";
                    echo "<td>{$user_firstname}</td>";

                   

                    echo "<td>{$user_lastname}</td>";
                    echo "<td>{$user_email}</td>";

                    echo "<td>{$user_role}</td>";

                    echo "<td><a href='users.php?change_to_admin={$user_id}'>Admin</a></td>";
                    echo "<td><a href='users.php?change_to_shopper={$user_id}'>Shopper</a></td>";
                    echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
                    echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
                    echo "</tr>";
                }
            ?>

          
      </tbody> 
    </table>
<?php
    if (isset($_GET['delete'])) {
        if (isset($_SESSION['user_role'])) {
            if ($_SESSION['user_role'] == 'Admin') {
                $the_user_id = escape($_GET['delete']);

                $query = "DELETE FROM users WHERE user_id = {$the_user_id} ";
                $delete_user_query = mysqli_query($connection, $query);
                header("Location: users.php");
            }
        }
        
    }
    if (isset($_GET['change_to_admin'])) {
        $the_user_id = escape($_GET['change_to_admin']);

        $query = "UPDATE users SET user_role = 'Admin' WHERE user_id = {$the_user_id} ";
        $change_to_admin_query = mysqli_query($connection, $query);
        header("Location: users.php");
    }
    if (isset($_GET['change_to_shopper'])) {
        $the_user_id = escape($_GET['change_to_shopper']);

        $query = "UPDATE users SET user_role = 'Shopper' WHERE user_id = {$the_user_id} ";
        $change_to_shopper_query = mysqli_query($connection, $query);
        header("Location: users.php");
    }
?> 