<?php
    if (isset($_POST["send"])) {
        include_once "../connect.php";
        $username = filter_var($_POST['name'],FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $subject = filter_var($_POST['subject'],FILTER_SANITIZE_SPECIAL_CHARS);
		$message = filter_var($_POST['message'],FILTER_SANITIZE_SPECIAL_CHARS);


        $sql = "INSERT INTO contact(name,email,subject,message) VALUES ('$username','$email','$subject','$message')"; // query 
        $result = mysqli_query($conn, $sql); // return true if insert statement done successfully else return false
        if ($result) {
            header("Location:index.php");
        } 
    }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>contact page</title>
	<link rel="stylesheet" href="../styles/contact.css">
    <!-- font awsome for icons -->
    <link rel="stylesheet" href="../styles/fontawsome/all.min.css">
	<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&family=Poppins:wght@600;700&family=Roboto:wght@100;300;400;500;900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="contact">
		<div class="content">
			<div class="title">
				<h1>Contact <span class="title-active">us</span></h1>
			</div>
			<div class="info">
				<i class="icon fa-solid fa-location-dot" ></i>
			<h4 >address</h4>
			</div>
			
			<p class="details">alexandria moharam bik</p>
			<div class="info">
				<i class="icon fa-solid fa-phone"></i>
			<h4>phone</h4>
			</div>
			
			<p class="details">+01228969935</p>
			<div class="info">
				<i class="icon fa-solid fa-envelope"></i>
			<h4>EMAIL</h4>
			</div>
			
			<p class="details">saFari4ever@gmail.com</p>
			<div class="info">
				<a href="index.php" style="color: black"><i class="icon fa-solid fa-house"></i></a>
			<h4>website</h4>
			</div>
			
			<p class="details">safari.com</p>

		</div>
		<div class="form">
			<form method="post" action="contactUs.php">
				<h1>send message</h1>
				<input type="text" name="name" placeholder="name..." required >
				<input type="email" name="email" placeholder="email..." required>
				<input type="text" name="subject" placeholder="subject..." >
				<textarea required  name="message" placeholder="message..." maxlength="255" required></textarea>
				<input type="submit" name="send" value="send">
			</form>
			
		</div>
    </div>
</body>
</html>