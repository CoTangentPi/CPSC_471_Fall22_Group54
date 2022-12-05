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
    
    echo "Cost: " . $_SESSION["Cost"] . "<br>";

    if($_REQUEST["submitbutton"]=="Edit"){
        echo"You pressed edit";
        $_SESSION["Branch_no"] = $Branch_no;
        header("Location: owner_branch_edit.php");
    } else if($_REQUEST["submitbutton"]=="Remove"){
        echo "You pressed remove";
        // $_SESSION["RemoveCust"] = true;
        $_SESSION["Branch_no"] = $Branch_no;
        header("Location: owner_branch_remove.php");
    }
    
    // if($_SESSION["RemoveCust"]){
    //     $stmt = $con->prepare("DELETE FROM customer WHERE C_UserID = ?");
    //     $stmt->bind_param("s", $custID);
    //     $stmt->execute();
    //     echo "customer removed successfully";
    //     $stmt->close();
        
    //     $stmt1 = $con->prepare("DELETE FROM users WHERE UserID = ?");
    //     $stmt1->bind_param("s", $custID);
    //     $stmt1->execute();
    //     echo "user removed successfully";
    //     $stmt1->close();
        
    //     $stmt2 = $con->prepare("DELETE FROM login WHERE UserID = ?");
    //     $stmt2->bind_param("s", $custID);
    //     $stmt2->execute();
    //     echo "login removed successfully";
    //     $stmt2->close();
        
    //     $stmt3 = $con->prepare("DELETE FROM permission WHERE UserID = ?");
    //     $stmt3->bind_param("s", $custID);
    //     $stmt3->execute();
    //     echo "permission removed successfully";
    //     $stmt3->close();
        
    //     $_SESSION["RemoveCust"] = false;
    //     header("Location: emp_cust.php");
    // } 
        $con->close();
?>


    </body>
    </html>