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

    <!-- Crausel end here -->



    <div class="container">

        <h1 class="text-center my-3">Search result for -"<em>
                <?php echo $_GET['query']; ?>
            </em>" </h1>


        <?php
        $serchResult = false;
        $query = $_GET['query'];

        $sql = "SELECT * FROM thread WHERE MATCH(thread_title,thread_desc) AGAINST('.$query,') ";

        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $serchResult = true;
            $thread_name = $row['thread_title'];
            $thread_desc = $row['thread_desc'];
            $thread_id = $row['thread_id'];

            echo '
                       <div class="result">
               
                           <h3 class="my-3"><a href="threadlist.php?id=' . $thread_id . '" class="text-dark text-decoration-none">
                           <ul>
                           <li>'.$thread_name.'</li>
                           </ul></a> </h3>
                           <p>' . $thread_desc . '</p>
                       </div>';
        }


        if ($serchResult == false) {
            echo '
            <div class="container jumbotron jumbotron-fluid bg-info ">
              <p class="display-5">No Search Result Found </p>
              <p class="lead">Suggestions:</p>
              <ul ><li>Make sure that all words are spelled correctly</li>
              <li>Try different keywords.</li>
              <li>Try more general keywords.</li>
              <li>Try fewer keywords.</li>
              </ul>
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