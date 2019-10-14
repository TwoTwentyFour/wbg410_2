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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" charset="utf-8">
<script charset="utf-8">
    $(document).ready(function() {
        $('#sendData').click(function() {
            var theId = $('#id').val();
            var newTitle = $('#title').val();
            var newContent = $('#message').val();
            $.post('AJAX/ajax_update.php', {table:"home_page", id:theId, title:newTitle, message:newContent},
                function (response, textStatus, jqXHR) {
                    if (response) {
                        $('#updateResults').html('The response: ' + response + '<strong>' + textStatus + '</strong>');
                        $('#updateResults').append('<br><a href="home_page.php">Return to Home Page</a>');
                    }
                    else
                    {
                        $('#updateResults').html("Sorry! It didn't work!");
                    }
            });
        });
    });
</script>
    
</script>
</head>

<body>
	<?php include('includes/header.inc'); ?>
	<?php include('includes/nav.inc'); ?>

	<div id="wrapper">
		<?php include('includes/aside.inc'); ?>

		<section>
            <h2>Update Home Page</h2>
            <?php  
                if (isset($_POST['Sumbit_Update']))
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
            <div id="updateResult">
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
                <p><input type="button" name="Submit_Update" value="Update" id="sendData"></p>
            </div>
		</section>
	</div>

	<?php include('includes/footer.inc'); ?>
</body>
</html>
