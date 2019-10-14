<?php 
if (isset($_POST['submit_register']))
{
    $email = $_POST['email'];
    $pwd = md5($_POST['password']);
    include('dbc.php');
    $result = mysqli_query($connection, "INSERT INTO users (email, password) VALUES('$email', '$pwd')");
    if ($result)
    {
        $msg = "<p><strong>New user successfully inserted!</strong>";
        $msg .= "<br><a href='admin_login.php'>Login Page</a></p>";
    }
    else
    {
        $error_msg = mysqli_error($connection);
        $msg = "There is an error: $error_msg";
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
            <h2>Registration Form</h2>
            <form id="form1" name="form1" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                <p>Email Address:<br><input type="text" name="email"</p>
                <p>Password:<br><input type="password" name="password"</p>
                 <p><input type="submit" name="submit_register" value="Submit"></p>
            </form><br><br>
            <?php 
                if (isset($msg))
                {
                    echo $msg;
                } 
            ?>
		</section>
	</div>

	<?php include('includes/footer.inc'); ?>
</body>
</html>
