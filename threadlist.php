<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>C-Discuss!</title>
</head>

<body>

    <?php
    include("component/_dbConnect.php");
    include("component/_header.php");
    ?>

    <?php
    $cat_id = $_GET['id'];

    $sql = "SELECT * FROM `category` where category_id = $cat_id ";

    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {

        $cat_name = $row['category_name'];
        $cat_desc = $row['category_discription'];


    }
    ?>

    <!-- Its use for insert  user query in data base. -->
    <?php
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
        $th_title = $_POST['title'];
        $th_user_id=$_POST['sno'];
        $th_desc = $_POST['desc'];
        $th_desc=str_replace('>','&gt', $th_desc);
        $th_desc=str_replace('<','&lt', $th_desc);
       

        $sql = "INSERT INTO `thread` ( `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ( ' $th_title', ' $th_desc', '$cat_id', '$th_user_id', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if ($showAlert) {

            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success! </strong> You are successfully add your thread. Please wait for response.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        }

    }


    ?>

    <!-- thread start here  -->
    <div class="container my-3">


        <div class="p-5 mb-4 bg-info rounded-3">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold">Welcome to
                    <?php echo $cat_name ?> forum.
                </h1>
                <p class="col-md-8 fs-4">
                    <?php echo $cat_desc ?>
                </p>
                <hr>
                <p>Be civil. Don't post anything that a reasonable person would consider offensive, abusive, or hate
                    speech.
                    Keep it clean. Don't post anything obscene or sexually explicit.
                    Respect each other. Don't harass or grief anyone, impersonate people, or expose their private
                    information.
                    Respect our forum.</p>
                <button class="btn btn-primary btn-lg" type="button">Explore More</button>
            </div>
        </div>

    </div>

    <!-- thread end here -->







    <!-- Strat ask qustion here  -->

    <?php
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {

        echo '
 <div class="container">
 <h1 class="py-2">Start ask your Question</h1>

 <form action=" ' . $_SERVER['REQUEST_URI'] .' " method="post">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Problem Title</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name ="title">
    <div id="emailHelp" class="form-text">keep your title as short as crap as posible</div>
  </div>

  <div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Elaborate Your Problem</label>
  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="desc"></textarea>
</div>

   <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
 
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

 </div>
 ';
    }else{
        echo '<div class="container">
        <h1 class="py-2">Start ask your Question</h1>
        <p class="col-md-8 fs-4">Please login first to start the Discusstion.</p>
        </div>
        ';
    }
    ?>


    <!-- end ask qustion here  -->








    <!-- List thread that means discuss -->

    <div class="container">
        <h1 class="py-2">Your browse thread Question</h1>

        <?php
        //$cat_id = $_GET['id'];
        
        $sql = "SELECT * FROM `thread` where thread_cat_id = $cat_id ORDER BY thread_id DESC";

        $result = mysqli_query($conn, $sql);
        $no_result = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $no_result = false;
            $thread_id = $row['thread_id'];
            $thread_name = $row['thread_title'];
            $thread_desc = $row['thread_desc'];
            $thread_time = $row['timestamp'];
            $thread_user_id=$row['thread_user_id'];
            
            $sql2 = " SELECT user_name FROM `users` WHERE sno='$thread_user_id' ";
            $result2 = mysqli_query($conn, $sql2);
            $row = mysqli_fetch_assoc($result2);
            $userName=$row['user_name'];


            echo '<div class="media d-flex  flex-row py-2">
            <img src="image/userdefalt.png" width="60px" height="50px" class="mr-3 mx-3" alt="...">
            <div class="media-body">
            <p class="fs-6 my-0"><b> '.$userName.'  at  </b>' . $thread_time . '</p>
                <h5 class="mt-0"> <a href="thread.php?threadid=' . $thread_id . '"> ' . $thread_name . '</a></h5>
                <p>' . $thread_desc . '</p>
            </div>
        </div>';
        }


        if ($no_result) {

            echo '<div class="jumbotron jumbotron-fluid bg-info text-center">
            <div class="container">
              <p class="display-5">No Thread Found </p>
              <p class="lead">Be the first persion ask the question.</p>
            </div>
          </div>';
        }

        ?>

    </div>





    <?php
    include("component/_footer.php");
    ?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>