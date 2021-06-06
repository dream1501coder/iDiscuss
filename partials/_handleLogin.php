

<?php


$success=false;
$method=$_SERVER["REQUEST_METHOD"];
if ($method=="POST") {
    
include '_dbconnect.php';
    $username=$_POST['username'];
    $pass=$_POST['pass'];
    
    // $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    $sql="SELECT * FROM `users` WHERE username='$username'";
    $result=mysqli_query($conn,$sql);
    
    $numrows=mysqli_num_rows($result);
    if ($numrows==1) {
        
        $rows=mysqli_fetch_assoc($result);

        // $match=password_verify($pass,$rows['password']);

        // echo $match;

        if(password_verify($pass,$rows['password'])){
            session_start();
            $_SESSION['loggedin']=true;
            $_SESSION['id']=$rows['user_id'];
            $_SESSION['user']=$username; 
            // echo "logged in". $username;
        }
        header("location:/iDiscuss/index.php");

            
     }
     header("location:/iDiscuss/index.php");
}
 
?>