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
            <table width="100%">
                <tr>
                    <th>Item Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Reviews</th>
                    <th>Buy</th>
                </tr>
                <?php 
                    include('dbc.php'); 
                    $sql = "SELECT * FROM products ORDER BY id ASC;";
                    $result = mysqli_query($connection, $sql);

                    if ($result == false)
                    {
                        $error_message = mysqli_error($connection);
                        echo "<p>There has been a query error: $error_message</p>";
                    }
                    else
                    {
                        if (mysqli_num_rows($result) == 0)
                        {
                            echo '<tr>
                                <td colspan="4">Sorry...No Data</td>
                            </tr>';
                        }
                        else
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {
                                echo '<tr>';
                                echo '<td align="center">' . $row['title'] . '</td>';
                                echo '<td align="center">' . $row['desciption'] . '</td>';
                                echo '<td align="center">' . $row['price'] . '</td>';
                                echo '<td align="center"><a href="reviews.php?product_id=' . $row['id'] . '">Reviews</a></td>';
                                echo '<td align="center"><a href="my_cart.php?id=' . $row['id'] . '">Add to Cart</a></td>';
                                echo '</tr>';
                            }
                        }
                    }
                ?>

            </table>
		</section>
	</div>

	<?php include('includes/footer.inc'); ?>
</body>
</html>
