<?php 
if (isset($_POST['Submit_Mail_List']))
{
    $name = $_POST['theName'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $comments = $_POST['comments'];

    if ($name == "")
    {
        $nameMsg = "<br><span style='color: red;'>Your name cannot be blank.</span>";
    }

    if ($phone == "")
    {
        $phoneMsg = "<br><span style='color: red;'>Your phone number cannot be blank.</span>";
    }

    if ($email == "")
    {
        $emailMsg = "<br><span style='color: red;'>Your email cannot be blank.</span>";
    }
    else
    {
        include('dbc.php');
        $query = "INSERT INTO mailing_list (name, phone, email, comments) VALUE ('$name', '$phone', '$email', '$comments')";
        $success = mysqli_query($connection, $query);

        if ($success)
        {
            $inserted = "<h2>Thanks!</h2><h3>Your gonna see some emails.</h3>";
        }
        else
        {
            $error_message = mysli_error($connection);
            $inserted = "There was an error: $error_message";
            exit($inserted);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>My Gaming Products Site</title>
<link href="style.css" rel="stylesheet" type="text/css" />

<script charset="utf-8">
    function validateForm() {
        var theName = document.form1.theName.value;
        var phone = document.form1.phone.value;
        var email = document.form1.email.value;
        var nameMsg = document.getEletementById('nameMsg');
        var phoneMsg = document.getEletementById('phoneMsg');
        var emailMsg = document.getEletementById('emailMsg');

        if (theName == "") {
            nameMsg.innerHTML = "You name cannot be blank.";
            return false;
        }

        if (phone == "") {
            phoneMsg.innerHTML = "You phone number cannot be blank.";
            return false;
        }

        if (email == "") {
            emailMsg.innerHTML = "You email cannot be blank.";
            return false;
        }
    }    
</script>

</head>
<body>
	<?php include('includes/header.inc'); ?>
	<?php include('includes/nav.inc'); ?>

	<div id="wrapper">
		<?php include('includes/aside.inc'); ?>

		<section>
            <h2>Mailing List Sign-Up</h2>
            <?php if (isset($inserted)) { echo $inserted; } else { ?>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="form1" onSubmit="return validateForm()">
                <p>
                    <label for="">Name:</label><br><input type="text" name="theName">
                    <?php
                        if (isset($nameMsg))
                        {
                            echo $nameMsg;
                        }
                    ?>
                    <br><span id="nameMsg" style="color: red;"></span>
                </p>
                <p>
                    <label for="">Phone:</label><br>
                    <input type="text" name="phone" id="phone" >
                    <?php 
                        if (isset($phoneMsg))
                        {
                            echo $phoneMsg;
                        }
                    ?>
                    <br><span id="phoneMsg" style="color: red;"></span>
                </p>
                <p>
                    <label for="">Email:</label><br>
                    <input type="text" name="email" id="email" >
                    <?php 
                        if (isset($emailMsg))
                        {
                            echo $emailMsg;
                        }
                    ?>
                    <br><span id="emailMsg" style="color: red;"></span>
                </p>
                <p>
                    <label for="">Comments:</label><br>
                    <textarea name="comments" id="comments" rows="8" cols="40">
                    </textarea><br>
                </p>
                <p>
                    <input type="submit" name="Submit_Mail_List" id="" value="Submit">
                </p>
            </form>
            <?php } ?>
		</section>
	</div>

	<?php include('includes/footer.inc'); ?>
</body>
</html>
<section>
</section>
