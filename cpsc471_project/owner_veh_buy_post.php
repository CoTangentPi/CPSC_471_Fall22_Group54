<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
      body {
         background-color: rgba(0,0,0,0.6499999761581421);
         font-family: verdana;
         color: rgba(139,216,189,1);
      }

      .header{
        overflow:auto;
      }

      .header img {
        float: right;
        width: 10vw;
        height: 10vw;
    }

    .header h1 {
        float: left;
        top: 50%;
        transform: translateY(50%);
    }

    button{
        background-color: rgba(35,70,101,1);
        border: none;
        color: rgba(139,216,189,1);
        padding: 1.5vw 3vw;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 2vw;
        cursor: pointer;
    }

    button:hover {
        background-color: rgba(139,216,189,1);
        color: rgba(35,70,101,1);
    }
   </style>

    <body>
        <h1>Vehicle <?php echo $_POST["VIN"]; ?> successfully added</h1><br>
        <!-- Change href to owner_vehicle.php -->
    <button class= "backbutton" text-align=left type="button" onclick="window.location.href='owner_start.php'">Back</button>   
    <button class= "addbutton" type="button" name="addbutton" value="addbutton" onclick="window.location.href='owner_veh_buy.php'">Buy Another Vehicle</button></td>
        <?php
   
   $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else {
        echo "Connection successful\n";
    }
    

    $VIN = $_REQUEST["VIN"];
    $Year = $_REQUEST["Year"];
    $Make = $_REQUEST["Make"];
    $Model = $_REQUEST["Model"];
    $Status = $_REQUEST["Status"];
    $Mileage = $_REQUEST["Mileage"];
    $Liscence_plate_no = $_REQUEST["Liscence_plate_no"];
    $Province = $_REQUEST["Province"];
    $InsuranceID = $_REQUEST["InsuranceID"];
    $Branch_Number = $_REQUEST["Branch_Number"];
    $Category = $_REQUEST["Category"];
    $Trans_Driven_Wheels = $_REQUEST["Trans_Driven_Wheels"];
    $Fuel_Air_Conditioning = $_REQUEST["Fuel_Air_Conditioning"];
    $Type = $_REQUEST["Type"];
    $Horse_Power = $_REQUEST["Horse_Power"];
    $Torque = $_REQUEST["Torque"];
    $Tonnage = $_REQUEST["Tonnage"];
    $Sunroof = $_REQUEST["Sunroof"];
    $Seat_Material = $_REQUEST["Seat_Material"];
    $Body_Colour = $_REQUEST["Body_Colour"];
    $Interior_Colour = $_REQUEST["Interior_Colour"];
    $Fuel_Economy = $_REQUEST["Fuel_Economy"];
    $Child_Seat_Compatible = $_REQUEST["Child_Seat_Compatible"];
    $Passengers_no = $_REQUEST["Passengers_no"];
    $Date_Purchased = $_REQUEST["Date_Purchased"];
    $Price = $_REQUEST["Price"];
    $Temp_Type = 'Partial';
    $Temp_Cost = '0.00';
    
    $stmt100 = $con->prepare("INSERT INTO insurance 
    VALUES (?, ?, ?)");
    //VALUES (NULL, $First_name, $Middle_name, $Last_name, $Email, $Phone_number, $DOB, $Sex, $Street_no, $Street_name, $City, $Province, $Postal_code)";
    $stmt100->bind_param("sss", $InsuranceID, $Temp_Type, $Temp_Cost);

    $stmt100->execute();
    $last_id = $con->insert_id;
    $stmt100->close();
    
    $stmt = $con->prepare("INSERT INTO vehicle 
    VALUES (?, ?, ?, ?, ?, ?, ?)");
    //VALUES (NULL, $First_name, $Middle_name, $Last_name, $Email, $Phone_number, $DOB, $Sex, $Street_no, $Street_name, $City, $Province, $Postal_code)";
    $stmt->bind_param("sssssss", $VIN, $Status, $Mileage, $Liscence_plate_no, $Province, $last_id, $Branch_Number);

    $stmt->execute();
    $last_id = $con->insert_id;
    $stmt->close();

    $stmt2 = $con->prepare("INSERT INTO features
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt2->bind_param("ssssssssssssssssss", $Year, $Make, $Model, $last_id, $Category, $Trans_Driven_Wheels, $Fuel_Air_Conditioning, $Type, $Horse_Power, $Torque, $Tonnage, $Sunroof, $Seat_Material, $Body_Colour, $Interior_Colour, $Fuel_Economy, $Child_Seat_Compatible, $Passengers_no);
    $stmt2->execute();
    echo "Features created successfully";
    $stmt2->close();


    $sql = "UPDATE owner SET Expenses += $Price";
    $result = $con->query($sql);


    if($result) {
        echo "Owner expenses updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
        $con->close();
?>


    </body>
    </html>