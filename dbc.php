<?php

$host = "localhost";
$username = "root";
$password = "thx1138GOOGLE!!";
$database = "gameSite";

$connection = mysqli_connect($host, $username, $password, $database);

if (!$connection)
{
	die("Error: " . mysqli_errno());
}
