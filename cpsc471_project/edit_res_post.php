<?php
//start session
session_start();
?>
<html>

<body>

    <?php
        $con = mysqli_connect("localhost", "root", "", "cwcrs_db");
        if (!$con) {
            exit("An error connecting occurred." . mysqli_connect_errno());
        } else {
            echo "Connection successful<br>";
        }

        echo "employee id: " . $_SESSION["UserID"] . "<br>";
        echo "works at: " . $_SESSION["Branch_no"] . "<br>";

        $start = $_REQUEST["Start_date"];
        $end = $_REQUEST["End_date"];
        $pickup = $_REQUEST["Pickup"];
        $dropoff = $_REQUEST["Dropoff"];
        $vin = $_REQUEST["VIN"];
        $cat = "none";
        $dailyrate = 0;

        echo "Start Date: " . $start . "<br>";
        echo "End Date: " . $end . "<br>";
        echo "pickup: " . $pickup . "<br>";
        echo "dropoff: " . $dropoff . "<br>";
        echo "vin: " . $vin . "<br>";


        //adapted from stack overflow
        //https://stackoverflow.com/questions/2040560/finding-the-number-of-days-between-two-dates
        $interval = strtotime("$end") - strtotime("$start");
        $days = round($interval / (60 * 60 * 24));
        echo "num days: " . $days . "<br>";


        if ($days > 0) {
            echo $start . " is before " . $end . "<br>";

            //if start date is after end date then don't accept input
        } else if ($days < 0) {
            echo $start . " is after " . $end . "<br>";
            $_SESSION["Start_after_end"] = true;
            echo "don't accept input <br>";
            header("Location: emp_res_edit.php");
        } else {
            echo $start . " is the same as " . $end . "<br>";
        }

        echo "start = end" . var_dump($start == $end) . "<br>"; // bool(false)
        //echo "start > end" .$same. "<br>"; // bool(false)
        echo "start < end" . var_dump($start < $end) . "<br>"; // bool(true)
        echo "start > end" . var_dump($start > $end) . "<br>"; // bool(false)
        
        //verify user input makes sense
/*
    $sqlcheck = "SELECT * FROM vehicle WHERE VIN = '" . $_SESSION["VIN"] . "'";
    $resultcheck = $con->query($sqlcheck);

    $count = mysqli_num_rows($resultcheck);
    $same = 0;

    echo "count: " . $count . "<br>";

    if($resultcheck->num_rows > 0) {
        echo "num rows: " . $resultcheck->num_rows . "<br>";
        while($row = $resultcheck->fetch_assoc()) {
            
        echo "vin: " . $row["VIN"] . "<br>";
        echo "mileage: " . $row["Mileage"] . "<br>";
        echo "start branch: " . $row["Branch_no"] . "<br>";
        //check if input end branch is the same as start branch
        if ($row["Branch_no"] == $end_branch) {
            echo "start branch is the same as end branch<br>";
            $_SESSION["Start_branch_same_as_end_branch"] = true;
            header("Location: transfer.php");
        } 
        //check if input mileage greater than the current mileage
        if($row["Mileage"] > $mileage) {
            echo "mileage is less than current mileage<br>";
            $_SESSION["Current_mileage"] = $row["Mileage"];
            $_SESSION["Mileage_less_than_current"] = true;
            header("Location: transfer.php");
        } 
        }
        }*/

        // if start date is after end date input into database
        if (!$_SESSION["Start_after_end"]) {


            //use prepared statements to sanitize user input
            $stmt = $con->prepare("UPDATE reservation
            SET Start_date = ?, End_Date = ?, Pickup_location = ?, Dropoff_location = ?, VIN = ?
            WHERE ReservationID = ?;");
            $stmt->bind_param("ssssss", $start, $end, $pickup, $dropoff, $vin, $_SESSION["ReservationID"]);
            /*$stmt2 = $con->prepare("INSERT INTO transfers
            VALUES (?, ?, ?, ?, ?, ?);");
            $stmt2->bind_param("ssssss", $_SESSION["UserID"], $_SESSION["VIN"], $_SESSION["Current_branch"], 
            $end_branch, $start, $end);*/

            $stmt->execute();
            //$stmt2->execute();
            echo "reservation updated<br>";
            //go back to vehicle search page
            //header("Location: emp_veh_search.php");
            $stmt->close();
            //$stmt2->close();
        
            $stmt = $con->prepare("SELECT * FROM Features 
                                WHERE VIN = ?");
            $stmt->bind_param("s", $vin);
            $stmt->execute();

            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
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


            if (strcmp($cat, "M: Mini") == 0) {
                $dailyrate = 20.02;
            } else if (strcmp($cat, "E: Economy") == 0) {
                $dailyrate = 30;
            } else if (strcmp($cat, "C: Compact") == 0) {
                $dailyrate = 40;
            } else if (strcmp($cat, "I: Intermediate") == 0) {
                $dailyrate = 50;
            } else if (strcmp($cat, "S: Standard") == 0) {
                $dailyrate = 60.5;
            } else if (strcmp($cat, "F: Fullsize") == 0) {
                $dailyrate = 70;
            } else if (strcmp($cat, "P: Premium") == 0) {
                $dailyrate = 80;
            } else if (strcmp($cat, "L: Luxury") == 0) {
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

           // $method = "Not Paid";

           $payid = 0;
           $custid = 0;

           $sql = "SELECT * FROM reservation";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
                 if($row["ReservationID"] == $_SESSION["ReservationID"]) {
                    //echo $row["Start_date"];
                    $payid = $row["PaymentID"];
                    $custid = $row["C_UserID"];
                }
            }

            echo "reservation id: " . $_SESSION["ReservationID"] . "<br>";

            echo "Payment ID: " . $payid . "<br>";
            echo "Customer ID: " . $custid . "<br>";
            $stmt = $con->prepare("UPDATE Payment 
                SET Price = ?
                WHERE PaymentID = ?
                AND C_UserID = ?;");
            $stmt->bind_param("sss", $price, $payid, $custid);

            $stmt->execute();
            echo "Payment edited<br>";
            //check for last user id inserted as that is the user id for this user
            //$last_id = $con->insert_id;
            //echo "New record created successfully. Last inserted ID is: " . $last_id . "<br>";
            $stmt->close();

            $stmtcheck = $con->prepare("SELECT * FROM Contacts 
        WHERE C_UserID = ? 
        AND Branch_no = ?;");
        $stmtcheck->bind_param("ss", $custid, $_SESSION["Branch_no"]);
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
                $stmt->bind_param("ss", $custid, $_SESSION["Branch_no"]);
                $stmt->execute();
                echo "Contact added<br>";
                $stmt->close();
        }


            //go back to reservation page
            header("Location: emp_res.php");
       
        }

        $con->close();
        ?>


</body>

</html>