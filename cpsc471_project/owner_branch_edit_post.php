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
    

    $Branch_no = $_REQUEST["Branch_no"];
    $Branch_name = $_REQUEST["Branch_name"];
    $Street_no = $_REQUEST["Street_no"];
    $Street_name = $_REQUEST["Street_name"];
    $City = $_REQUEST["City"];
    $Province = $_REQUEST["Province"];
    $Postal_code = $_REQUEST["Postal_code"];

    echo "Branch Number: " . $_SESSION["Branch_no"] . "<br>";
    echo "Branch name: " .$Branch_name . "<br>";
    echo "Address: " . $Street_no . " " . $Street_name . " " . $City . " " . $Province . " " . $Postal_code . "<br>";


    $stmt = $con->prepare("UPDATE branch SET Branch_name= ?, Street_no = ?, Street_name = ?, City = ?, Province = ?, Postal_code = ?
    WHERE Branch_no = ?");
    $stmt->bind_param("sssssss", $Branch_name, $Street_no, $Street_name, $City, $Province, $Postal_code, $_SESSION["Branch_no"]);
    $stmt->execute();
    echo "Branch edited successfully";

    $stmt->close();

        
    header("Location: owner_branch_view.php");
        $con->close();
?>


    </body>
    </html>