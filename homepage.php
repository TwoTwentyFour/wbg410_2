<?php

require_once('dbc.php');

$query = "SELECT * FROM home_page ORDER BY id DESC";
$result = mysqli_query($connection, $query);

if ($result == false)
{
	$error_message = mysqli_errno();
	echo "<p>Error: $error_message</p>";
}

if (mysqli_num_rows($result) == 0)
{
	echo "There seems to be an issue with the connection. Try again later.";
}

while ($row = mysqli_fetch_assoc($result))
{
	echo '<h2>' . $row['tilte'] . '</h2>';
	echo '<p>' . $row['message'] . '</p>';
}

mysqli_free_result($result);
mysqli_close($connection);
