<?php
@include 'config.php';

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


if (isset($_POST['add_product'])) {

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'uploaded_img/' . $product_image;

   if (empty($product_name) || empty($product_price) || empty($product_image)) {
      $message[] = 'please fill out all';
   } else {
      $insert = "INSERT INTO product(product_name, product_price, image) VALUES('$product_name', '$product_price', '$product_image')";
      $upload = mysqli_query($conn, $insert);
      if ($upload) {
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         $message[] = 'new product added successfully';
      } else {
         $message[] = 'could not add the product';
      }
   }
};

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   $delete_query = mysqli_query($conn, "DELETE FROM product WHERE id='$delete_id'") or die('query failed');
   if ($delete_query) {
      header('location:private.php');
   } else {
      $message[] = "product couldn't be updated ";
      header('location:admin.php');
   }
}

if (isset($_POST['update_product'])) {
   $update_p_id = $_POST['update_p_id'];
   $update_p_name = $_POST['update_p_name'];
   $update_p_price = $_POST['update_p_price'];
   $update_p_image = $_FILES['update_p_image']['name'];
   $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
   $update_p_image_folder = 'uploaded_img/' . $update_p_image;

   $update_query = mysqli_query($conn, "UPDATE `product` SET product_name = '$update_p_name', product_price = '$update_p_price', image = '$update_p_image' WHERE id = '$update_p_id'");

   if ($update_query) {
      move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
      $message[] = 'product updated succesfully';
      header('location:private.php');
   } else {
      $message[] = 'product could not be updated';
      header('location:private.php');
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
   <title>Home Page Admin</title>
</head>

<body>




   <?php
   if (isset($message)) {
      foreach ($message as $message) {
         echo '<div class="message"><span>' . $message . '</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
      };
   };


   ?>



   <!--navbar-->


   <nav class="navbar navbar-expand bg-info navbar-dark py-3 ">
      <div class="container">
         <a href="private.php" class="navbar-brand text-dark">Softex Sweater Industries (Pvt.) Ltd.</a>
         <ul class="navbar-nav  ms-auto">

            <li class="nav-item">
               <a href="private.php" class="nav-link text-dark">Add Product</a>
            </li>
            <li class="nav-item">
               <a href="private1.php" class="nav-link text-dark">Contact Table</a>
            </li>
            <li class="nav-item">
               <a href="admin.php?logout=<?php echo $admin; ?>" onclick="return confirm('are your sure you want to logout?');" class="nav-link text-dark">Log Out</a>
            </li>
         </ul>
      </div>

   </nav>
   <!--Card middle body-->
   <div class="container mt-5">
      <h3 class=" p-3 mb-5  text-center ">CONTROL PANEL</h3>




      <form class="mt-5" action="" method="post" enctype="multipart/form-data">
         <h3>ADD NEW PRODUCT</h3>
         <div class="form-group">
            <input type="text" name="product_name" class="form-control mt-2" placeholder="Enter Product Name" required>
            <input type="number" name="product_price" class="form-control mt-2" placeholder="Enter Product price" required>
            <input type="file" name="product_image" accept="image/png, image/jpg, image/jpeg" class="form-control mt-2" required>
            <button type="submit" value="add the product" name="add_product" class="btn btn-outline-dark mt-2">Add Product</button>
         </div>
      </form>
      <div class="mt-5">
         <table class="table">
            <thead class="thead-dark">
               <tr>
                  <th scope="col">product Image</th>
                  <th scope="col">Product Name</th>
                  <th scope="col">Product Price</th>
                  <th scope="col">Action</th>
               </tr>
            </thead>
            <tbody>
               <?php
               $select_products = mysqli_query($conn, "SELECT * FROM product");
               if (mysqli_num_rows($select_products) > 0) {
                  while ($row = mysqli_fetch_assoc($select_products)) {


               ?>
                     <tr>
                        <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
                        <td><?php echo $row['product_name']; ?></td>
                        <td>$<?php echo $row['product_price']; ?></td>
                        <td><a href="private.php?delete=<?php echo $row['id']; ?>">
                              <button onclick="return confirm('are your sure you want to delete this?');" type="button" class="btn btn-danger">Delete</button><br></a>
                           <a href="private.php?edit=<?php echo $row['id']; ?>">
                              <button data-bs-toggle="modal" data-bs-target="#exampleModalCenter" type="button" class="btn btn-success mt-1">Update</button></a>

                        </td>
                     </tr>
               <?php
                  };
               } else {
                  echo "<div>No product</div>";
               }
               ?>
            </tbody>
         </table>
      </div>
      <div class="mt-5 mb-5">
         <h3>Update Product Infomation</h3>
         <?php

         if (isset($_GET['edit'])) {
            $edit_id = $_GET['edit'];
            $edit_query = mysqli_query($conn, "SELECT * FROM product WHERE id ='$edit_id'");
            if (mysqli_num_rows($edit_query) > 0) {
               while ($fetch_edit = mysqli_fetch_assoc($edit_query)) {
         ?>
                  <form action="" method="post" enctype="multipart/form-data">
                     <img src="uploaded_img/<?php echo $fetch_edit['image']; ?>" height="200" alt="">
                     <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['id']; ?>">
                     <input type="text" class="box" required name="update_p_name" value="<?php echo $fetch_edit['product_name']; ?>">
                     <input type="number" min="0" class="box" required name="update_p_price" value="<?php echo $fetch_edit['product_price']; ?>">
                     <input type="file" class="box" required name="update_p_image" accept="image/png, image/jpg, image/jpeg">
                     <button type="submit" value="update the prodcut" name="update_product" class="btn btn-secondary">Update</button>
                     <button type="reset" value="cancel" id="close-edit" class="btn btn-dark">Cancel</button>
                  </form>



         <?php
               }
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