<?php
@include 'config.php';

if (isset($_POST['add_to_cart'])) {

	$product_name = $_POST['product_name'];
	$product_price = $_POST['product_price'];
	$product_image = $_POST['product_image'];
	$product_quantity = 1;

	$select_cart = mysqli_query($conn, "SELECT * FROM cart WHERE product_name = '$product_name'");

	if (mysqli_num_rows($select_cart) > 0) {
		$message[] = 'product already added to cart';
	} else {
		$insert_product = mysqli_query($conn, "INSERT INTO cart(product_name,product_price,image,quantity) VALUES('$product_name', '$product_price','$product_image','product_quantity')");
		$message[] = 'product added to cart succefully';
	}
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
	<title>Product Page</title>
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
				<li class="nav-item">
					<a href="index.php " class="nav-link text-dark">Logout</a>
				</li>

			</ul>
		</div>
		</div>
	</nav>
	<!--Card middle body-->
	<div class="container mt-5">
		<h3>Products</h3>
		<div class="d-flex justify-content-start flex-wrap">
			<?php
			$select_products = mysqli_query($conn, "SELECT * FROM product");
			if (mysqli_num_rows($select_products)) {
				while ($fetch_product = mysqli_fetch_assoc($select_products)) {



			?>
					<form action="" method="post">
						<div class="card mt-5 m-2" style="width: 18rem;">
							<img class="card-img-top" height="350" src="uploaded_img/<?php echo $fetch_product['image']; ?>" alt="Card image cap">
							<div class="card-body">
								<h5 class="card-title"><?php echo $fetch_product['product_name']; ?></h5>
								<p class="card-text">
								<div class="price">$<?php echo $fetch_product['product_price']; ?>/-</div>
								<input type="hidden" name="product_name" value="<?php echo $fetch_product['product_name']; ?>">
								<input type="hidden" name="product_price" value="<?php echo $fetch_product['product_price']; ?>">
								<input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>"></p>
								<button type="submit" name="add_to_cart" class="btn btn-info">ADD TO CART</button>
							</div>
						</div>
					</form>
			<?php
				}
			}
			?>
		</div>

	</div>
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