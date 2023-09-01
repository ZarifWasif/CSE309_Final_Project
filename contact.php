<?php

@include 'config.php';

if (isset($_POST['submit'])) {
  if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email']) && !empty($_POST['message']) && !empty($_POST['Address']) && !empty($_POST['city'])) {

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $address = $_POST['Address'];
    $city = $_POST['city'];

    $query = "INSERT INTO contact (firstname, lastname, email, message, Addresss, city) VALUES ('$firstname', '$lastname', '$email', '$message', '$address', '$city');";
    $run = mysqli_query($conn, $query) or die(mysql_error());
    $target = "contactform.php";
    $linkname = "mylink";
  } else {
    echo "all field required";
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
  <section class="p-5">
    <div class="container">
      <div class="row text-center g-4 ">
        <div class="col-md">
          <div class="card bg-info mt-5 text-dark ">
            <div class="card-body text-center text-light">
              <div class="h1 mb-3">
                <i class="fa-address-book"></i>
              </div>
              <h3 class="card-title mb-3 text-dark">Contact Us</h3>
              <form class="container" action="contact.php" method="post">
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
                <div class="form-group mb-3">
                  <textarea name="message" class="form-control" id="exampleFormControlTextarea1" placeholder="Type your message here" rows="3"></textarea>
                </div>
                <div class="form-group mb-3">
                  <input name="Address" type="text" class="form-control" id="inputAddress2" placeholder="Type Your Address, Country, State, District">
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6 mb-3">
                    <input name="city" type="text" placeholder="Your city's name" class="form-control" id="inputCity">
                  </div>
                </div>
                <button type="submit" name="submit" class="btn btn-outline-dark">Send Message</button>

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