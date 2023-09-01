<?php

include 'config.php';

if (isset($_POST['submit'])) {
	$firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
	$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$password1 = mysqli_real_escape_string($conn, $_POST['password1']);
	$address = mysqli_real_escape_string($conn, $_POST['address']);
	$city = mysqli_real_escape_string($conn, $_POST['city']);

	$select = mysqli_query($conn, "SELECT * FROM user1 WHERE email='$email' AND password = '$password' ") or die('query Failed');


	if (mysqli_num_rows($select) > 0) {
		$message[] = 'user already exist!';
	} else {
		mysqli_query($conn, "INSERT INTO `user1` (firstname, lastname, email, username, password, password1, address, city) VALUES ('$firstname', '$lastname', '$email', '$username', '$password', '$password1', '$address', '$city');") or die('query Failed');
		$message[] = 'REGISTRATION SUCCESSFUL';
		header('location:user.php');
	}
}

?>
<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SSIPL-Sign-Up</title>
</head>

<body>

	<!--navbar-->

	<nav class="navbar navbar-expand bg-info navbar-dark py-3 ">
		<div class="container">
			<a href="index.php" class="navbar-brand text-dark">Softex Sweater Industries (Pvt.) Ltd.</a>
			<ul class="navbar-nav  ms-auto">
				<li class="nav-item">
					<a href="signup.php" class="nav-link text-dark">Sign Up</a>
				</li>
				<li class="nav-item">
					<a href="user.php" class="nav-link text-dark">Login</a>
				</li>
				<li class="nav-item">
					<a href="admin.php" class="nav-link text-dark">Admin</a>
				</li>
			</ul>
		</div>
		</div>
	</nav>
	<!--Card middle body-->
	<section class="p-5">
		<div class="container">
			<div class="row text-center g-4 ">
				<div class="col-md">
					<div class="card bg-info text-dark mt-5">
						<div class="card-body text-center text-dark">
							<div class="h1 mb-3">
								<i class="fa-address-book"></i>
							</div>
							<h3 class="card-title mb-3">REGISTER!</h3>
							<p class="card-text">
								Fill Up the REGISTRATION FORM
							</p>
							<form class="container" action="" method="post">
								<div class="form-row ">
									<div class="col-md mb-3">
										<input name="firstname" type="text" class="form-control" placeholder="First name">
									</div>
									<div class="col-md mb-3">
										<input name="lastname" type="text" class="form-control" placeholder="Last name">
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-6 mb-3">
										<input name="email" type="email" class="form-control" id="inputEmail4" placeholder="Email">
									</div>
								</div>
								<div class="col-md mb-3">
									<input name="username" type="text" class="form-control" placeholder="Username">
								</div>
								<div class="col-md mb-3">
									<input name="password" type="text" class="form-control" placeholder="Password">
								</div>
								<div class="col-md mb-3">
									<input name="password1" type="text" class="form-control" placeholder="Password">
								</div>
								<div class="col-md mb-3">
									<input name="address" type="text" class="form-control" placeholder="Type Your Address, Country,State,District">
								</div>
								<div class="col-md mb-3">
									<input name="city" type="text" class="form-control" placeholder="city">
								</div>
								<button type="submit" name="submit" class="btn btn-outline-dark">Register</button>
								<p class="card-text mt-1">Already Registered? </p> <a href="user.php">Login now!</a>
								<?php
								if (isset($message)) {
									foreach ($message as $message) {
										echo '<p class="card-text" onclick="this.remove();">' . $message . '
				      	</p>';
									}
								}

								?>

							</form>

						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--footer-->
	<div class="footer ">
		<footer class=" p-3 mb-5 bg-info text-white text-center ">
			<div class="container">
				<p class="lead text-dark">Our Social Media Contacts</p>
				<a href="#"><i class="bi bi-twitter text-dark mx-1"></i></a>
				<a href="#"><i class="bi bi-facebook text-dark mx-1"></i></a>
				<a href="#"><i class="bi bi-linkedin  text-dark mx-1"></i></a>
				<a href="#"><i class="bi bi-instagram text-dark mx-1"></i></a>
			</div>
		</footer>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>