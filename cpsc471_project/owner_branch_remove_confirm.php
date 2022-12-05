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

    $Branch_no = $_SESSION["Branch_no"];

    $stmt1 = $con->prepare("DELETE FROM branch_phone_number WHERE Branch_no = ?");
    $stmt1->bind_param("s", $Branch_no);
    $stmt1->execute();
    echo "Branch Phone Number removed successfully";
    $stmt1->close();

    $stmt2 = $con->prepare("DELETE FROM branch WHERE Branch_no = ?");
    $stmt2->bind_param("s", $Branch_no);
    $stmt2->execute();
    echo "Branch removed successfully";
    $stmt2->close();
    
    $_SESSION["RemoveBranch"] = false;
    header("Location: owner_branch_view.php");
    $con->close();
    ?>
    
    
        </body>
        </html>