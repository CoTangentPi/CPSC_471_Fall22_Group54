<?php
//start session
session_start();
?>
<html>
    <body>
        Welcome <?php echo $_SESSION["UserID"]; ?><br> ?>

        <?php
    $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else {
        echo "Connection successful\n";
    }

    $payID = $_REQUEST["PaymentID"];
    //$custID = $_REQUEST["CustID"];
    $_SESSION["ReservationID"] = $_REQUEST["ResID"];
    $price = $_REQUEST["Price"];
    echo "Reservation ID: " . $_SESSION["ReservationID"] . "<br>";
    echo "PayID: " . $payID . "<br>";
    
    echo "CustID: " . $custID . "<br>";
    echo "Price: " . $price . "<br>";

    if($_REQUEST["submitbutton"]=="Pay"){
        echo"You pressed edit <br>";
        echo "go to edit page <br>";
        $_SESSION["PayRes"] = true;
        $_SESSION["RemoveRes"] = false;
       header("Location: emp_res_edit.php");
    } else if($_REQUEST["submitbutton"]=="Remove"){
        echo "You pressed remove";
        $_SESSION["RemoveRes"] = true;
        $_SESSION["PayRes"] = false;
        //=header("Location: emp_ins_remove.php");
    } 

    if($_SESSION["RemoveRes"] && !$_SESSION["PayRes"]) {
        $stmt = $con->prepare("DELETE FROM reservation WHERE ReservationID = ?");
        $stmt->bind_param("s", $_SESSION["ReservationID"]);
        $stmt->execute();
        echo "Reservation removed successfully";
        $stmt->close();
        /*$stmt = $con->prepare("DELETE FROM payment WHERE PaymentID = ? AND C_UserID = ?");
        $stmt->bind_param("ss", $payID, $custID);
        $stmt->execute();
        echo "Payment removed successfully";
        $stmt->close();*/
        
        /*if (($key = array_search($_SESSION["ReservationID"],  $_SESSION["SearchResult"][$_SESSION["ReservationID"]][])) !== false) {
            unset( $_SESSION["SearchResult"][$_SESSION["ReservationID"]][$key]);
        }*/

        $_SESSION["RemoveRes"] = false;
        header("Location: cust_view_res.php");
    } else if ($_SESSION["PayRes"] && !$_SESSION["RemoveRes"]) {
        header("Location: cust_pay.php");
       /* $stmt = $con->prepare("UPDATE payment
        SET Payment_Method = ?
        WHERE PaymentID = ? AND C_UserID = ?");
        $stmt->bind_param("sss", $method, $payID, $custID);
        $stmt->execute();
        echo "Payment updated successfully";
        $stmt->close();
        if($cash){
            echo "Cash paid <br>";
        } else if ($credit) {
            echo "Credit paid <br>";
        } else if ($debit) {
            echo "Debit paid <br>";
        }

        echo "before: " . $_SESSION["SearchResult"][$_SESSION["ReservationID"]]["Payment_method"] . "<br>";
        echo "resID: " . $_SESSION["ReservationID"] . "<br>";



        $_SESSION["SearchResult"][$_SESSION["ReservationID"]]["Payment_method"] = $method;

        echo "after: " . $_SESSION["SearchResult"][$_SESSION["ReservationID"]]["Payment_method"];
        
        //header("Location: emp_res_search.php");
       // echo "Cash paid";
        //$stmt->close();
        header("Location: cust_view_res.php");*/
    }


        $con->close();
?>


    </body>
    </html>