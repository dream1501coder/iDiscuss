

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 
</head>
<body>
<?php
  session_start();
// if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  include 'partials/_loginModal.php';
  include 'partials/_signupModal.php';
    echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">iDiscuss</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link" href="#">About Us</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact Us</a>
                </li>

            </ul>';
            
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true) {
                echo '<form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-success" type="submit">Search</button>
                <p class="text-light my-1 mx-2">Welcome.'. $_SESSION['user']. ' </p>
                <a href="partials/_logout.php" class="btn btn-outline-success ml-2"><i class="fa fa-power-off"></i></a>
            
            </form>';
            }
           else{
            echo '<form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-success" type="submit">Search</button>
              
            </form>
            <div class="d-flex mx-2 ">
                <button class="btn btn-outline-success me-2" type="submit"  data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                <button class="btn btn-outline-success me-2" type="submit" data-bs-toggle="modal" data-bs-target="#signupModal">SignUp</button>
            </div>';
           }
        echo'</div>
    </div>
</nav>';

// if(!isset($_SESSION['loggedin'])) {
//     echo'<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
//                <strong>Ooops </strong>Wrong Password
//                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
//                  </div>';
// }
if (isset($_GET['signup']) && $_GET['signup']=="true") {
    echo'<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
                <strong>Success</strong> You can Login now.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
}
// if (!isset($_GET['signup']) ) {
//     echo'<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
//                 <strong>Ooops </strong>'.$_GET['error'].'
//                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
//               </div>';
// }



?> 
</body>
</html>