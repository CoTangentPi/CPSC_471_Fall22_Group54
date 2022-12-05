<?php
//session variables adapted from 
//https://stackoverflow.com/questions/25316186/how-do-i-share-a-php-variable-between-multiple-pages

//start session
session_start();

//set session variables
$_SESSION["Invalid"] = false; //if user input is invalid
?>
<html>
    <body>
        <?php
    $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else {
        echo "Connection successful\n";
    }

   

    header("Location: login.php");
    $con->close();

   
?>


    </body>
    </html>