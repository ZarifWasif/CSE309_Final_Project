<?php
include 'config.php';

session_start();

$admin = $_SESSION['username'];

if (!isset($admin)) {
	header('location:admin.php');
}

if (isset($_GET['logout'])) {
	unset($admin);
	session_destroy();
	header('location:admin.php');
};
$sql = " SELECT * FROM contact";
$result = $conn->query($sql);
$conn->close();

?>

<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Contact Data</title>
</head>

<body>

	<!--navbar-->

	<nav class="navbar navbar-expand bg-info navbar-dark py-3 ">
		<div class="container">
			<a href="home.php" class="navbar-brand text-dark">Softex Sweater Industries (Pvt.) Ltd.</a>
			<ul class="navbar-nav  ms-auto">

				<li class="nav-item">
					<a href="private.php" class="nav-link text-dark">Add Product</a>
				</li>
				<li class="nav-item">
					<a href="private1.php" class="nav-link text-dark ">Contact Table</a>
				</li>
				<li class="nav-item">
					<a href="admin.php?logout=<?php echo $admin; ?>" onclick="return confirm('are your sure you want to logout?');" class="nav-link text-dark">Log Out</a>
				</li>
			</ul>
		</div>
		</div>
	</nav>
	<!--Card middle body-->
	<h3 class=" p-3 mb-5  text-center ">CONTROL PANEL TABLE</h3>
	<section class="p-5">
		<div class="container">
			<div class="row text-center g-4 ">
				<div class="col-md">
					<div class="card bg-info text-dark ">
						<div class="card-body text-center">
							<div class="h1 mb-3">
								<i class="fa-address-book"></i>
							</div>
							<h3 class="card-title mb-3">Contact Requests</h3>
							<table class="table">
								<thead>
									<tr>
										<th scope="col">Firstname</th>
										<th scope="col">lastname</th>
										<th scope="col">email</th>
										<th scope="col">message</th>
										<th scope="col">address</th>
										<th scope="col">city</th>
									</tr>
								</thead>
								<tbody>
									<?php
									while ($rows = $result->fetch_assoc()) {
									?>
										<tr>
											<td><?php echo $rows['firstname'] ?></td>
											<td><?php echo $rows['lastname'] ?></td>
											<td><?php echo $rows['email'] ?></td>
											<td><?php echo $rows['message'] ?></td>
											<td><?php echo $rows['Addresss'] ?></td>
											<td><?php echo $rows['city'] ?></td>
										</tr>
									<?php
									}
									?>
								</tbody>
							</table>
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