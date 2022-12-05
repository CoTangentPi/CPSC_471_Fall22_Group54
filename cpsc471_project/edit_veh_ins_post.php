<?php
//start session
session_start();
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

    $insID = $_REQUEST["InsuranceID"];
    echo "Insurance ID: " . $insID . "<br>";
    echo "VIN: " . $_SESSION["VIN"] . "<br>";

    $stmt = $con->prepare("UPDATE vehicle SET InsuranceID = ?
    WHERE VIN = ?");
    $stmt->bind_param("ss", $insID, $_SESSION["VIN"]);
    $stmt->execute();
    echo "insurance edited successfully";
    $stmt->close();

    header("Location: emp_veh_search.php");
    $con->close();

   
?>


    </body>
    </html>