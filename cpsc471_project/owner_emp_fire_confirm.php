<?php session_start() ?>
<html>
    <body>

        <?php
    $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else {
        echo "Connection successful\n";
    }

    $E_UserID = $_SESSION["E_UserID"];
    $End_date = $_REQUEST["End_date"];
    $Severance = $_REQUEST['Severance'];
    $Employment_status = $_REQUEST["Employment_status"];

    $stmt2 = $con->prepare("UPDATE employs SET Employment_status = ?, End_date = ?, Severance = ?
    WHERE E_UserID = ?");
    $stmt2->bind_param("ssss", $Employment_status, $End_date, $Severance, $_SESSION["E_UserID"]);
    $stmt2->execute();
    echo "Employs updated successfully";
    $stmt2->close();
    
    // $sql = "SELECT * FROM owner SET Expenses = $Severance";
    // $result = $con->query($sql);
    
    
    header("Location: owner_emp_view.php");
    $con->close();
    ?>
    
    
        </body>
        </html>