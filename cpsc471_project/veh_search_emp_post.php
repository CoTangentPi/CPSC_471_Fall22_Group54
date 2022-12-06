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

    $stmt = $con->prepare("SELECT * FROM vehicle, branch, features, insurance
    WHERE vehicle.Branch_no = branch.Branch_no
    AND vehicle.VIN = features.VIN
    AND vehicle.InsuranceID = insurance.InsuranceID
    AND (Year LIKE  CONCAT( '%',?,'%')
    OR Make LIKE CONCAT( '%',?,'%')
    OR Model LIKE CONCAT( '%',?,'%')
    OR vehicle.VIN LIKE CONCAT( '%',?,'%')
    OR Category LIKE CONCAT( '%',?,'%')
    OR Trans_Driven_wheels LIKE CONCAT( '%',?,'%')
    OR Fuel_Air_con LIKE CONCAT( '%',?,'%')
    OR Type LIKE CONCAT( '%',?,'%')
    OR Horse_power LIKE CONCAT( '%',?,'%')
    OR Branch_name LIKE CONCAT( '%',?,'%')
    OR Torque LIKE CONCAT( '%',?,'%')
    OR Tonnage LIKE CONCAT( '%',?,'%')
    OR Sunroof LIKE CONCAT( '%',?,'%')
    OR Seat_material LIKE CONCAT( '%',?,'%')
    OR Body_colour LIKE CONCAT( '%',?,'%')
    OR Interior_colour LIKE CONCAT( '%',?,'%')
    OR Fuel_economy LIKE CONCAT( '%',?,'%')
    OR Childseat_compatibility LIKE CONCAT( '%',?,'%')
    OR Number_of_passengers LIKE CONCAT( '%',?,'%')
    OR Status LIKE CONCAT( '%',?,'%')
    OR Mileage LIKE CONCAT( '%',?,'%')
    OR Licence_plate_no LIKE CONCAT( '%',?,'%')
    OR Registration_province LIKE CONCAT( '%',?,'%')
    OR vehicle.InsuranceID LIKE CONCAT( '%',?,'%')
    OR Ins_Type LIKE CONCAT( '%',?,'%')
    OR vehicle.Branch_no LIKE CONCAT( '%',?,'%'));");
    $stmt->bind_param("ssssssssssssssssssssssssss", $search, $search, $search, $search, $search, $search, $search, 
                        $search, $search,  $search, $search,  $search, $search, $search,  $search, $search,  $search,
                        $search, $search,  $search, $search,  $search, $search, $search,  $search, $search);
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
        echo $row["VIN"]."<br>";
    }
    } //else {
        $stmt->close();
        


   for($i = 0; $i < count($_SESSION["SearchResult"]); $i++) {
        echo $_SESSION["SearchResult"][$i]["VIN"] . "<br>";
    }

    $_SESSION["Search"] = true;

   // $stmt->close();


    
    $con->close();
   header("Location: emp_veh.php");
?>


    </body>
    </html>