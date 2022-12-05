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

    $E_UserID = $_REQUEST["E_UserID"];
    
    echo "Cost: " . $_SESSION["Cost"] . "<br>"; 

    if($_REQUEST["submitbutton"]=="Edit"){
        echo"You pressed edit";
        $_SESSION["E_UserID"] = $E_UserID;
        header("Location: owner_emp_edit.php");
    } else if($_REQUEST["submitbutton"]=="Remove"){
        echo "You pressed terminate";
        $_SESSION["E_UserID"] = $E_UserID;
        header("Location: owner_emp_fire.php");
    }
    
    // if($_SESSION["RemoveEmp"]){
    //     $stmt = $con->prepare("DELETE FROM employee WHERE E_UserID = ?");
    //     $stmt->bind_param("s", $empID);
    //     $stmt->execute();
    //     echo "employee removed successfully";
    //     $stmt->close();
        
    //     $stmt1 = $con->prepare("DELETE FROM users WHERE UserID = ?");
    //     $stmt1->bind_param("s", $empID);
    //     $stmt1->execute();
    //     echo "user removed successfully";
    //     $stmt1->close();
        
    //     $stmt2 = $con->prepare("DELETE FROM login WHERE UserID = ?");
    //     $stmt2->bind_param("s", $empID);
    //     $stmt2->execute();
    //     echo "login removed successfully";
    //     $stmt2->close();
        
    //     $stmt3 = $con->prepare("DELETE FROM permission WHERE UserID = ?");
    //     $stmt3->bind_param("s", $empID);
    //     $stmt3->execute();
    //     echo "permission removed successfully";
    //     $stmt3->close();
        
    //     $_SESSION["RemoveCust"] = false;
    //     header("Location: owner_emp_view.php");
    // } 
        $con->close();
?>


    </body>
    </html>