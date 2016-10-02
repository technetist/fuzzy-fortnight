<?php include "db.php"; ?>
<?php include "../functions.php"; ?>
<?php session_start(); ?>

<?php 
if (isset($_POST['login'])) {
	$email=$_POST['email'];
	$password=$_POST['password'];

	$sanitized_username = mysqli_real_escape_string($connection, $email);
	$sanitized_password = mysqli_real_escape_string($connection, $password);

	$query = "SELECT * FROM users WHERE user_email = '{$sanitized_username}'";
	$select_user_query = mysqli_query($connection, $query);
	if (!$select_user_query) {
		die("QUERY Failed". mysqli_error($connection));
	}
	while ($row = mysqli_fetch_array($select_user_query)) {
		$db_user_id = escape($row['user_id']);
		$db_user_firstname = escape($row['first_name']);
		$db_user_lastname = escape($row['last_name']);
		$db_user_role = escape($row['user_role']);
		$db_user_email = escape($row['user_email']);
		$db_username = escape($row['username']);
		$db_user_password = escape($row['user_password']);
	}
	if (password_verify($sanitized_password, $db_user_password)) {
		$_SESSION['user_id'] = $db_user_id;
		$_SESSION['username'] = $db_username;
		$_SESSION['firstname'] = $db_user_firstname;
		$_SESSION['lastname'] = $db_user_lastname;
		$_SESSION['email'] = $db_user_email;
		$_SESSION['role'] = $db_user_role;
	}
	else {
		header("Location: ../index.php");
	}

	if (isset($_SESSION['role']) && $_SESSION['role'] == 'Admin') {
		header("Location: ../admin");
	}
	else {
		header("Location: ../index.php");
	}
}
?>