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
    //$start_branch = $_REQUEST["Start_branch"];
    $end_branch = $_REQUEST["End_branch"];
    $status = $_REQUEST["Status"];
    $mileage = $_REQUEST["Mileage"];

    echo "Start Date: " . $start ."<br>";
    echo "End Date: " . $end ."<br>";
    echo "Start Branch: " . $start_branch ."<br>";
    echo "End Branch: " . $end_branch ."<br>";
    echo "Status: " . $status . "<br>";
    echo "Mileage: " . $mileage . "<br>";

  
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
        header("Location: transfer.php");
    } else {
        echo $start . " is the same as " . $end . "<br>";
    }

    echo "start = end" .var_dump($start == $end). "<br>"; // bool(false)
    //echo "start > end" .$same. "<br>"; // bool(false)
    echo "start < end" .var_dump($start < $end)."<br>";  // bool(true)
    echo "start > end" . var_dump($start > $end) . "<br>";  // bool(false)

    //verify user input makes sense

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
        }

        // if start date is after end date, start branch is different than end branch and mileage is 
        //greater than current mileage, input into database
        if(!$_SESSION["Start_after_end"] && !$_SESSION["Start_branch_same_as_end_branch"] && !$_SESSION["Mileage_less_than_current"]) {
            
            //use prepared statements to sanitize user input
            $stmt = $con->prepare("UPDATE vehicle
            SET Mileage = ?, Branch_no = ?, Status = ?
            WHERE VIN = ?;");
            $stmt->bind_param("ssss", $mileage, $end_branch, $status, $_SESSION["VIN"]);
            $stmt2 = $con->prepare("INSERT INTO transfers
            VALUES (?, ?, ?, ?, ?, ?);");
            $stmt2->bind_param("ssssss", $_SESSION["UserID"], $_SESSION["VIN"], $_SESSION["Current_branch"], 
                $end_branch, $start, $end);
            
            $stmt->execute();
            $stmt2->execute();
            echo "vehicle transfered<br>";
            //go back to vehicle search page
            header("Location: emp_veh_search.php");
            $stmt->close();
            $stmt2->close();
}

        $con->close();
?>


    </body>
    </html>