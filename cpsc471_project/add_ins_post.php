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
        echo "Connection successful<br>";
    }

    $InsID = $_REQUEST["InsuranceID"];
    $InsType = $_REQUEST["Ins_type"];
    $Cost = $_REQUEST["Cost"];

    $sqlcheck = "SELECT * FROM insurance";
    $resultcheck = $con->query($sqlcheck);

    $count = mysqli_num_rows($resultcheck);

    if($resultcheck->num_rows > 0) {
        while($row = $resultcheck->fetch_assoc()) {
        //check if input policy number already exists
        if ($row["InsuranceID"] == $InsID) {
            echo "Insurance ID already exists <br>";
            $_SESSION["SamePolicy"] = true;
            $_SESSION["TakenPolicy"] = $InsID;
            header("Location: add_ins.php");
        } else {
            echo "Insurance ID does not exist <br>";
        }
        }
    }

    if(!$_SESSION["SamePolicy"]) {
        echo "insurance can be added";

         //use prepared statements to sanitize user input
         $stmt = $con->prepare("INSERT INTO insurance
         VALUES (?, ?, ?);");
         $stmt->bind_param("sss", $InsID, $InsType, $Cost);
         
         $stmt->execute();
         echo "insurance added<br>";
         $stmt->close();
         //go back to view insurance page
         header("Location: emp_ins.php");
    } 

        $con->close();
?>


    </body>
    </html>