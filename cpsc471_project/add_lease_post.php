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
    $cost = $_REQUEST["Cost"];
    $alreadyLeased = false;
    $status = "Not Ready";

    echo "Start Date: " . $start ."<br>";
    echo "End Date: " . $end ."<br>";
    echo "cost: " . $cost ."<br>";

  
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
        header("Location: add_lease.php");
    } else {
        echo $start . " is the same as " . $end . "<br>";
    }

    echo "start = end" .var_dump($start == $end). "<br>"; // bool(false)
    //echo "start > end" .$same. "<br>"; // bool(false)
    echo "start < end" .var_dump($start < $end)."<br>";  // bool(true)
    echo "start > end" . var_dump($start > $end) . "<br>";  // bool(false)



        // if start date is after end date,  input into database
        if(!$_SESSION["Start_after_end"]) {

            $stmt = $con->prepare("SELECT * FROM lease
                WHERE O_UserID = ?
                AND VIN = ?;");
        $stmt->bind_param("ss", $_SESSION["UserID"], $_SESSION["VIN"]);

        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo $row["O_UserID"] . " " . $row["VIN"] . "<br>";
                $alreadyLeased = true;
            }
        } else {
            echo "0 results";
        }
            if(!$alreadyLeased){
            //use prepared statements to sanitize user input
            $stmt = $con->prepare("INSERT INTO lease
            VALUES (?, ?, ?, ?, ?);");
            $stmt->bind_param("sssss", $_SESSION["UserID"], $_SESSION["VIN"], $start, $end, $cost); 
            
            $stmt->execute();
            echo "lease added<br>";
            //go back to vehicle search page
           // header("Location: own_veh_search.php");
            $stmt->close();
            } else {
                echo "already leased<br>";
                
                $stmt = $con->prepare("UPDATE lease
            SET Start_date = ?, End_date = ?, Cost = ?
            WHERE O_UserID = ? AND VIN = ?;");
            $stmt->bind_param("sssss", $start, $end, $cost, $_SESSION["UserID"], $_SESSION["VIN"]); 
            $stmt->execute();
            echo "lease updated<br>";
            //go back to vehicle search page
            // header("Location: own_veh_search.php");
            $stmt->close();
            }

            $stmt = $con->prepare("UPDATE vehicle
            SET Status = ?
            WHERE VIN = ?;");
            $stmt->bind_param("ss", $status, $_SESSION["VIN"]); 
            $stmt->execute();
            echo "status updated<br>";
            //go back to vehicle search page
             header("Location: own_veh_search.php");
            $stmt->close();
}



        $con->close();
?>


    </body>
    </html>