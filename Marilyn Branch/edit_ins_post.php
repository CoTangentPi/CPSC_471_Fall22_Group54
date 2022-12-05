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

    $ins_type = $_REQUEST["Ins_type"];
    $cost = $_REQUEST["Cost"];

    echo "insurance id: " . $_SESSION["InsuranceID"] . "<br>";

    echo "Insurance type: " . $ins_type . "<br>";
    echo "Cost: " . $cost . "<br>";

    $stmt = $con->prepare("UPDATE insurance SET Ins_Type = ?, Cost = ?
    WHERE InsuranceID = ?");
    $stmt->bind_param("sss", $ins_type, $cost, $_SESSION["InsuranceID"]);
    $stmt->execute();
    echo "insurance edited successfully";

    $stmt->close();
    
    header("Location: emp_ins.php");
        $con->close();
?>


    </body>
    </html>