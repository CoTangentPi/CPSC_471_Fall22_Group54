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

    $stmt = $con->prepare("SELECT u.*, emp.*, e.*  
    FROM users as u, employee as emp, employs as e
    WHERE u.UserID = emp.E_UserID 
    AND emp.E_UserID = e.E_UserID
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
    OR emp.E_UserID LIKE CONCAT( '%',?,'%')
    OR 'SIN' LIKE CONCAT( '%',?,'%')
    OR Branch_no LIKE CONCAT( '%',?,'%')
    OR Employment_status LIKE CONCAT( '%',?,'%')
    OR 'Start_date' LIKE CONCAT( '%',?,'%')
    OR 'End_date' LIKE CONCAT( '%',?,'%')
    OR Salary LIKE CONCAT( '%',?,'%')
    OR Severance LIKE CONCAT( '%',?,'%')
     )");
    
    $stmt->bind_param("ssssssssssssssssssss", $search, $search, $search, $search, $search, $search, $search, 
                        $search, $search, $search, $search, $search, $search, $search, $search, $search, $search, $search, $search, $search);
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
        echo $row["E_UserID"] . " " . $row["First_name"]."<br>";
    }
} else {
    echo "0 results";
}

   for($i = 0; $i < count($_SESSION["SearchResult"]); $i++) {
        echo $_SESSION["SearchResult"][$i]["E_UserID"] . "<br>";
    }

    

    $stmt->close();


    
        //header("Location: emp_cust.php");
        $con->close();
        header("Location: owner_emp_search.php");
?>


    </body>
    </html>