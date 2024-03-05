<?php

$showError = "false";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    
   include "_dbConnect.php";
    $user_name=$_POST['uname'];
    $user_email = $_POST['uemail'];
    $user_pass = $_POST['password'];
    $user_cpass = $_POST['cpassword'];

    

    // // check user already exits or not 

    $exitsql = "SELECT * FROM `users` WHERE email='$user_email' ";
    $result = mysqli_query($conn, $exitsql);

    if (mysqli_num_rows($result) > 0) {
        $showError = ' User already exits .';
        
    }
     else {

            if($user_pass==$user_cpass){

                $hash = password_hash($user_pass, PASSWORD_DEFAULT);
    
                $sql = "INSERT INTO `users` ( `user_name`,`email`, `password`, `timestamp`) VALUES ('$user_name','$user_email', '$hash', current_timestamp())";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $showAlert=true;
                    header("Location: /forum/index.php?signupsuccess=true");
                    exit;
                }
            }else{
                $showError = 'Password does not match.';
                
            }

            
    }

    header("Location: /forum/index.php?signupsuccess=false&error=$showError");
}


?>