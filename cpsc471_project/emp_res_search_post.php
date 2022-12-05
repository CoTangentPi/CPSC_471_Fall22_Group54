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
    $custID = $_REQUEST["CustID"];
    $_SESSION["ReservationID"] = $_REQUEST["ResID"];
    $price = $_REQUEST["Price"];
    //$_SESSION["Ins_type"] = $Ins_type;
    //$_SESSION["Cost"] = $Cost;
    $cash = false;
    $credit = false;
    $debit = false;
    $method = "";
    echo "Reservation ID: " . $_SESSION["ReservationID"] . "<br>";
    echo "PayID: " . $payID . "<br>";
    
    echo "CustID: " . $custID . "<br>";
    echo "Price: " . $price . "<br>";

    if($_REQUEST["submitbutton"]=="Edit"){
        echo"You pressed edit <br>";
        echo "go to edit page <br>";
        $_SESSION["EditRes"] = true;
        $_SESSION["RemoveRes"] = false;
       header("Location: emp_res_edit.php");
    } else if($_REQUEST["submitbutton"]=="Remove"){
        echo "You pressed remove";
        $_SESSION["RemoveRes"] = true;
        $_SESSION["EditRes"] = false;
        //=header("Location: emp_ins_remove.php");
    } else if($_REQUEST["submitbutton"] == "Cash"){
        echo "You pressed cash";
        $cash = true;
        $method = "Cash";

    } else if($_REQUEST["submitbutton"] == "Credit"){
        echo "You pressed credit";
        $credit = true;
        $method = "Credit";

    } else if($_REQUEST["submitbutton"] == "Debit"){
        echo "You pressed debit";
        $debit = true;
        $method = "Debit";
    }

    if($_SESSION["RemoveRes"] && !$_SESSION["EditRes"]) {
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
        $stmtcheck = $con->prepare("SELECT * FROM Contacts 
        WHERE C_UserID = ? 
        AND Branch_no = ?;");
        $stmtcheck->bind_param("ss", $custID, $_SESSION["Branch_no"]);
        $stmtcheck->execute();
        $result = $stmtcheck->get_result();
        if($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                echo "CustID: " . $row["C_UserID"] . "<br>";
                echo "Branch: " . $row["Branch_no"] . "<br>";
                // $data[] = $row;
               // $_SESSION["SearchResult"][] = $row;
                //echo $row["InsuranceID"] . " " . $row["Ins_Type"]."<br>";
                //echo $
                //$daily_rate = $row["Daily_Rate"];
            }
        } else {
                echo "not in contacts";
                $stmt = $con->prepare("INSERT INTO contacts
                VALUES (?, ?);");
                $stmt->bind_param("ss", $custID, $_SESSION["Branch_no"]);
                $stmt->execute();
                echo "Contact added<br>";
                $stmt->close();
        }

        $_SESSION["RemoveRes"] = false;
        header("Location: emp_res.php");
    } else if ($cash || $credit || $debit) {
        $stmt = $con->prepare("UPDATE payment
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
        header("Location: emp_res.php");
    }
   /* } else if($credit) {
        $stmt = $con->prepare("UPDATE payment
        SET Payment_Method = ?
        WHERE PaymentID = ? AND C_UserID = ?");
        $stmt->bind_param("sss", $method, $payID, $custID);
        $stmt->execute();
        echo "Payment updated successfully";
        echo "Credit paid";
        $stmt->close();
        header("Location: emp_res.php");
    } else if($debit) {
        $stmt = $con->prepare("UPDATE payment
        SET Payment_Method = ?
        WHERE PaymentID = ? AND C_UserID = ?");
        $stmt->bind_param("sss", $method, $payID, $custID);
        $stmt->execute();
        echo "Payment updated successfully";
        echo "Debit paid";
        $stmt->close();
        header("Location: emp_res.php");

        $_SESSION["SearchResult"][] = $row;
    }*/

        $con->close();
?>


    </body>
    </html>