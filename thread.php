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
    $thread_id = $_GET['threadid'];

    $sql = "SELECT * FROM `thread` where thread_id = $thread_id ";

    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {

        $thread_name = $row['thread_title'];
        $thread_desc = $row['thread_desc'];
        $thread_user_id=$row['thread_user_id'];

            $sql3 = " SELECT user_name FROM `users` WHERE sno='$thread_user_id'";
            $result3 = mysqli_query($conn, $sql3);
            $row = mysqli_fetch_assoc($result3);
            $postedBy=$row['user_name'];


    }
    ?>


    <!-- Its use for insert  user query in data base. -->
    <?php
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {

        $commentBy = $_POST['sno'];
        $comment_content = $_POST['comment'];
        $comment_content=str_replace('<','&lt', $comment_content);
        $comment_content=str_replace('>','&gt', $comment_content);

        

        $sql = "INSERT INTO `comment` ( `comment_content`, `thread_id`, `commentBy`, `comment_time`) VALUES ( '$comment_content', '$thread_id', '$commentBy', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if ($showAlert) {

            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success! </strong> You are successfully add your comment.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        }

    }


    ?>



    <!-- thread start here  -->
    <div class="container my-3">


        <div class="p-5 mb-4 bg-info rounded-3">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold">
                    <?php echo $thread_name ?>
                </h1>
                <p class="col-md-8 fs-4">
                    <?php echo $thread_desc ?>
                </p>
                <hr>
                <p>Be civil. Don't post anything that a reasonable person would consider offensive, abusive, or hate
                    speech.
                    Keep it clean. Don't post anything obscene or sexually explicit.
                    Respect each other. Don't harass or grief anyone, impersonate people, or expose their private
                    information.
                    Respect our forum.</p>
                <p>Posted by: <em>- <?php  echo $postedBy;?></em></p>
            </div>
        </div>

    </div>

    <!-- thread end here -->


    <!-- Strat posting a comment here  -->

    <?php
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {


        echo '
    <div class="container">
        <h1 class="py-2">Post a Comment</h1>

        <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">


            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Type your comment here </label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="comment"></textarea>
            </div>
            <input type="hidden" name="sno" value="' . $_SESSION["sno"] . '">

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>';

    } else {
        echo '<div class="container">
    <h1 class="py-2">Post a Comment</h1>
    <p class="col-md-8 fs-4">You want to post a comment .Please ! login first.</p>
    </div>
    ';
    }
    ?>
    <!-- end ask qustion here  -->



    <!-- List thread that means discuss -->

    <div class="container">
        <h1 class="py-2">Discussions Box </h1>

        <?php
        $th_id = $_GET['threadid'];

        $no_result = true;
        $sql = "SELECT * FROM `comment` where thread_id = $th_id  ORDER BY comment_id DESC";

        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $no_result = false;
            $comment_id = $row['comment_id'];
            $comment_content = $row['comment_content'];
            $comment_time = $row['comment_time'];
            $commentBy = $row['commentBy'];

         
            $sql2 = " SELECT user_name FROM `users` WHERE sno='$commentBy'";
            $result2 = mysqli_query($conn, $sql2);
            $row = mysqli_fetch_assoc($result2);
            $userName=$row['user_name'];



            echo '<div class="media d-flex  flex-row py-2">
            <img src="image/userdefalt.png" width="60px" height="50px" class="mr-3 mx-3" alt="...">
            <div class="media-body">
                 <p class="fs-5 my-0"><b> '.$userName.'  at  </b>' . $comment_time . '</p>
                <p>' . $comment_content . '</p>
            </div>
        </div>';
        }

        if ($no_result) {

            echo '<div class="jumbotron jumbotron-fluid bg-info text-center">
            <div class="container">
              <p class="display-6">No Comment Found </p>
              <p class="lead">Be the first persion to give  an answer to  the question.</p>
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