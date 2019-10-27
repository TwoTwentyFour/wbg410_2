<?php 
if (isset($_POST['submit_review']))
{
    $product_id = $_GET['product_id'];
    $name = $_POST['name'];
    $comment = $_POST['comment'];
    include('dbc.php');
    $result = mysqli_query($connection, "INSERT INTO reviews (name, comment, product_id) VALUES('$name', '$comment', '$product_id')");
    if ($result)
    {
        $msg = "<p><strong>Review added!</strong>";
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
            <h2>Add a Review</h2>
            <form id="form1" name="form1" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="hidden" name="product_id" id="" value="<?php $_GET['product_id']; ?>">
                <p>Name:<br><input type="text" name="name" required="requiered"</p>
                <p>Comment:<br><input type="text" name="comment" required="requiered"</p>
                 <p><input type="submit" name="submit_review" value="Submit"></p>
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
