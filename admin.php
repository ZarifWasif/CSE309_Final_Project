<?php
@include 'config.php';

session_start();

if (isset($_POST['submit'])) {
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);

	$select = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' AND password='$password'") or die('invalid');

	if (mysqli_num_rows($select) > 0) {
		$row = mysqli_fetch_assoc($select);
		$_SESSION['username'] = $row['username'];
		header('location:private.php');
	} else {
		$message[] = 'incorrect initials';
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
	<title>SSIPL</title>
</head>

<body>

	<!--navbar-->

	<nav class="navbar navbar-expand bg-info navbar-dark py-3 ">
		<div class="container ">
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
	<section class="p-5 mt-5">
		<div class="container mt-5">
			<div class="row text-center g-4 mt-5 ">
				<div class="col-md">
					<div class="card bg-info mt-5 text-dark ">
						<div class="card-body text-center text-dark">
							<div class="h1 mb-3">
								<i class="fa-address-book"></i>
							</div>
							<h3 class="card-title mb-3">LOG IN TO YOUR ADMIN PANEL</h3>
							<form class="container mt-5" action="" method="post">
								<div class="form-row ">
									<div class="col-md mb-3">
										<input name="username" type="text" class="form-control" placeholder="username">
									</div>
									<div class="col-md mb-3">
										<input name="password" type="password" class="form-control" placeholder="Password">
									</div>
								</div>
								<button type="submit" name="submit" class="btn btn-outline-dark">LOGIN</button>

								<?php
								if (isset($message)) {
									foreach ($message as $message) {
										echo '<div class="message" onclick="this.remove();">' . $message . '</div>';
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
	<div class="footer mb-5">
		<footer class=" p-3 mb-5 bg-info text-dark text-center ">
			<div class="container">
				<p class="lead">Our Social Media Contacts</p>
				<a href="#"><i class="bi bi-facebook text-dark mx-1"></i></a>
				<a href="#"><i class="bi bi-instagram text-dark mx-1"></i></a>
				<a href="#"><i class="bi bi-youtube  text-dark mx-1"></i></a>
				<a href="#"><i class="bi bi-twitter text-dark mx-1"></i></a>
			</div>
		</footer>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>