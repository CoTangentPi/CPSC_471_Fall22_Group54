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

    $stmt = $con->prepare("SELECT * FROM service_record 
    WHERE (Invoice_no LIKE  CONCAT( '%',?,'%')
    OR Start_date LIKE CONCAT( '%',?,'%')
    OR End_date LIKE CONCAT( '%',?,'%')
    OR Type_of_service LIKE CONCAT( '%',?,'%')
    OR Scheduled_maintenance LIKE CONCAT( '%',?,'%')
    OR Cost LIKE CONCAT( '%',?,'%')
    OR VIN LIKE CONCAT( '%',?,'%'))");
    $stmt->bind_param("sssssss", $search, $search, $search, $search, $search, $search, $search);
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
       // echo $row["InsuranceID"] . " " . $row["Ins_Type"]."<br>";
    }
} else {
    echo "0 results";
}

   for($i = 0; $i < count($_SESSION["SearchResult"]); $i++) {
        echo $_SESSION["SearchResult"][$i]["InsuranceID"] . "<br>";
    }

    

    $stmt->close();


    
    $con->close();
    header("Location: serv_recs_search.php");
?>


    </body>
    </html>