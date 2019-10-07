<?php 

    session_start();
    $cart = $_COOKIE['MyGameProducts'];

    if (isset($_POST['clear']))
    {
        $expire = time() - 60 * 60 * 24 * 7 * 365;
        setcookie("MyGameProducts", $cart, $expire);
        header("Location:my_cart.php");
    }

    if ($cart && $_GET['id'])
    {
        $cart .= ',' . $_GET['id'];
        $expire = time() + 60 * 60 * 24 * 7 * 365;
        setcookie("MyGameProducts", $cart, $expire);
        header("Location:my_cart.php");
    }


    if (!$cart && $_GET['id'])
    {
        $cart = $_GET['id'];
        $expire = time() + 60 * 60 * 24 * 7 * 365;
        setcookie("MyGameProducts", $cart, $expire);
        header("Location:my_cart.php");
    }

    if ($cart && $_GET['remove_id'])
    {
        $removed_item = $_GET['remove_id'];
        $arr = explode(",", $cart);
        unset($arr[$removed_item - 1]);
        $new_cart = implode(",", $arr);
        $new_cart = rtrim($new_cart, ",");
        $expire = time() + 60 * 60 * 24 * 7 * 365;
        setcookie("MyGameProducts", $new_cart, $expire);
        header("Location:my_cart.php");
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
            <table>
                <tr>
                    <th>Item Name</th>
                    <th>Description</th>
                    <th>Prices</th>
                    <th>Actions</th>
                </tr>
                <?php 
                    $cart = $_COOKIE['MyGameProducts'];
                    if ($cart)
                    {
                        $i = 1;
                        include('dbc.php');
                        $items = explode(',', $cart);

                        foreach ($items AS $item)
                        {
                            $sql = "SELECT * FROM products WHERE id = '$item'";
                            $result = mysqli_query($connection, $sql);

                            if ($result == false)
                            {
                                $mysqli_error = mysqli_error($connection);
                                echo "There was a query error: $mysql_error";
                            }
                            else
                            {
                                while ($row = mysqli_fetch_assoc($result))
                                {
                                    echo '<tr>';
                                       echo '<td align="left">' . $row['title'] . '</td>'; 
                                       echo '<td align="left">' . $row['description'] . '</td>'; 
                                       echo '<td align="left">' . $row['price'] . '</td>'; 
                                       echo '<td align="left"><a href="my_cart.php?remove_id=' . $i . '">Remove From Cart</a></td>';
                                    echo '</tr>';
                                }
                                $i++;
                            }
                        }
                    }
                ?>
            </table><br>
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="submit" name="clear" value="Empty Shopping Cart" style="maring-left: 40px;">
            </form>
		</section>
	</div>

	<?php include('includes/footer.inc'); ?>
</body>
</html>
