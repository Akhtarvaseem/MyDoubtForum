<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "_dbConnect.php";
    $u_email = $_POST['u_email'];
    $u_pass = $_POST['u_pass'];

    $sql = "SELECT * from users where email='$u_email' ";
    $result = mysqli_query($conn, $sql);
    $numRow = mysqli_num_rows($result);
    if ($numRow == 1) {

        $row = mysqli_fetch_assoc($result);
        if(password_verify($u_pass, $row["password"])){

            session_start();
            $_SESSION['loggedin']=true;
            $_SESSION['userEmail']=$u_email;
            $_SESSION['user_name']=$row['user_name'];
            $_SESSION['sno']=$row['sno'];

            
        }
        header("Location: /forum/index.php");
    }
    header("Location: /forum/index.php");

}

?>