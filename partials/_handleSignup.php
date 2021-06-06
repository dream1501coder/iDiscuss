

<?php


$success=false;
$method=$_SERVER["REQUEST_METHOD"];
if ($method=="POST") {
    
include '_dbconnect.php';
    $username=$_POST['username'];
    $pass=$_POST['pass'];
    $cpass=$_POST['cpass'];

    $sql="SELECT * FROM `users` WHERE username='$username'";
    $result=mysqli_query($conn,$sql);
    $rows=mysqli_num_rows($result);

        if ($rows>0) {
          
            $errorMsg="Username Already exists plz choose another.";
        }
        else{
            if ($pass==$cpass) {
                $hash=password_hash($pass,PASSWORD_DEFAULT);
                $insql="INSERT INTO `users` ( `username`, `password`, `created_at`) VALUES ('$username', '$hash', current_timestamp());";
                $resultin=mysqli_query($conn,$insql); 

                if ($result) {
                    $success=true;
                    header('location:/iDiscuss/index.php?signup=true');
                    exit();
                   
                }

            }
            else{
               
                $errorMsg="Password and Confirm Password didn't match.";
            }
        } header("location:/iDiscuss/index.php?signup=false&error=$errorMsg");
}


?>