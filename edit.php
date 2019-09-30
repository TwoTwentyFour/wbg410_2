<?php 
session_start();
$user = $_SESSION['user'];

if (!isset($user))
{
    header("Location: admin_login.php");
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
            <?php  
                if (isset($_POST['Sumit_Update']))
                {
                    include('dbc.php');
                    $table = $_POST['table'];
                    $id = $_POST['id'];
                    $title = $_POST['title'];
                    $message = $_POST['message'];
                    $sql = "UPDATE $table SET title='$title', message='$message' WHERE id='$id'";
                    $resutl = mysqli_query($connection, $sql);

                    if ($result != 0)
                    {
                        $msq = "<h2>Your content has successfully updated!</h2>";
                    }
                }
                if (isset($msg))
                {
                    echo $msg;
                }
            ?>
            <form action="<?php  $_SERVER['PHP_SELF']; ?>" method="post">
                <?php 
                    $id = $_GET['id'];
                    $table = $_GET['table'];
                    include('dbc.php');
                    $sql = "SELECT * FROM $table WHERE id = '$id';";
                    $result = mysqli_query($connection, $sql);

                    while ($row = mysqli_fetch_assoc($result))
                    {
                        echo '<input type="hidden" name="id" value="' . $id . '">';
                        echo '<input type="hidden" name="table" value="' . $table . '">';
                        echo '<p><input type="text" name="title" value="' . $row['title'] . '"></p>';
                    }
                ?>
                <p><input type="submit" name="Submit_Update" value="Update"></p>
            </form>
		</section>
	</div>

	<?php include('includes/footer.inc'); ?>
</body>
</html>
