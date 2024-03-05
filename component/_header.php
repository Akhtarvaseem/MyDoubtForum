<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">iDiscuss</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="aboutUs.php">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Category
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
      
                   <?php 
                     $sql="SELECT category_name , category_id from category LIMIT 2";
                     $result=mysqli_query($conn,$sql);
               
                    while($row = mysqli_fetch_assoc($result)){

                        $cat_name=$row['category_name'];
                        $cat_id=$row['category_id'];
                       echo '
                        <li><a class="dropdown-item" href="threadlist.php?id='.$cat_id.'">'.$cat_name.'</a></li>
                        ';
                    }
                    ?>

                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="contact.php">ContactUs</a>
                </li>

            </ul>

            <?php
            session_start();
            if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {

                echo '  <form class="d-flex mx-2" method="GET" action="search.php">
                       <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
                        <button class="btn btn-success" type="submit">Search</button>
                        </form>
                    
                    <p class="text-light my-0"> welcome ' . $_SESSION["user_name"] . ' </p>

               
                 
                        <a class="btn btn-outline-success " type="submit" href="component/_handleLogout.php">Logout</a>';

            } else {
                echo '<form class="d-flex mx-2">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-success" type="submit">Search</button>
            </form>

            <button class="btn btn-outline-success " type="submit" data-bs-toggle="modal"
                data-bs-target="#loginModal">Login</button>
            <button class="btn btn-outline-success mx-2" type="submit" data-bs-toggle="modal"
                data-bs-target="#signupModal">Register</button>';
            }


            ?>






        </div>
    </div>
</nav>



<?php include "component/_login_modal.php"; ?>
<?php include "component/_signup_modal.php"; ?>


<!-- Its use for genrate an alert box  -->
<?php if (isset($_GET["signupsuccess"]) && $_GET["signupsuccess"] == "true") {
    echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
<strong>Success!</strong> Now you can Login.
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
} else if (isset($_GET["signupsuccess"]) && $_GET["signupsuccess"] == "false") {
    $error = $_GET["error"];
    echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
<strong>Error!</strong> ' . $error . '.
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}



?>