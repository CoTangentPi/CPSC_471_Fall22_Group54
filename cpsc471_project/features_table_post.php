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
    
   // $search = $_REQUEST["search"];
    //echo "search: " . $search . "<br>";
    $_SESSION["SearchResult"] = [];

   
//https://stackoverflow.com/questions/18421988/getting-checkbox-values-on-submit
    if (isset($_REQUEST["Year"])) {
        echo "You chose the following year(s): <br>";
        $yearChosen = $_REQUEST["Year"];
        foreach ($yearChosen as $search){ 
            echo $search."<br />";
            $stmt = $con->prepare("SELECT * FROM vehicle, branch, features, insurance
            WHERE vehicle.Branch_no = branch.Branch_no
            AND vehicle.VIN = features.VIN
            AND vehicle.InsuranceID = insurance.InsuranceID
            AND Year = ?;");
            $stmt->bind_param("s", $search);
            $stmt->execute();
        
           
           // $_SESSION["SearchResult"] = [];
            $result = $stmt->get_result();
            if($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $count = 0;
                if(count($_SESSION["SearchResult"]) == 0) {
                    $_SESSION["SearchResult"][] = $row;
                    echo $row["VIN"] . "<br>";
                } else {
                for ($i = 0; $i < count($_SESSION["SearchResult"]); $i++) {
                    if ($_SESSION["SearchResult"][$i]["VIN"] == $row["VIN"]) {
                        $count++;
                    }
                    //echo $_SESSION["SearchResult"][$i]["ReservationID"] . "<br>";
                }
                
                if ($count == 0) {
                    $_SESSION["SearchResult"][] = $row;
                    echo $row["VIN"] . "<br>";
                }
            }
            }
            } //else {
               $stmt->close();
                
        
            echo "current array: <br>";
           for($i = 0; $i < count($_SESSION["SearchResult"]); $i++) {
                echo $_SESSION["SearchResult"][$i]["VIN"] . "<br>";
            }
        }
    } else {
        echo "You did not choose a year.";
    }

    if (isset($_REQUEST["Make"])) {
        echo "You chose the following make(s): <br>";
        $makeChosen = $_REQUEST["Make"];
        foreach ($makeChosen as $search){ 
            echo $search."<br />";
            $stmt1 = $con->prepare("SELECT * FROM vehicle, branch, features, insurance
            WHERE vehicle.Branch_no = branch.Branch_no
            AND vehicle.VIN = features.VIN
            AND vehicle.InsuranceID = insurance.InsuranceID
            AND Make = ?;");
            $stmt1->bind_param("s", $search);
           $stmt1->execute();
        
           
           // $_SESSION["SearchResult"] = [];
            $result = $stmt1->get_result();
            if($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
               // $data[] = $row;
               $count = 0;
               if(count($_SESSION["SearchResult"]) == 0) {
                   $_SESSION["SearchResult"][] = $row;
                   echo $row["VIN"] . " " . $row["VIN"] . "<br>";
               } else {
               for ($i = 0; $i < count($_SESSION["SearchResult"]); $i++) {
                   if ($_SESSION["SearchResult"][$i]["VIN"] == $row["VIN"]) {
                       $count++;
                       echo $row["VIN"] ."<br>";
                   }
                   //echo $_SESSION["SearchResult"][$i]["ReservationID"] . "<br>";
               }
               
               if ($count == 0) {
                   $_SESSION["SearchResult"][] = $row;
                   echo $row["VIN"] .  "<br>";
               }
           }
            }
            } //else {
                $stmt1->close();
                
        
            echo "current array: <br>";
           for($i = 0; $i < count($_SESSION["SearchResult"]); $i++) {
                echo $_SESSION["SearchResult"][$i]["VIN"] . "<br>";
            }
        }
    } else {
        echo "You did not choose a make.";
    }

    if (isset($_REQUEST["Model"])) {
        echo "You chose the following model(s): <br>";
        $modelChosen = $_REQUEST["Model"];
        foreach ($modelChosen as $search){ 
            echo $search."<br />";
            $stmt2 = $con->prepare("SELECT * FROM vehicle, branch, features, insurance
            WHERE vehicle.Branch_no = branch.Branch_no
            AND vehicle.VIN = features.VIN
            AND vehicle.InsuranceID = insurance.InsuranceID
            AND Model = ?;");
            $stmt2->bind_param("s", $search);
            $stmt2->execute();
        
           
           // $_SESSION["SearchResult"] = [];
            $result = $stmt2->get_result();
            if($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $count = 0;
                if(count($_SESSION["SearchResult"]) == 0) {
                    $_SESSION["SearchResult"][] = $row;
                    echo $row["VIN"]  . "<br>";
                } else {
                for ($i = 0; $i < count($_SESSION["SearchResult"]); $i++) {
                    if ($_SESSION["SearchResult"][$i]["VIN"] == $row["VIN"]) {
                        $count++;
                        //echo "count" . $count . "<br>";
                        echo $row["VIN"] . "<br>";
                    }
                    //echo $_SESSION["SearchResult"][$i]["ReservationID"] . "<br>";
                }
                
                if ($count == 0) {
                    $_SESSION["SearchResult"][] = $row;
                    echo $row["VIN"]  . "<br>";
                }
            }

            }
            } //else {
               $stmt2->close();
                
        
            echo "current array: <br>";
           for($i = 0; $i < count($_SESSION["SearchResult"]); $i++) {
                echo $_SESSION["SearchResult"][$i]["VIN"] . "<br>";
            }

        }
    } else {
        echo "You did not choose a model.";
    }

    if (isset($_REQUEST["Body_colour"])) {
        echo "You chose the following body colors(s): <br>";
        $bodyColorChosen = $_REQUEST["Body_colour"];
        foreach ($bodyColorChosen as $search){ 
            echo $search."<br />";
            $stmt3 = $con->prepare("SELECT * FROM vehicle, branch, features, insurance
            WHERE vehicle.Branch_no = branch.Branch_no
            AND vehicle.VIN = features.VIN
            AND vehicle.InsuranceID = insurance.InsuranceID
            AND Body_colour = ?;");
            $stmt3->bind_param("s", $search);
            $stmt3->execute();
        
           
           // $_SESSION["SearchResult"] = [];
            $result = $stmt3->get_result();
            if($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
               // $data[] = $row;
               $count = 0;
               if(count($_SESSION["SearchResult"]) == 0) {
                   $_SESSION["SearchResult"][] = $row;
                   echo $row["VIN"] . " " . $row["VIN"] . "<br>";
               } else {
               for ($i = 0; $i < count($_SESSION["SearchResult"]); $i++) {
                   if ($_SESSION["SearchResult"][$i]["VIN"] == $row["VIN"]) {
                       $count++;
                       echo $row["VIN"] . "<br>";
                   }
                   //echo $_SESSION["SearchResult"][$i]["ReservationID"] . "<br>";
               }
               
               if ($count == 0) {
                   $_SESSION["SearchResult"][] = $row;
                   echo $row["VIN"] .  "<br>";
               }
           }
            }
            } //else {
                $stmt3->close();
                
        
            echo "current array: <br>";
           for($i = 0; $i < count($_SESSION["SearchResult"]); $i++) {
                echo $_SESSION["SearchResult"][$i]["VIN"] . "<br>";
            }
        }
    } else {
        echo "You did not choose a body color.";
    }

    if (isset($_REQUEST["Category"])) {
        echo "You chose the following category(s): <br>";
        $catChosen = $_REQUEST["Category"];
        foreach ($catChosen as $search){ 
            echo $search."<br />";
            $stmt4 = $con->prepare("SELECT * FROM vehicle, branch, features, insurance
            WHERE vehicle.Branch_no = branch.Branch_no
            AND vehicle.VIN = features.VIN
            AND vehicle.InsuranceID = insurance.InsuranceID
            AND Category = ?;");
            $stmt4->bind_param("s", $search);
            $stmt4->execute();


// $_SESSION["SearchResult"] = [];
$result = $stmt4->get_result();
if($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
// $data[] = $row;
$count = 0;
if(count($_SESSION["SearchResult"]) == 0) {
$_SESSION["SearchResult"][] = $row;
echo $row["VIN"] . " " . $row["VIN"] . "<br>";
} else {
for ($i = 0; $i < count($_SESSION["SearchResult"]); $i++) {
if ($_SESSION["SearchResult"][$i]["VIN"] == $row["VIN"]) {
   $count++;
   echo $row["VIN"] . "<br>";
}
//echo $_SESSION["SearchResult"][$i]["ReservationID"] . "<br>";
}

if ($count == 0) {
$_SESSION["SearchResult"][] = $row;
echo $row["VIN"] .  "<br>";
}
}
}
} //else {
$stmt4->close();


echo "current array: <br>";
for($i = 0; $i < count($_SESSION["SearchResult"]); $i++) {
echo $_SESSION["SearchResult"][$i]["VIN"] . "<br>";
}
        }
    } else {
        echo "You did not choose a category.";
    }
    if (isset($_REQUEST["Trans_Driven_wheels"])) {
        echo "You chose the following trans(s): <br>";
        $transChosen = $_REQUEST["Trans_Driven_wheels"];
        foreach ($transChosen as $search){ 
            echo $search ."<br />";
            $stmt5 = $con->prepare("SELECT * FROM vehicle, branch, features, insurance
            WHERE vehicle.Branch_no = branch.Branch_no
            AND vehicle.VIN = features.VIN
            AND vehicle.InsuranceID = insurance.InsuranceID
            AND Trans_Driven_wheels = ?;");
            $stmt5->bind_param("s", $search);
            $stmt5->execute();


// $_SESSION["SearchResult"] = [];
$result = $stmt5->get_result();
if($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
// $data[] = $row;
$count = 0;
if(count($_SESSION["SearchResult"]) == 0) {
$_SESSION["SearchResult"][] = $row;
echo $row["VIN"] . " " . $row["VIN"] . "<br>";
} else {
for ($i = 0; $i < count($_SESSION["SearchResult"]); $i++) {
if ($_SESSION["SearchResult"][$i]["VIN"] == $row["VIN"]) {
   $count++;
   echo $row["VIN"] . "<br>";
}
//echo $_SESSION["SearchResult"][$i]["ReservationID"] . "<br>";
}

if ($count == 0) {
$_SESSION["SearchResult"][] = $row;
echo $row["VIN"] .  "<br>";
}
}
}
} //else {
 $stmt5->close();


echo "current array: <br>";
for($i = 0; $i < count($_SESSION["SearchResult"]); $i++) {
echo $_SESSION["SearchResult"][$i]["VIN"] . "<br>";
}
        }
    } else {
        echo "You did not choose a trans.";
    }
    if (isset($_REQUEST["Fuel_Air_con"])) {
        echo "You chose the following fuel air con(s): <br>";
        $fuelAirChosen = $_REQUEST["Fuel_Air_con"];
        foreach ($fuelAirChosen as $search){ 
            echo $search ."<br />";
            $stmt14 = $con->prepare("SELECT * FROM vehicle, branch, features, insurance
            WHERE vehicle.Branch_no = branch.Branch_no
            AND vehicle.VIN = features.VIN
            AND vehicle.InsuranceID = insurance.InsuranceID
            AND Fuel_Air_con = ?;");
            $stmt14->bind_param("s", $search);
            $stmt14->execute();


// $_SESSION["SearchResult"] = [];
$result = $stmt14->get_result();  
if($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
// $data[] = $row;
$count = 0;
if(count($_SESSION["SearchResult"]) == 0) {
$_SESSION["SearchResult"][] = $row;
echo $row["VIN"] . " " . $row["VIN"] . "<br>";
} else {
for ($i = 0; $i < count($_SESSION["SearchResult"]); $i++) {
if ($_SESSION["SearchResult"][$i]["VIN"] == $row["VIN"]) {
   $count++;
   echo $row["VIN"] . "<br>";
}
//echo $_SESSION["SearchResult"][$i]["ReservationID"] . "<br>";
}

if ($count == 0) {
$_SESSION["SearchResult"][] = $row;
echo $row["VIN"] .  "<br>";
}
}
}
} //else {
 $stmt14->close();


echo "current array: <br>";
for($i = 0; $i < count($_SESSION["SearchResult"]); $i++) {
echo $_SESSION["SearchResult"][$i]["VIN"] . "<br>";
}
        }
    } else {
        echo "You did not choose a fuel air con.";
    }
    if (isset($_REQUEST["Type"])) {
        echo "You chose the following type(s): <br>";
        $typeChosen = $_REQUEST["Type"];
        foreach ($typeChosen as $search){ 
            echo $search ."<br />";
            $stmt6 = $con->prepare("SELECT * FROM vehicle, branch, features, insurance
            WHERE vehicle.Branch_no = branch.Branch_no
            AND vehicle.VIN = features.VIN
            AND vehicle.InsuranceID = insurance.InsuranceID
            AND Type = ?;");
            $stmt6->bind_param("s", $search);
            $stmt6->execute();


// $_SESSION["SearchResult"] = [];
$result = $stmt6->get_result();
if($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
// $data[] = $row;
$count = 0;
if(count($_SESSION["SearchResult"]) == 0) {
$_SESSION["SearchResult"][] = $row;
echo $row["VIN"] . "<br>";
} else {
for ($i = 0; $i < count($_SESSION["SearchResult"]); $i++) {
if ($_SESSION["SearchResult"][$i]["VIN"] == $row["VIN"]) {
   $count++;
   echo $row["VIN"] . "<br>";
}
//echo $_SESSION["SearchResult"][$i]["ReservationID"] . "<br>";
}

if ($count == 0) {
$_SESSION["SearchResult"][] = $row;
echo $row["VIN"] .  "<br>";
}
}
}
} //else {
 $stmt6->close();


echo "current array: <br>";
for($i = 0; $i < count($_SESSION["SearchResult"]); $i++) {
echo $_SESSION["SearchResult"][$i]["VIN"] . "<br>";
}
  
        }
    } else {
        echo "You did not choose a type.";
    }
    if (isset($_REQUEST["Horse_power"])) {
        echo "You chose the following hp(s): <br>";
        $hpChosen = $_REQUEST["Horse_power"];
        foreach ($hpChosen as $search){ 
            echo $search."<br />";
            $stmt7 = $con->prepare("SELECT * FROM vehicle, branch, features, insurance
            WHERE vehicle.Branch_no = branch.Branch_no
            AND vehicle.VIN = features.VIN
            AND vehicle.InsuranceID = insurance.InsuranceID
            AND Horse_power = ?;");
            $stmt7->bind_param("s", $search);
            $stmt7->execute();


// $_SESSION["SearchResult"] = [];
$result = $stmt7->get_result();
if($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
// $data[] = $row;
$count = 0;
if(count($_SESSION["SearchResult"]) == 0) {
$_SESSION["SearchResult"][] = $row;
echo $row["VIN"] . " " . $row["VIN"] . "<br>";
} else {
for ($i = 0; $i < count($_SESSION["SearchResult"]); $i++) {
if ($_SESSION["SearchResult"][$i]["VIN"] == $row["VIN"]) {
   $count++;
   echo $row["VIN"] . "<br>";
}
//echo $_SESSION["SearchResult"][$i]["ReservationID"] . "<br>";
}

if ($count == 0) {
$_SESSION["SearchResult"][] = $row;
echo $row["VIN"] .  "<br>";
}
}
}
} //else {
 $stmt7->close();


echo "current array: <br>";
for($i = 0; $i < count($_SESSION["SearchResult"]); $i++) {
echo $_SESSION["SearchResult"][$i]["VIN"] . "<br>";
}
        }
    } else {
        echo "You did not choose a hp.";
    }
    if (isset($_REQUEST["Torque"])) {
        echo "You chose the following Torque(s): <br>";
        $torqueChosen = $_REQUEST["Torque"];
        foreach ($torqueChosen as $search){ 
            echo $search."<br />";
            $stmt8 = $con->prepare("SELECT * FROM vehicle, branch, features, insurance
            WHERE vehicle.Branch_no = branch.Branch_no
            AND vehicle.VIN = features.VIN
            AND vehicle.InsuranceID = insurance.InsuranceID
            AND Torque = ?;");
            $stmt8->bind_param("s", $search);
            $stmt8->execute();


// $_SESSION["SearchResult"] = [];
$result = $stmt8->get_result();
if($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
// $data[] = $row;
$count = 0;
if(count($_SESSION["SearchResult"]) == 0) {
$_SESSION["SearchResult"][] = $row;
echo $row["VIN"] . "<br>";
} else {
for ($i = 0; $i < count($_SESSION["SearchResult"]); $i++) {
if ($_SESSION["SearchResult"][$i]["VIN"] == $row["VIN"]) {
   $count++;
   echo $row["VIN"] . "<br>";
}
//echo $_SESSION["SearchResult"][$i]["ReservationID"] . "<br>";
}

if ($count == 0) {
$_SESSION["SearchResult"][] = $row;
echo $row["VIN"] .  "<br>";
}
}
}
} //else {
 $stmt8->close();


echo "current array: <br>";
for($i = 0; $i < count($_SESSION["SearchResult"]); $i++) {
echo $_SESSION["SearchResult"][$i]["VIN"] . "<br>";
}
        }
    } else {
        echo "You did not choose a Torque.";
    }
    if (isset($_REQUEST["Tonnage"])) {
        echo "You chose the following tonnage(s): <br>";
        $tonnageChosen = $_REQUEST["Tonnage"];
        foreach ($tonnageChosen as $search){ 
            echo $search."<br />";
            $stmt9 = $con->prepare("SELECT * FROM vehicle, branch, features, insurance
            WHERE vehicle.Branch_no = branch.Branch_no
            AND vehicle.VIN = features.VIN
            AND vehicle.InsuranceID = insurance.InsuranceID
            AND Tonnage = ?;");
            $stmt9->bind_param("s", $search);
            $stmt9->execute();


// $_SESSION["SearchResult"] = [];
$result = $stmt9->get_result();
if($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
// $data[] = $row;
$count = 0;
if(count($_SESSION["SearchResult"]) == 0) {
$_SESSION["SearchResult"][] = $row;
echo $row["VIN"] .  "<br>";
} else {
for ($i = 0; $i < count($_SESSION["SearchResult"]); $i++) {
if ($_SESSION["SearchResult"][$i]["VIN"] == $row["VIN"]) {
   $count++;
   echo $row["VIN"] . "<br>";
}
//echo $_SESSION["SearchResult"][$i]["ReservationID"] . "<br>";
}

if ($count == 0) {
$_SESSION["SearchResult"][] = $row;
echo $row["VIN"] .  "<br>";
}
}
}
} //else {
 $stmt9->close();


echo "current array: <br>";
for($i = 0; $i < count($_SESSION["SearchResult"]); $i++) {
echo $_SESSION["SearchResult"][$i]["VIN"] . "<br>";
}
        }
    } else {
        echo "You did not choose a tonnage.";
    }
    if (isset($_REQUEST["Seat_material"])) {
        echo "You chose the following seat mat(s): <br>";
        $seatChosen = $_REQUEST["Seat_material"];
        foreach ($seatChosen as $search){ 
            echo $search."<br />";
            $stmt10 = $con->prepare("SELECT * FROM vehicle, branch, features, insurance
            WHERE vehicle.Branch_no = branch.Branch_no
            AND vehicle.VIN = features.VIN
            AND vehicle.InsuranceID = insurance.InsuranceID
            AND Seat_material = ?;");
            $stmt10->bind_param("s", $search);
            $stmt10->execute();


// $_SESSION["SearchResult"] = [];
$result = $stmt10->get_result();
if($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
// $data[] = $row;
$count = 0;
if(count($_SESSION["SearchResult"]) == 0) {
$_SESSION["SearchResult"][] = $row;
echo $row["VIN"] .  "<br>";
} else {
for ($i = 0; $i < count($_SESSION["SearchResult"]); $i++) {
if ($_SESSION["SearchResult"][$i]["VIN"] == $row["VIN"]) {
   $count++;
   echo $row["VIN"] . "<br>";
}
//echo $_SESSION["SearchResult"][$i]["ReservationID"] . "<br>";
}

if ($count == 0) {
$_SESSION["SearchResult"][] = $row;
echo $row["VIN"] .  "<br>";
}
}
}
} //else {
$stmt10->close();


echo "current array: <br>";
for($i = 0; $i < count($_SESSION["SearchResult"]); $i++) {
echo $_SESSION["SearchResult"][$i]["VIN"] . "<br>";
}
        }
    } else {
        echo "You did not choose a seat mat.";
    }
    if (isset($_REQUEST["Interior_colour"])) {
        echo "You chose the following int color(s): <br>";
        $intChosen = $_REQUEST["Interior_colour"];
        foreach ($intChosen as $search){ 
            echo $search."<br />";
            $stmt11 = $con->prepare("SELECT * FROM vehicle, branch, features, insurance
            WHERE vehicle.Branch_no = branch.Branch_no
            AND vehicle.VIN = features.VIN
            AND vehicle.InsuranceID = insurance.InsuranceID
            AND Interior_colour = ?;");
            $stmt11->bind_param("s", $search);
            $stmt11->execute();


// $_SESSION["SearchResult"] = [];
$result = $stmt11->get_result();
if($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
// $data[] = $row;
$count = 0;
if(count($_SESSION["SearchResult"]) == 0) {
$_SESSION["SearchResult"][] = $row;
echo $row["VIN"] . " " . $row["VIN"] . "<br>";
} else {
for ($i = 0; $i < count($_SESSION["SearchResult"]); $i++) {
if ($_SESSION["SearchResult"][$i]["VIN"] == $row["VIN"]) {
   $count++;
   echo $row["VIN"] . "<br>";
}
//echo $_SESSION["SearchResult"][$i]["ReservationID"] . "<br>";
}

if ($count == 0) {
$_SESSION["SearchResult"][] = $row;
echo $row["VIN"] .  "<br>";
}
}
}
} //else {
 $stmt11->close();


echo "current array: <br>";
for($i = 0; $i < count($_SESSION["SearchResult"]); $i++) {
echo $_SESSION["SearchResult"][$i]["VIN"] . "<br>";
}
        }
    } else {
        echo "You did not choose a int color.";
    }
    if (isset($_REQUEST["Fuel_economy"])) {
        echo "You chose the following fuel econ(s): <br>";
        $fuelEconChosen = $_REQUEST["Fuel_economy"];
        foreach ($fuelEconChosen as $search){ 
            echo $search."<br />";
            $stmt12 = $con->prepare("SELECT * FROM vehicle, branch, features, insurance
            WHERE vehicle.Branch_no = branch.Branch_no
            AND vehicle.VIN = features.VIN
            AND vehicle.InsuranceID = insurance.InsuranceID
            AND Fuel_economy = ?;");
            $stmt12->bind_param("s", $search);
            $stmt12->execute();


// $_SESSION["SearchResult"] = [];
$result = $stmt12->get_result();
if($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
// $data[] = $row;
$count = 0;
if(count($_SESSION["SearchResult"]) == 0) {
$_SESSION["SearchResult"][] = $row;
echo $row["VIN"] . " " . $row["VIN"] . "<br>";
} else {
for ($i = 0; $i < count($_SESSION["SearchResult"]); $i++) {
if ($_SESSION["SearchResult"][$i]["VIN"] == $row["VIN"]) {
   $count++;
   echo $row["VIN"] . "<br>";
}
//echo $_SESSION["SearchResult"][$i]["ReservationID"] . "<br>";
}

if ($count == 0) {
$_SESSION["SearchResult"][] = $row;
echo $row["VIN"] .  "<br>";
}
}
}
} //else {
 $stmt12->close();


echo "current array: <br>";
for($i = 0; $i < count($_SESSION["SearchResult"]); $i++) {
echo $_SESSION["SearchResult"][$i]["VIN"] . "<br>";
}
        }
    } else {
        echo "You did not choose a fuel economy.";
    }
    if (isset($_REQUEST["Childseat_compatibility"])) {
        echo "You chose the following child seat(s): <br>";
        $childChosen = $_REQUEST["Childseat_compatibility"];
        foreach ($childChosen as $search){ 
            echo $search."<br />";
            $stmt13 = $con->prepare("SELECT * FROM vehicle, branch, features, insurance
            WHERE vehicle.Branch_no = branch.Branch_no
            AND vehicle.VIN = features.VIN
            AND vehicle.InsuranceID = insurance.InsuranceID
            AND Childseat_compatibility = ?;");
            $stmt13->bind_param("s", $search);
$stmt13->execute();


// $_SESSION["SearchResult"] = [];
$result = $stmt13->get_result();
if($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
// $data[] = $row;
$count = 0;
if(count($_SESSION["SearchResult"]) == 0) {
$_SESSION["SearchResult"][] = $row;
echo $row["VIN"] . " " . $row["VIN"] . "<br>";
} else {
for ($i = 0; $i < count($_SESSION["SearchResult"]); $i++) {
if ($_SESSION["SearchResult"][$i]["VIN"] == $row["VIN"]) {
   $count++;
   echo $row["VIN"] . "<br>";
}
//echo $_SESSION["SearchResult"][$i]["ReservationID"] . "<br>";
}

if ($count == 0) {
$_SESSION["SearchResult"][] = $row;
echo $row["VIN"] .  "<br>";
}
}
}
} //else {
 $stmt13->close();


echo "current array: <br>";
for($i = 0; $i < count($_SESSION["SearchResult"]); $i++) {
echo $_SESSION["SearchResult"][$i]["VIN"] . "<br>";
}
        }
    } else {
        echo "You did not choose a child seat.";
    }

    if (isset($_REQUEST["Number_of_passengers"])) {
        echo "You chose the following num pass(s): <br>";
        $passChosen = $_REQUEST["Number_of_passengers"];
        foreach ($passChosen as $search){ 
            echo $search."<br />";
            $stmt15 = $con->prepare("SELECT * FROM vehicle, branch, features, insurance
            WHERE vehicle.Branch_no = branch.Branch_no
            AND vehicle.VIN = features.VIN
            AND vehicle.InsuranceID = insurance.InsuranceID
            AND  Number_of_passengers = ?;");
            $stmt15->bind_param("s", $search);
$stmt15->execute();


// $_SESSION["SearchResult"] = [];
$result = $stmt15->get_result();
if($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
// $data[] = $row;
$count = 0;
if(count($_SESSION["SearchResult"]) == 0) {
$_SESSION["SearchResult"][] = $row;
echo $row["VIN"] . "<br>";
} else {
for ($i = 0; $i < count($_SESSION["SearchResult"]); $i++) {
if ($_SESSION["SearchResult"][$i]["VIN"] == $row["VIN"]) {
   $count++;
   echo $row["VIN"] . "<br>";
}
//echo $_SESSION["SearchResult"][$i]["ReservationID"] . "<br>";
}

if ($count == 0) {
$_SESSION["SearchResult"][] = $row;
echo $row["VIN"] .  "<br>";
}
}
}
} //else {
 $stmt15->close();


echo "current array: <br>";
for($i = 0; $i < count($_SESSION["SearchResult"]); $i++) {
echo $_SESSION["SearchResult"][$i]["VIN"] . "<br>";
}
        }
    } else {
        echo "You did not choose a pass.";
    }
    
   

   
    $_SESSION["Search"] = true;

   // $stmt->close();
    echo "current user id: " . $_SESSION["UserID"] . "<br>";
   $sql = "SELECT * FROM customer, users
   WHERE customer.C_UserID = users.UserID";
   $result = $con->query($sql);


   if ($result->num_rows > 0) {
       // output data of each row
       while($row = $result->fetch_assoc()) {
                if($row["C_UserID"] == $_SESSION["UserID"]){
               //echo "ReservationID: " . $row["ReservationID"]. " Start" . $row["Start_date"]. "<br>";
              header("Location: cust.php");
            // echo "cust id: " . $row["C_UserID"] . "<br>";
             //echo "go to customer page";
                }
       }
     } else {
      // echo "0 results";
     };

     $sql = "SELECT * FROM employee, users
   WHERE employee.E_UserID = users.UserID";
   $result = $con->query($sql);


   if ($result->num_rows > 0) {
       // output data of each row
       while($row = $result->fetch_assoc()) {
                if($row["E_UserID"] == $_SESSION["UserID"]){
               //echo "ReservationID: " . $row["ReservationID"]. " Start" . $row["Start_date"]. "<br>";
              header("Location: emp_veh.php");
                //echo "go to employee page";
       }}
     } else {
      // echo "0 results";
     };

     $sql = "SELECT * FROM owner, users
   WHERE owner.O_UserID = users.UserID";
   $result = $con->query($sql);


   if ($result->num_rows > 0) {
       // output data of each row
       while($row = $result->fetch_assoc()) {
                if($row["O_UserID"] == $_SESSION["UserID"]){
               //echo "ReservationID: " . $row["ReservationID"]. " Start" . $row["Start_date"]. "<br>";
               header("Location: own_veh.php");
               // echo "go to owner page";
                }
       }
     } else {
      // echo "0 results";
     };
    
    $con->close();

 //  header("Location: emp_veh.php");
?>


    </body>
    </html>