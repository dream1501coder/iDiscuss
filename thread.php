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
        min-height: 900px;
    }

    a {
        text-decoration: none;

    }
    </style>
</head>


<body>
    <?php include "partials/_header.php" ?>

    <?php

$threadid=$_GET['thread_id'];
// $url=$_POST['url'];


//     echo'<nav aria-label="breadcrumb">
// <ol class="breadcrumb mt-2 pl-4">
//   <li class="breadcrumb-item"><a href="index.php">Home</a></li>
//   <li class="breadcrumb-item"><a href="threadslist.php?cat_id='.$url.'">Question</a></li>
//   <li class="breadcrumb-item active" aria-current="page">Answers</li>
// </ol>
// </nav>';
        if ($conn) {

           
            if($_SERVER['REQUEST_METHOD']=="POST"){

                $comment=$_POST['comment'];
                $comment=str_replace("<","&lt",$comment);
                $comment=str_replace(">","&gt",$comment);
                $user=$_POST['user'];

           
            $isql="INSERT INTO `comments` (`comment_desc`, `comment_by`, `thread_id`, `comment_time`) VALUES ('$comment', ' $user', '$threadid', current_timestamp())";
            $res=mysqli_query($conn,$isql);
        
            if($res){
                echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Thank You </strong> Your Comment has been added Successfully.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            }
        
            // echo var_dump($res);
        }
      

    $threadList=false;

    $sql="SELECT * FROM `threads` WHERE thread_id='$threadid';";
    $result=mysqli_query($conn,$sql);
    while($rows=mysqli_fetch_assoc($result)){
       $threadList=true;

        echo'<div class="container body">';
        $thread_title=$rows['thread_title'];    
        $thread_desc=$rows['thread_desc'];    
        $thread_id=$rows['thread_id']; 
        $user_id=$rows['user_id'];

        $sql_user="SELECT username FROM `users` WHERE user_id='$user_id'";
        $result_user=mysqli_query($conn,$sql_user);
        $row_user= mysqli_fetch_assoc($result_user);
           
           

    echo '<div class="container">
        <div class="row align-items-md-stretch mt-4 mb-3">

            <div class="col-md-12">
                <div class="h-100 p-3 pl-2 bg-light border rounded-3">
                    <h2> ' . $thread_title.' </h2>
                    <p>'.$thread_desc.'</p>
                    <p>Posted By : <em><b>'.$row_user['username'] .'</b></em></p>
                    
                   
                </div>
            </div>
        </div>
    </div>';
            }
}   

 



echo '<div class="container">
<form action="thread.php?thread_id='.$threadid.'" method="post">';
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    echo'<div class="mb-2">
    <textarea rows="2" placeholder="Type Your Solution here..." type="text" class="form-control" id="comment" name="comment" required></textarea>
    <input type="hidden" name="user" value="'.$_SESSION["id"].'">
</div>
<button type="submit" class="btn btn-success">Submit Comment</button>
</form>
</div>';
}
else{
echo'<div class="mb-2">
<input placeholder="If you want to comment than please login." disabled type="text" class="form-control" id="comment" name="comment">
</div>
<button type="submit" class="btn btn-success" disabled>Submit Comment</button>
</form>
</div>';
}




?>
<div class="container my-3"><h2>Answers</h2>
<?php
   
   

$comment=false;

    $sql="SELECT * FROM `comments` WHERE thread_id='$threadid';";
    $result=mysqli_query($conn,$sql);
    while($rows=mysqli_fetch_assoc($result)){
       $comment=true;

        // echo'';
        $comment_by=$rows['comment_by'];    
        $comment_desc=$rows['comment_desc'];    
        $comment_time=$rows['comment_time'];    

        // $comment_user_id=$rows['commented_by'];

             $sql_comment="SELECT username FROM `users` WHERE user_id='$comment_by'";
             $result_comment_user=mysqli_query($conn,$sql_comment);
             $row_comment_user= mysqli_fetch_assoc($result_comment_user);
   
echo '
  
   <ul class="list-unstyled">
       <li class="media d-flex">
           <img src="images/user.png" height="40" class="my-2" alt="...">
           <div class="media-body mx-2">
               <p class="mt-0 mb-1">'.$row_comment_user['username'] .'<small class="px-5 f-right">'.$comment_time.'</small></p>
               <p>'.$comment_desc.'</p>
           </div>
       </li>
       
      
   </ul>
';

}
if (!$comment) {


    echo '<div class="container"><div class="alert alert-warning text-center m-auto my-3" role="alert">
    <h4 class="alert-heading">No answers Found for the "'.$thread_title.'"</h4></div>';
}
?>
</div>
   
    </div>
    </div>

<?php
// if ($threadid="") {
//     echo "<h1>No Results Found</h1>";
// }
?>
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