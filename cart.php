<?php

@include 'config.php';

if (isset($_POST['update_update_btn'])) {
  $update_value = $_POST['update_quantity'];
  $update_id = $_POST['update_quantity_id'];
  $update_quantity_query = mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_value' WHERE id = '$update_id'");
  if ($update_quantity_query) {
    header('location:cart.php');
  };
};

if (isset($_GET['remove'])) {
  $remove_id = $_GET['remove'];
  mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'");
  header('location:cart.php');
};

if (isset($_GET['delete_all'])) {
  mysqli_query($conn, "DELETE FROM `cart`");
  header('location:cart.php');
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
  <title>Contact US</title>
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
  <section class="container mt-5">
    <h3>Cart</h3>
    <div class="mt-5">
      <table class="table table-info">
        <thead>
          <tr>
            <th scope="col">Image</th>
            <th scope="col">Product Name</th>
            <th scope="col">Product Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Total Price</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <?php
        $final_total = 0;
        $select = mysqli_query($conn, "SELECT * FROM cart");

        if (mysqli_num_rows($select) > 0) {
          while ($fetch = mysqli_fetch_assoc($select)) {


        ?>

            <tbody>
              <tr>
                <th scope="row"><img src="uploaded_img/<?php echo $fetch['image']; ?>" height="90"></th>
                <td><?php echo $fetch['product_name']; ?></td>
                <td><?php echo $fetch['product_price']; ?></td>
                <td>
                  <form action="" method="post">
                    <input type="hidden" name="update_quantity_id" value="<?php echo $fetch['id']; ?>">
                    <input type="number" name="update_quantity" min="1" value="<?php echo $fetch['quantity']; ?>">
                    <input type="submit" value="update" name="update_update_btn">
                  </form>
                </td>
                <td>$<?php echo $total = number_format($fetch['product_price'] * $fetch['quantity']); ?></td>
                <td>
                  <a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('remove item from cart?')" class="delete-btn text-dark"><button type="button" class="btn btn-danger text-light">Remove</button></a>
                </td>
              </tr>
          <?php
            $final_total += $total;
          }
        }
          ?>

          <tr class="table-bottom">
            <td><a href="datalisting.php"><button type="button" class="btn btn-outline-dark">continue shopping</button></a></td>
            <td colspan="3">grand total</td>
            <td>$<?php echo $final_total; ?>/-</td>
            <td><a href="cart.php?delete_all" onclick="return confirm('are you sure you want to delete all?');" class="delete-btn"> <button type="button" class="btn btn-secondary">Delete All</button></a></td>
          </tr>

            </tbody>
      </table>
      <a href="checkout.php" class="btn <?= ($final_total > 1) ? '' : 'disabled'; ?>">
        <button type="button" class="btn btn-outline-dark">Procced to checkout</button></a>

    </div>
  </section>
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