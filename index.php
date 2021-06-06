<?php include "partials/_dbconnect.php";


?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <style>
    .body {
        min-height: 500px;
    }

    a {
        text-decoration: none;

    }
    </style>
    <title>iDiscuss | Coding Forum</title>
</head>

<body>



    <?php include "partials/_header.php" ?>

    <!-- <div class="container-fluid"> -->

        <div id="carouselExampleCaptions" class="carousel slide"  data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/s1.jpg" height="450" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>First slide label</h5>
                        <p>Some representative placeholder content for the first slide.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images/s2.jpg" height="450" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Second slide label</h5>
                        <p>Some representative placeholder content for the second slide.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images/s3.jpg" height="450" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Third slide label</h5>
                        <p>Some representative placeholder content for the third slide.</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    <!-- </div> -->

    <div class="container">
        <div class="container my-3 text-center">
            <h2>iDiscuss - Explore Forums</h1>
        </div>
        <div class="row my-2">
            <?php   
if($conn){
    $sql="SELECT * FROM `category`";
    $result=mysqli_query($conn,$sql);
    $i=1;
    while($rows=mysqli_fetch_assoc($result)){
 
      $catid=$rows['category_id'];
      $catdesc=$rows['category_desc'];

      $cate_des=substr($catdesc,0,45);

      echo '<div class="col-md-4 my-2">
      <div class="card" style="width: 18rem;">
      <img src="images/'.$i.'.jpg" class="card-img-top" alt="...">
      <div class="card-body">
        <a href="threadslist.php?cat_id='.$catid.'"><h5 class="card-title">'.$rows['category_name'].'</h5></a>
        <p class="card-text">'. $cate_des.'...<a href="threadslist.php?cat_id='.$catid.'">read more</a></p>
        <a href="threadslist.php?cat_id='.$catid.'" class="btn btn-success">Go To Forum</a>
      </div>
    </div>
    </div>'
    ;
    $i++;

    }
  }
?>





        </div>
    </div>


    </div>
    <?php include "partials/_footer.php" ?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
</body>

</html>