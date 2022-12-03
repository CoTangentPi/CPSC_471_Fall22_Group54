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
    
    $search = $_REQUEST["search"];
    echo "search: " . $search . "<br>";

    $stmt = $con->prepare("SELECT * FROM reservation 
    WHERE Start_date LIKE  CONCAT( '%',?,'%')
    OR End_date LIKE CONCAT( '%',?,'%')
    OR PaymentID LIKE CONCAT( '%',?,'%')
    OR C_UserID LIKE CONCAT( '%',?,'%')
    OR Branch_no LIKE CONCAT( '%',?,'%')
    OR VIN LIKE CONCAT( '%',?,'%')
    OR Pickup_location LIKE CONCAT( '%',?,'%')
    OR Dropoff_location LIKE CONCAT( '%',?,'%')
    OR ReservationID LIKE CONCAT( '%',?,'%')");
    $stmt->bind_param("sssssssss", $search, $search, $search, $search, $search, $search, $search, 
                        $search, $search);
    $stmt->execute();
    $_SESSION["SearchResult"] = [];
   //$data = [];
    //while ($row = $result->fetch_assoc()) {
    //$data[] = $row;
    //}
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
       // $data[] = $row;
       $_SESSION["SearchResult"][] = $row;
        echo $row["ReservationID"] . " " . $row["VIN"]."<br>";
    }
} else {
    echo "0 results";
}

   for($i = 0; $i < count($_SESSION["SearchResult"]); $i++) {
        echo $_SESSION["SearchResult"][$i]["ReservationID"] . "<br>";
    }

    

    $stmt->close();


    
    $con->close();
   // header("Location: emp_ins_search.php");
?>


    </body>
    </html>