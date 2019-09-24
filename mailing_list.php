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
            <h2>The Mailing List</h2>
            <table width="100%">
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Comments</th>
                <?php 
                    include('dbc.php');
                    $query = "SELECT * FROM mailing_list ORDER BY id";
                    if ($result = mysqli_query($connection, $query))
                    {
                        if (mysqli_num_rows($result) == 0)
                        {
                            echo '<p>No members are signed up yet.</p>';
                        }
                        else
                        {
                            while ($row = mysqli_fetch_assoc($result))
                            {
                                echo '<tr>
                                    <td>' . $row['name'] . '</td>
                                    <td>' . $row['phone'] . '</td>
                                    <td>' . $row['email'] . '</td>
                                    <td>' . $row['comments'] . '</td>
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
		</section>
	</div>

	<?php include('includes/footer.inc'); ?>
</body>
</html>
