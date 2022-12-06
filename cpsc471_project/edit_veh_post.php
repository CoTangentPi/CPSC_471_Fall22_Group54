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

    $mileage = $_REQUEST["Mileage"];
    $status = $_REQUEST["Status"];
    $plate = $_REQUEST["Licence_plate"];
    $regProv = $_REQUEST["Province"];
    $insID = $_REQUEST["InsuranceID"];
    $branch = $_REQUEST["Branch_no"];
  

    echo "mileage: " . $mileage . "<br>";
    echo "status: " . $status . "<br>";
    echo "plate: " . $plate . "<br>";
    echo "regProv: " . $regProv . "<br>";
    echo "insID: " . $insID . "<br>";
    echo "branch: " . $branch . "<br>";

    $sqlcheck = "SELECT * FROM vehicle";
    $resultcheck = mysqli_query($con, $sqlcheck);
    $count = mysqli_num_rows($resultcheck);
    $same = 0;

    echo "count: " . $count . "<br>";

    if($resultcheck->num_rows > 0) {
        echo "num rows: " . $resultcheck->num_rows . "<br>";
        while($row = $resultcheck->fetch_assoc()) {

            if(strcasecmp($row["Licence_plate_no"], $plate) == 0 && strcasecmp($row["Registration_province"], $regProv) == 0) {
                if($row["VIN"] != $_SESSION["VIN"]) {
                    $same ++;
                echo "same: " . $same . "<br>";
                $_SESSION["SamePlate"] = true;
                }
            }
        }
    }
            
            
           
        //check if input end branch is the same as start branch
       /* if ($row["Branch_no"] == $end_branch) {
            echo "start branch is the same as end branch<br>";
            $_SESSION["Start_branch_same_as_end_branch"] = true;
            header("Location: transfer.php");
        } */
        //check if input mileage greater than the current mileage
       /* if($row["Mileage"] > $mileage) {
            echo "mileage is less than current mileage<br>";
            $_SESSION["Current_mileage"] = $row["Mileage"];
            $_SESSION["Mileage_less_than_current"] = true;
            header("Location: transfer.php");
        } */
        
        if(!$_SESSION["SamePlate"]){

    $stmt = $con->prepare("UPDATE vehicle 
    SET Mileage = ?, Status = ?, Licence_plate_no = ?, Registration_province = ?, 
    InsuranceID = ?, Branch_no = ? 
    WHERE VIN = ?");
    $stmt->bind_param("sssssss", $mileage, $status, $plate, $regProv, $insID, $branch, 
    $_SESSION["VIN"]);
    $stmt->execute();
    echo "Vehicle edited successfully";
    $stmt->close();
    header("Location: emp_veh_search.php");
        } else {
            echo "Vehicle not edited";
             header("Location: edit_veh.php");
        }


    

        $con->close();
?>


    </body>
    </html>