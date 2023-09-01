<?php

include 'config.php';
session_start();

$username = $_SESSION['username'];

if (!isset($username)) {
	header('location:user.php');
}

if (isset($_GET['logout'])) {
	unset($username);
	session_destroy();
	header('location:user.php');
}

?>
<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" type="text/css" href="style1.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SSIPL</title>
</head>

<body>

	<!--navbar-->

	<nav class="navbar navbar-expand bg-info navbar-dark py-3 ">
		<div class="container">
			<a href="home.php" class="navbar-brand text-dark">Softex Sweater Industries (Pvt.) Ltd.</a>
			<ul class="navbar-nav  ms-auto">
				<li class="nav-item">
					<a href="home.php" class="nav-link text-dark">Home</a>
				</li>
				<li class="nav-item">
					<a href="datalisting.php" class="nav-link text-dark">Products</a>
				</li>
				<li class="nav-item">
					<a href="contact.php" class="nav-link text-dark">Contact Us</a>
				</li>
				<li class="nav-item">
					<a href="cart.php" class="nav-link text-dark">Cart</a>
				</li>
				<li class="nav-item text-dark">
					<a href="home.php?logout=<?php echo $username; ?> " onclick="return confirm('Do you want to logout?')" class="nav-link text-dark">Logout</a>
				</li>
			</ul>
		</div>
		</div>
	</nav>
	<!--Card middle body-->
	<div class="container mt-5">
		<h3>Home Page</h3>
		<?php
		$select_user = mysqli_query($conn, "SELECT * FROM user1 WHERE username='$username' ") or die('query failed');
		if (mysqli_num_rows($select_user) > 0) {
			$fetch_user = mysqli_fetch_assoc($select_user);
		};
		?>

		<p>Welcome <span><?php echo $fetch_user['firstname'] ?></span> </p>
	</div>
	<!--content-->
	<div class="container mt-5">
		<h3>Check Our Recent Collections</h3>
		<div class="d-flex justify-content-start flex-wrap">
			<img class="rounded m-1 border border-dark" width="700" height="400" src="img/banner-img.jpg" alt="Card image cap">
			<img class="rounded m-1 border border-dark" width="450" height="400" src="img/img1.jpg" alt="Card image cap">
			<img class="rounded m-1 border border-dark" width="400" height="400" src="img/product-3.jpg" alt="Card image cap">
			<img class="rounded m-1 border border-dark" width="400" height="400" src="img/product-4.jpg" alt="Card image cap">
			<img class="rounded m-1 border border-dark" width="400" height="400" src="img/product-5.jpg" alt="Card image cap">
		</div>

	</div>
	<!--content-->
	<div class="container mt-5 mb-5">
		<h3>Check Our Most Famous</h3>
		<div class="d-flex justify-content-start flex-wrap">
			<img class="rounded m-1 border border-dark" width="400" height="400" src="img/product-3.jpg" alt="Card image cap">
			<img class="rounded m-1 border border-dark" width="400" height="400" src="img/skirt.png" alt="Card image cap">
			<img class="rounded m-1 border border-dark" width="400" height="400" src="img/product-1.jpg" alt="Card image cap">
			<img class="rounded m-1 border border-dark" width="400" height="400" src="img/product-5.jpg" alt="Card image cap">
			<img class="rounded m-1 border border-dark" width="400" height="400" src="img/product-6.jpg" alt="Card image cap">
			<img class="rounded m-1 border border-dark" width="400" height="400" src="img/product-4.jpg" alt="Card image cap">
		</div>
	</div>
	<!--footer-->
	<div class="footer mb-5">
		<footer class=" p-3 mb-5 bg-info text-dark text-center ">
			<div class="container">
				<p class="lead">Photo Gallary</p>
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