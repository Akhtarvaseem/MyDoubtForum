<?php 
session_start();
echo "please wait for loguut...";
session_destroy();

header("Location: /forum/index.php");

?>