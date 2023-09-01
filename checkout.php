<?php

@include 'config.php';

if (isset($_POST['order_btn'])) {

   $firstname = $_POST['firstname'];
   $lastname = $_POST['lastname'];
   $email = $_POST['email'];
   $method = $_POST['method'];
   $Address = $_POST['Address'];
   $city = $_POST['city'];

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart`");
   $price_total = 0;
   if (mysqli_num_rows($cart_query) > 0) {
      while ($product_item = mysqli_fetch_assoc($cart_query)) {
         $product_name[] = $product_item['product_name'] . ' (' . $product_item['quantity'] . ') ';
         $product_price = number_format($product_item['product_price'] * $product_item['quantity']);
         $price_total += $product_price;
      };
   };

   $total_product = implode(', ', $product_name);
   $detail_query = mysqli_query($conn, "INSERT INTO products_ordered(firstname, lastname, email,method, Addresss, city,product_quantity, cost) VALUES('$firstname','$lastname','$email','$method','$Address','$city','$total_product','$price_total')") or die('query failed');

   if ($cart_query && $detail_query) {
      echo "
      <div class='order-message-container'>
      <div class='message-container'>
         <h3>thank you for shopping!</h3>
         <div class='order-detail'>
            <span>" . $total_product . "</span>
            <span class='total'> total : $" . $price_total . "/-  </span>
         </div>
         <div class='customer-details'>
            <p> your First Name : <span>" . $firstname . "</span> </p>
            <p> your Last Name : <span>" . $lastname . "</span> </p>
            <p> your email : <span>" . $email . "</span> </p>
            <p> your address : <span>" . $Address . ", " . $city . "</span> </p>
            <p> your payment mode : <span>" . $method . "</span> </p>
            <p>(*pay when product arrives*)</p>
         </div>
            <a href='datalisting.php' class='btn'>continue shopping</a>
         </div>
      </div>
      ";
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
            <li class="nav-item ">
               <a href="index.php " class="nav-link text-dark">Logout</a>
            </li>
         </ul>
      </div>
      </div>
   </nav>
   <!--Card middle body-->
   <div class="container mt-5">
      <section class="checkout-form">

         <h1 class="heading">Confirm The Order </h1>

         <form action="" method="post">

            <div>
               <?php
               $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
               $total = 0;
               $grand_total = 0;
               if (mysqli_num_rows($select_cart) > 0) {
                  while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                     $total_price = number_format($fetch_cart['product_price'] * $fetch_cart['quantity']);
                     $grand_total = $total += $total_price;
               ?>
                     <span><?= $fetch_cart['product_name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
               <?php
                  }
               } else {
                  echo "<div class='display-order'><span>your cart is empty!</span></div>";
               }
               ?>
               <span class="grand-total"> grand total : $<?= $grand_total; ?>/- </span>
            </div>

            <div>
               <div class="inputBox">
                  <span>Your First Name</span>
                  <input type="text" placeholder="First Name" name="firstname" required>
               </div>
               <div class="inputBox">
                  <span>Your Lasst Name</span>
                  <input type="text" placeholder="Last Name" name="lastname" required>
               </div>
               <div class="inputBox">
                  <span>Email</span>
                  <input type="email" placeholder="Email" name="email" required>
               </div>
               <div class="inputBox">
                  <span>payment method</span>
                  <select name="method">
                     <option value="cash on delivery" selected>cash on devlivery</option>
                     <option value="credit cart">credit cart</option>
                     <option value="paypal">paypal</option>
                  </select>
               </div>
               <div class="inputBox">
                  <span>Address</span>
                  <input type="text" placeholder="Address" name="Address" required>
               </div>
               <div class="inputBox">
                  <span>City</span>
                  <input type="text" placeholder="city" name="city" required>
               </div>
            </div>
            <input type="submit" value="order now" name="order_btn" class="btn btn-outline-dark">
         </form>
   </div>
   </section>


   <!--Card middle body-->

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