<?php 
include("component/_dbConnect.php");
$method=$_SERVER['REQUEST_METHOD'];
$showError="false";
if($method=="POST"){
    include "_dbConnect.php";

    $name=$_POST['name'];
    $email=$_POST['email'];
    $subject=$_POST['subject'];
    $msg=$_POST['message'];

   $sql="INSERT INTO `contactus` ( `contact_name`, `contact_email`, `subject`, `contact_desc`, `time_stamp`)
    VALUES ( '$name', '$email', '$subject', '$msg', current_timestamp());";

   $result=mysqli_query($conn,$sql);

        if ($result) {
            $showAlert=true;
            header("Location: /forum/contact.php?contactSuccess=true");
            exit;

        }
        else{
        $showError = 'Something went wrong';

        }
}

?>