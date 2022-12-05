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

    $stmt = $con->prepare("SELECT * FROM users, customer 
    WHERE users.UserID = customer.C_UserID 
    AND (First_name LIKE  CONCAT( '%',?,'%')
    OR Middle_name LIKE CONCAT( '%',?,'%')
    OR Last_name LIKE CONCAT( '%',?,'%')
    OR Email LIKE CONCAT( '%',?,'%')
    OR Phone_number LIKE CONCAT( '%',?,'%')
    OR DOB LIKE CONCAT( '%',?,'%')
    OR Sex LIKE CONCAT( '%',?,'%')
    OR Street_no LIKE CONCAT( '%',?,'%')
    OR Street_name LIKE CONCAT( '%',?,'%')
    OR City LIKE CONCAT( '%',?,'%')
    OR Province LIKE CONCAT( '%',?,'%')
    OR Postal_code LIKE CONCAT( '%',?,'%')
    OR C_UserID LIKE CONCAT( '%',?,'%'))");
    $stmt->bind_param("sssssssssssss", $search, $search, $search, $search, $search, $search, $search, 
                        $search, $search, $search, $search, $search, $search);
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
        echo $row["C_UserID"] . " " . $row["First_name"]."<br>";
    }
} else {
    echo "0 results";
}

   for($i = 0; $i < count($_SESSION["SearchResult"]); $i++) {
        echo $_SESSION["SearchResult"][$i]["C_UserID"] . "<br>";
    }

    

    $stmt->close();


    
        //header("Location: emp_cust.php");
        $con->close();
        header("Location: cust_search.php");
?>


    </body>
    </html>