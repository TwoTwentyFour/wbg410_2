<?php 
session_start();

if (isset($_POST['Submit_Login']))
{
    $email = trim($_POST['email']);
    $pwd = md5(trim($_POST['pwd']));
    echo $email .'<br>'. $pwd;

    include('dbc.php');
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) == 0)
    {
        $msg = '<h2 style="color: red;">Invalid Credentials!</h2>';
    }
    else
    {
        $_SESSION['user']  = $email;
        $msg = '<h2>Login Successful!</h2>';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>My Gaming Products Site</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<?php include('includes/header.inc'); ?>
	<?php include('includes/nav.inc'); ?>

	<div id="wrapper">
		<?php include('includes/aside.inc'); ?>

		<section>
            <h2>Admin Login</h2>
            <?php echo $msg . '<br>' ?>
             <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1">
                <p>Email Address: <br><input type="email" name="email"></p>
                <p>Password: <br><input type="password" name="pwd"></p>
                <p><input type="submit" name="Submit_Login" value="Login">
             </form>
		</section>
	</div>

	<?php include('includes/footer.inc'); ?>
</body>
</html>
