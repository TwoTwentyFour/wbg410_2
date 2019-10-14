<?php 
if (isset($_POST['id']))
{
    include('dbc.php');
    $table = $_POST['table'];
    $id = $_POST['id'];
    $title = $_POST['title'];
    $message = $_POST['message'];
    $sql = "UPDATE $table SET title = '$title', message = '$message' WHERE id = '$id'";

    $result = mysqli_query($connection, $sql);

    if ($result)
    {
        echo '<em>Your content successfully update!</em><br>';
    }
    else
    {
        echo '<em>There was an error: $error_msg';
    }
}
?>
