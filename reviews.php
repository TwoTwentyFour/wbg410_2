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
            <h2>Review</h2>
            <table width="100%">
                <th>Name</th>
                <th>Comment</th>
                <?php 
                    include('dbc.php');
                    $product_id = $_GET['product_id'];

                    $query = "SELECT * FROM reviews WHERE product_id = $product_id;";
                    if ($result = mysqli_query($connection, $query))
                    {
                        if (mysqli_num_rows($result) == 0)
                        {
                            echo '<p>There are no reviews for this item.</p>';
                        }
                        else
                        {
                            while ($row = mysqli_fetch_assoc($result))
                            {
                                echo '<tr>
                                    <td>' . $row['name'] . '</td>
                                    <td>' . $row['comment'] . '</td>
                                </tr>';
                            }
                        }
                    }
                    else
                    {
                        $error_message = mysqli_error();
                        echo '<p>There has been a query error: $error_message</p>';
                    }
                ?>
            </table>
        <?php echo '<td align="center"><a href="add_review.php?product_id=' . $_GET['product_id'] . '">Add A Review</a></td>'; ?>
		</section>
	</div>

	<?php include('includes/footer.inc'); ?>
</body>
</html>
