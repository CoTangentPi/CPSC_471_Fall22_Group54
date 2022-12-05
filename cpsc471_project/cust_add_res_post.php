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
    echo "vin: " . $_SESSION["VIN"] . "<br>";

    $start = $_REQUEST["Start_date"];
    $end = $_REQUEST["End_date"];
    $pickup = $_REQUEST["pickup"];
    $dropoff = $_REQUEST["dropoff"];
    $branch = 0000; //online reservation
    //$custid = $_REQUEST["custid"];
    //$vin = $_REQUEST["vin"];
    $cat = "none";
    $dailyrate = 0;
    //$branch = "none";

    echo "Start Date: " . $start ."<br>";
    echo "End Date: " . $end ."<br>";
    echo "Pick-Up: " . $pickup ."<br>";
    echo "Drop-off: " . $dropoff ."<br>";
    echo "cust id: " . $_SESSION["UserID"] . "<br>";
    echo "vin: " . $_SESSION["VIN"] . "<br>";

  
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
         header("Location: cust_add_res.php");
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
        $stmt = $con->prepare("SELECT * FROM Features 
                                WHERE VIN = ?");
        $stmt->bind_param("s", $_SESSION["VIN"]);
        $stmt->execute();

        $result = $stmt->get_result();
        if($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                echo "Category: " . $row["Category"] . "<br>";
                $cat = $row["Category"];
                // $data[] = $row;
               // $_SESSION["SearchResult"][] = $row;
                //echo $row["InsuranceID"] . " " . $row["Ins_Type"]."<br>";
                //echo $
                //$daily_rate = $row["Daily_Rate"];
            }
        } else {
             echo "0 results";
        }

        echo "Category: " . $cat . "<br>";


        if(strcmp($cat, "M: Mini") == 0) {
            $dailyrate = 20.02;
        } else if(strcmp($cat, "E: Economy") == 0) {
            $dailyrate = 30;
        } else if(strcmp($cat, "C: Compact") == 0) {
            $dailyrate = 40;
        } else if(strcmp($cat, "I: Intermediate") == 0) {
            $dailyrate = 50;
        } else if(strcmp($cat, "S: Standard") == 0) {
            $dailyrate = 60.5;
        } else if(strcmp($cat, "F: Fullsize") == 0) {
            $dailyrate = 70;
        } else if(strcmp($cat, "P: Premium") == 0) {
            $dailyrate = 80;
        } else if(strcmp($cat, "L: Luxury") == 0) {
            $dailyrate = 90;
        /*} else if(strcmp($cat, "S: SUV")){
            $dailyrate = 100;
        } else if(strcmp($cat, "V: Van")){
            $dailyrate = 110;
        } else if(strcmp($cat, "W: Wagon")){
            $dailyrate = 120;
        } else if(strcmp($cat, "O: Other")){
            $dailyrate = 130;*/
        } else {
            echo "Category not found";
            //$dailyrate = 0;
        }

        echo "Daily Rate: " . $dailyrate . "<br>";

        $price = $days * $dailyrate;
        echo "Price: " . $price . "<br>";

        $method = "Not Paid";

        $stmt = $con->prepare("INSERT INTO Payment 
                VALUES (NULL, ?, ?, ?)");
        $stmt->bind_param("sss", $_SESSION["UserID"], $price, $method);
    
        $stmt->execute();
        echo "Payment added<br>";
        //check for last user id inserted as that is the user id for this user
        $last_id = $con->insert_id;
        echo "New record created successfully. Last inserted ID is: " . $last_id . "<br>";
        $stmt->close();

       

        $stmtcheck = $con->prepare("SELECT * FROM Contacts 
        WHERE C_UserID = ? 
        AND Branch_no = ?;");
        $stmtcheck->bind_param("ss", $_SESSION["UserID"], $branch);
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
                $stmt->bind_param("ss", $_SESSION["UserID"], $branch);
                $stmt->execute();
                echo "Contact added<br>";
                $stmt->close();
        }


        //echo "session branch: " . $_SESSION["Branch_no"] . "<br>";

        //use prepared statements to sanitize user inputs
        $stmt2 = $con->prepare("INSERT INTO Reservation 
                VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt2->bind_param("ssssssss", $start, $end, $last_id, $_SESSION["UserID"], $branch, $_SESSION["VIN"], $pickup, $dropoff);
        $stmt2->execute();
        echo "Reservation created successfully";
        $stmt2->close();
        header("Location: cust_view_res.php");
    }
          
        $con->close();
        //header("Location: emp_res.php");
?>


    </body>
    </html>