<?php include "partials/_dbconnect.php";
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>iDiscuss | Coding Forum</title>
    <style>
    .body {
        min-height: 500px;
    }

    a {
        text-decoration: none;

    }
    </style>
</head>


<body>

    <?php include "partials/_header.php" 
    
   
    ?>

    <?php
if ($conn) {

    $catid=$_GET['cat_id'];
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $t_title=$_POST['tname'];
        $t_title=str_replace("<","&lt",$t_title);
        $t_title=str_replace(">","&gt",$t_title);

        $t_desc=$_POST['tdesc'];
        $t_desc=str_replace("<","&lt",$t_desc);
        $t_desc=str_replace(">","&gt",$t_desc);
        $t_desc=str_replace(":","<br />",$t_desc);

        $t_user=$_POST['user'];
     

    //    $user_id= $_SESSION['id'];
    //    echo $user_id;
   
    $isql="INSERT INTO `threads` ( `thread_title`, `thread_desc`, `cat_id`, `user_id`, `created_at`) VALUES ('$t_title', '$t_desc', '$catid', '$t_user', current_timestamp());";
    $res=mysqli_query($conn,$isql);

    if($res){
        echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success </strong> Your Question has been Posted and you should wait while community will answer.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }

    // echo var_dump($res);
}
}
?>
    <?php
        if($conn){
            $sql="SELECT * FROM `category` WHERE category_id='$catid';";
            $result=mysqli_query($conn,$sql);
  
            while($rows=mysqli_fetch_assoc($result)){

                $catname1=$rows['category_name'];    
           

    echo '<div class="container">
            <div class="row align-items-md-stretch my-4">
            <div class="col-md-12">
            <div class="h-100 p-5 bg-light border rounded-3">
            <h2> Welcome to ' . $catname1.' Forum. </h2>
            <h5>'.$rows['category_desc'].'</h5><hr>
            <p>Do not post copyright-infringing material.
            Do not post “offensive” posts, links or images.
            Do not PM users asking for help.
            Remain respectful of other members at all times.</p>
            <p>';

                if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true) {
                echo'
                <a class="btn btn-outline-success" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                Ask Question
                </a></p>
                <div class="collapse" id="collapseExample">
                <div class="card card-body">
                <form action="threadslist.php?cat_id='.$catid.'" method="post">
                <input type="hidden" name="user" value="'.$_SESSION["id"].'">
                    <div class="mb-3">
                        <label for="tname" class="form-label">Problem</label>
                        <input type="text" class="form-control" id="tname" name="tname" aria-describedby="emailHelp" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="tdesc" class="form-label">Ellaborate Your Problem</label>
                        <textarea rows="3" type="text" class="form-control" id="tdesc" name="tdesc"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                    <button type="reset" class="btn btn-success" value="reset">Reset</button>
                </form>
                </div>
                </div>';
            }
            else{
                echo'
                <a class="btn btn-outline-success" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                Ask Question
                </a>
                
                    </p>
                <div class="collapse" id="collapseExample">
                <div class="card card-body">
               <b>Login required to Start discussion</b>
                </div>
                </div>';
                }
                echo'</div>
            </div>
        </div>
    </div>';
            }
?>

   
    <div class="container body">
    <h3 class=" my-3">Explore Questions</h3>

<?php
     $threadList=false;

         $sql="SELECT * FROM `threads` WHERE cat_id='$catid';";
         $result=mysqli_query($conn,$sql);
         while($rows=mysqli_fetch_assoc($result)){
            $threadList=true;

             echo'<div class="container">';
             $thread_title=$rows['thread_title'];    
             $thread_id=$rows['thread_id']; 
             $user_id=$rows['user_id'];

             
             $sql_user="SELECT username FROM `users` WHERE user_id='$user_id'";
             $result_user=mysqli_query($conn,$sql_user);
             $row_user= mysqli_fetch_assoc($result_user);
             //   var_dump($result);
             $url = $_SERVER['REQUEST_URI'];
            //   echo $url;

    echo '<ul class="list-unstyled">
            <li class="media d-flex">
                <img src="images/user.png" height="50" class="my-2" alt="...">
                <div class="media-body mx-2">
                <form method="post" action="thread.php?thread_id='.$thread_id.'">
                    <h5 class="mt-0 mb-1"><a href="thread.php?thread_id='.$thread_id.'">'.$thread_title.'</a></h5>
                    <input type="hidden" name="url" value="'.$url.'">
                    <form>
                    <div id="emailHelp" class="form-text text-right"><b>'.$row_user['username'] .'</b> at '.$rows['created_at'].'</div>
                    <p>'.$rows['thread_desc'] .'</p>
                   
                </div>
                </li>
            </ul>
    </div>';

}

if (!$threadList) {
    echo '<div class="alert alert-warning col-md-10 text-center m-auto" role="alert">
    <h4 class="alert-heading">No Threads Found</h4>
    <p class="mb-0">Ask a Question and start discussion on '.$catname1.' Forum</p>
  </div>';

  echo ' <div class="container my-2 col-md-10"><h3 class=" my-3 m-auto">Ask Question</h3><form action="threadslist.php?cat_id='.$catid.'" method="post">
  <div class="mb-3">
      <label for="tname" class="form-label">Question</label>
      <input type="text" class="form-control" id="tname" name="tname" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
      <label for="tdesc" class="form-label">Description</label>
      <textarea rows="8" type="text" class="form-control" id="tdesc" name="tdesc"></textarea>
  </div>
  <button type="submit" class="btn btn-success">Submit</button>
  <button type="button" class="btn btn-success clear" value="clear">Reset</button>
</form></div>';
}
}

    ?>
  
    </div>
    </div>


    <?php include "partials/_footer.php" ?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
</body>

</html>