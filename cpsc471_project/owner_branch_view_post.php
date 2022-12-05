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

    $stmt = $con->prepare("SELECT b.* FROM branch AS b
    WHERE (Branch_no LIKE  CONCAT( '%',?,'%')
    OR Branch_name LIKE CONCAT( '%',?,'%')
    OR Street_no LIKE CONCAT( '%',?,'%')
    OR Street_name LIKE CONCAT( '%',?,'%')
    OR City LIKE CONCAT( '%',?,'%')
    OR Province LIKE CONCAT( '%',?,'%')
    OR Postal_code LIKE CONCAT( '%',?,'%'))");

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
        echo $row["Branch_no"] . " " . $row["Branch_name"]."<br>";
    }
} else {
    echo "0 results";
}

   for($i = 0; $i < count($_SESSION["SearchResult"]); $i++) {
        echo $_SESSION["SearchResult"][$i]["Branch_no"] . "<br>";
    }

    

    $stmt->close();


    
        //header("Location: emp_cust.php");
        $con->close();
        header("Location: owner_branch_search.php");
?>


    </body>
    </html>