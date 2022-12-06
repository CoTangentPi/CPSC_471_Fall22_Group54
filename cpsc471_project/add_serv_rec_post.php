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

    echo "employee id: " . $_SESSION["UserID"] . "<br>";
   // echo "vin: " . $_SESSION["VIN"] . "<br>";

    $start = $_REQUEST["Start_date"];
    $end = $_REQUEST["End_date"];
    $invoiceNo = $_REQUEST["InvoiceNo"];
    $cost = $_REQUEST["Cost"];
    $type = $_REQUEST["Type"];
    $schMain = $_REQUEST["SchMain"];
    $vin = $_REQUEST["VIN"];

    echo "Start Date: " . $start ."<br>";
    echo "End Date: " . $end ."<br>";
    echo "Invoice No: " . $invoiceNo ."<br>";
    echo "cost: " . $cost ."<br>";
    echo "type: " . $type ."<br>";
    echo "schMain: " . $schMain ."<br>";
    echo "vin: " . $vin ."<br>";

  

    //$pickup = $_REQUEST["pickup"];
    //$dropoff = $_REQUEST["dropoff"];
    //$custid = $_REQUEST["custid"];
    //$vin = $_REQUEST["vin"];
    //$cat = "none";
    //$dailyrate = 0;
    //$branch = "none";

    //echo "Start Date: " . $start ."<br>";
    //echo "End Date: " . $end ."<br>";
    //echo "Pick-Up: " . $pickup ."<br>";
    //echo "Drop-off: " . $dropoff ."<br>";
    //echo "cust id: " . $custid . "<br>";
    //echo "vin: " . $vin . "<br>";

  
    //adapted from stack overflow
    //https://stackoverflow.com/questions/2040560/finding-the-number-of-days-between-two-dates
    $interval = strtotime("$end") - strtotime("$start");
    $days = round($interval / (60 * 60 * 24));
    echo "num days: " . $days . "<br>";


    if($days > 0){
        echo $start . " is before " . $end . "<br>";

        //if start date is after end date then don't accept input
    } else if ($days < 0) {
        echo $start . " is after " . $end . "<br>";
        $_SESSION["Start_after_end"] = true;    
         header("Location: add_serv_rec_veh.php");
    } else {
        echo $start . " is the same as " . $end . "<br>";
        $days = 1;
    }
    echo "num days: " . $days . "<br>";

    echo "start = end" .var_dump($start == $end). "<br>"; // bool(false)
    //echo "start > end" .$same. "<br>"; // bool(false)
    echo "start < end" .var_dump($start < $end)."<br>";  // bool(true)
    echo "start > end" . var_dump($start > $end) . "<br>";  // bool(false)

    if(!$_SESSION["Start_after_end"]) {

        $stmtcheck = $con->prepare("SELECT * FROM Service_record
        WHERE Invoice_no = ?;");
        $stmtcheck->bind_param("s", $invoiceNo);
        $stmtcheck->execute();
        $result = $stmtcheck->get_result();
        if($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

               echo "Invoice No: " . $row["Invoice_no"] . "<br>";
               $_SESSION["InvoiceExists"] = true;
               $_SESSION["InvoiceNo"] = $row["Invoice_no"];
            }
        } else {
                echo "Invoice number not found<br>";
        }

        $stmtcheck->close();

        if(!$_SESSION["InvoiceExists"]){

        $stmt = $con->prepare("INSERT INTO Service_record
        VALUES (?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssss", $invoiceNo, $cost, $start, $end, $type, $schMain, $vin);
        $stmt->execute();
        $stmt->close();
        echo "Service record added successfully<br>";
        header("Location: emp_serv_recs.php");
        } else {
            echo "Go back<br>";
            header("Location: add_serv_rec.php");
        }

    }
          
        $con->close();
        //header("Location: emp_res.php");
?>


    </body>
    </html>